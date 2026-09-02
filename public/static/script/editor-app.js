/* ============================================================
 * 在线编辑器应用脚本
 * 引擎：Vditor 3.11.3（所见即所得 / 即时渲染 / 分屏预览 三种模式）
 * 辅助：CodeMirror 5（HTML 源码视图）
 * ============================================================ */
(function (window, document, $) {
  'use strict';

  var STORAGE_KEY = 'toolbox_editor_draft_v3';
  var DEFAULT_HEIGHT = 560;

  var $saveTip = $('#saveTip');
  var $stChars = $('#stChars');
  var $stAll = $('#stAll');
  var $stBlocks = $('#stBlocks');
  var $stTokens = $('#stTokens');

  var vditor = null;
  var htmlCm = null;
  var saveTimer = null;

  var SAMPLE_MD = [
    '# 欢迎使用在线编辑器',
    '',
    '本工具基于 **Vditor**，同时支持 **富文本（所见即所得）**、**即时渲染（Markdown）** 与 **HTML 源码** 三种编辑方式，可在工具栏随时切换：',
    '',
    '- **所见即所得**：像 Word 一样直接排版，输出 HTML',
    '- **即时渲染**：Markdown 语法输入即渲染，兼具编辑效率与可视效果',
    '- **分屏预览**：左侧写 Markdown，右侧实时预览',
    '- **HTML 源码**：通过顶部标签切换到源码视图，直接编辑 HTML',
    '',
    '## 功能特点',
    '',
    '| 功能 | 说明 |',
    '| --- | --- |',
    '| 三种编辑模式 | 所见即所得 / 即时渲染 / 分屏预览 |',
    '| 自动保存 | 内容实时保存在浏览器本地，刷新不丢失 |',
    '| 一键复制 | 复制 HTML 或 Markdown 源码 |',
    '| 文件导出 | 下载 .html / .md 文件 |',
    '',
    '## 使用示例',
    '',
    '> 这是一段引用文字，可以突出重要内容。',
    '',
    '```js',
    '// 插入一段代码块，支持语法高亮',
    'console.log("Hello, Editor!");',
    '```',
    '',
    '也可以直接粘贴 HTML：',
    '',
    '<div style="padding:12px;border:1px solid #e2e8f0;border-radius:8px;background:#f8fafc;">',
    '  <b>这是一段 HTML 内容</b>，可以在编辑器中正常渲染。',
    '</div>'
  ].join('\n');

  /* ---------- 轻提示 ---------- */
  function flash(msg) {
    var $t = $('#toastMsg');
    if (!$t.length) {
      $t = $('<div id="toastMsg"></div>').appendTo(document.body);
    }
    $t.text(msg).addClass('show');
    window.clearTimeout(flash._timer);
    flash._timer = window.setTimeout(function () {
      $t.removeClass('show');
    }, 1800);
  }

  /* ---------- 零宽字符清理 ----------
     Lute 的 HTML2Md 在 CJK 标点紧邻 markdown 符号（如 <strong>…：</strong>中文）时，
     会插入零宽空格（U+200B 等）保护 emphasis 解析——markdown 源/草稿必须原样保留，
     否则「：**中文」按 CommonMark 规则无法闭合加粗。输出最终 HTML 时清掉不可见字符。 */
  function stripZeroWidth(s) {
    /* U+200B ZWSP / U+200C ZWNJ / U+200D ZWJ / U+FEFF BOM / U+2060 word-joiner */
    return s ? String(s).replace(/[​-‍⁠﻿]/g, '') : s;
  }

  /* ---------- 本地草稿 ---------- */
  function loadDraft() {
    try {
      return window.localStorage.getItem(STORAGE_KEY) || '';
    } catch (e) {
      return '';
    }
  }

  function saveDraft(md) {
    try {
      window.localStorage.setItem(STORAGE_KEY, md);
    } catch (e) { /* 忽略存储异常 */ }
  }

  function clearDraft() {
    try {
      window.localStorage.removeItem(STORAGE_KEY);
    } catch (e) { /* 忽略 */ }
  }

  /* ---------- 取值 ---------- */
  function getValue() {
    return vditor ? vditor.getValue() : '';
  }

  function getHTML() {
    return vditor ? vditor.getHTML() : '';
  }

  /* ---------- 可视化 → 最终 HTML ----------
     不能直接用 vditor.getHTML()：其内部 VditorIRDOM2HTML 把 IR DOM 先还原成
     markdown 再二次解析，还原时丢掉 Lute 的零宽保护符，"食物：**推荐" 这类
     中文标点紧邻加粗符号的 emphasis 二次解析失败，strong 退化为字面星号。
     改为：取 markdown 源 → 给成对的加粗/删除线符号补回 ZWSP 保护（与 Lute
     HTML2Md 的约定一致）→ 标准 Md2HTML → 清除全部零宽字符。往返幂等。 */
  function protectEmphasis(md) {
    if (!md) {
      return '';
    }
    var lines = String(md).split('\n');
    var fence = false;
    for (var i = 0; i < lines.length; i++) {
      if (/^[ \t]{0,3}(?:```|~~~)/.test(lines[i])) {
        fence = !fence;
        continue;
      }
      if (fence) {
        continue;
      }
      lines[i] = lines[i]
        .replace(/(\*\*)(?=\S)([^\n]*?\S)\1/g, '$1​$2​$1')
        .replace(/(~~)(?=\S)([^\n]*?\S)\1/g, '$1​$2​$1');
    }
    return lines.join('\n');
  }

  function renderHtml() {
    var html = '';
    try {
      var md = getValue() || '';
      if (md && window.Lute && typeof window.Lute.New === 'function'
          && typeof window.Lute.New().Md2HTML === 'function') {
        html = window.Lute.New().Md2HTML(protectEmphasis(md)) || '';
      }
    } catch (e) { /* 转换失败降级 */ }
    if (!html) {
      html = getHTML() || '';
    }
    return stripZeroWidth(html);
  }

  /* ---------- HTML 属性净化（保留功能属性，去掉自动生成的装饰属性） ---------- */
  var KEEP_ATTRS = /^(?:href|src|alt|title|width|height|target|rel|colspan|rowspan|start|type|checked|disabled|value|name|for|placeholder|rows|cols)$/i;
  function cleanHtml(html) {
    if (!html) {
      return '';
    }
    return String(html).replace(/<([a-zA-Z][a-zA-Z0-9]*)([^>]*)>/g, function (m, tag, attrs) {
      if (!attrs) {
        return m;
      }
      var cleaned = attrs.replace(/([a-zA-Z_:][-a-zA-Z0-9_:.]*)(?:\s*=\s*(?:"[^"]*"|'[^']*'|[^\s"'=<>`]+))?/g, function (a, name) {
        return KEEP_ATTRS.test(name) ? a : '';
      });
      cleaned = cleaned.replace(/\s{2,}/g, ' ').replace(/\s+$/g, '');
      return '<' + tag + cleaned + '>';
    });
  }

  /* ---------- markdown 符号兜底清理（复制 TXT 用） ----------
     可视化编辑中粘贴的字面 markdown 符号会被 Vditor 转义（如 ** → \*\*），
     Lute 渲染后转义符号原样呈现为字面字符。此处对最终纯文本再做一层
     markdown 语法符号清理，只保留正文文字。 */
  function stripMdSymbols(t) {
    if (!t) {
      return '';
    }
    return t
      /* 解除 Vditor 转义（\* → *、\# → # 等），再统一清理 */
      .replace(/\\([`*_{}[\]()#+\-.!>|\\])/g, '$1')
      /* 图片 ![alt](url) → alt（先于链接处理，避免 ! 残留） */
      .replace(/!\[([^\]]*)\]\([^)\s]*\)/g, '$1')
      /* 链接 [text](url) → text */
      .replace(/\[([^\]]*)\]\([^)\s]*\)/g, '$1')
      /* 代码块围栏（须先于行内代码处理，避免反引号跨行吞并） */
      .replace(/^[ \t]{0,3}(?:```|~~~)[a-zA-Z0-9_+-]*[ \t]*$/gm, '')
      /* 水平线（须先于加粗/斜体，避免 *** 被斜体吃掉） */
      .replace(/^[ \t]{0,3}(?:[-*_]){3,}[ \t]*$/gm, '')
      /* 成对加粗 **text** / __text__ → text */
      .replace(/(\*\*|__)(?=\S)([\s\S]*?\S)\1/g, '$2')
      /* 成对斜体 *text* / _text_ → text（两侧数字或字母包围时不处理，避免误伤 5*6、snake_case） */
      .replace(/(^|[^*\w])\*([^*\n]+?)\*(?!\*)/g, '$1$2')
      .replace(/(^|[^_\w])_([^_\n]+?)_(?!_)/g, '$1$2')
      /* 行内代码 `code` → code（不跨行） */
      .replace(/`([^`\n]*)`/g, '$1')
      /* 标题行 # xxx → xxx */
      .replace(/^[ \t]{0,3}#{1,6}[ \t]+/gm, '')
      /* 列表 - / * / + / 1. */
      .replace(/^[ \t]{0,3}(?:[-*+]|\d{1,3}[.)])[ \t]+/gm, '')
      /* 引用 > */
      .replace(/^[ \t]{0,3}>[ \t]?/gm, '')
      /* 删除线 ~~text~~ → text */
      .replace(/~~([^~]+)~~/g, '$1')
      /* 清理行尾空白与连续空行 */
      .replace(/[ \t]+$/gm, '')
      .replace(/\n{3,}/g, '\n\n')
      .trim();
  }

  /* ---------- 纯文本提取（复制 TXT 用） ---------- */
  function getText() {
    /* 优先基于 markdown 源码经 Lute 渲染，确保未渲染的字面 markdown 符号（# ** - 等）
       也被解析掉，只保留纯文本；代码块/表格/行内代码内容不丢失 */
    var html = '';
    var isHtmlMode = $('#modeTabs .t-tab.active').attr('data-mode') === 'html';
    if (isHtmlMode && htmlCm) {
      /* HTML 源码模式下基于 CodeMirror 当前内容 */
      html = htmlCm.getValue() || '';
    } else {
      try {
        var md = getValue() || '';
        if (md && window.Lute && typeof window.Lute.New === 'function') {
          var lute = window.Lute.New();
          if (typeof lute.Md2HTML === 'function') {
            html = lute.Md2HTML(md) || '';
          }
        }
      } catch (e) { /* 转换失败时降级 */ }
      if (!html) {
        html = getHTML() || '';
      }
    }
    var d = document.createElement('div');
    d.style.cssText = 'position:fixed;left:-9999px;top:0;visibility:hidden;';
    d.innerHTML = html
      .replace(/<style[\s\S]*?<\/style>/gi, ' ')
      .replace(/<script[\s\S]*?<\/script>/gi, ' ');
    document.body.appendChild(d);
    var t = (d.innerText || d.textContent || '');
    document.body.removeChild(d);
    return stripMdSymbols(t)
      .replace(/[\u200b\u200c\u200d]/g, '')
      .replace(/[ \t]+\n/g, '\n')
      .replace(/\n{3,}/g, '\n\n')
      .trim();
  }

  /* ---------- 统计 ---------- */
  function updateStats() {
    var html = renderHtml() || '';
    var md = getValue() || '';
    var text = html
      .replace(/<style[\s\S]*?<\/style>/gi, ' ')
      .replace(/<script[\s\S]*?<\/script>/gi, ' ')
      .replace(/<[^>]+>/g, ' ')
      .replace(/&nbsp;/gi, ' ')
      .replace(/\s+/g, ' ');
    var chars = text.replace(/\s/g, '').length;
    var blocks = md.split(/\n{2,}/).filter(function (b) {
      return b.replace(/\s/g, '').length > 0;
    }).length;
    $stChars.text(chars);
    $stAll.text(md.length);
    $stBlocks.text(blocks);
    /* Token 估算：CJK 字符按 1 字 1 token，其余按每 4 字符 1 token */
    var cjk = (text.match(/[\u3400-\u4dbf\u4e00-\u9fff\uf900-\ufaff\u3040-\u30ff\uac00-\ud7af]/g) || []).length;
    var other = chars - cjk;
    $stTokens.text(cjk + Math.ceil(other / 4));
  }

  function scheduleSave() {
    window.clearTimeout(saveTimer);
    saveTimer = window.setTimeout(function () {
      saveDraft(getValue());
      var d = new Date();
      var pad = function (n) { return ('0' + n).slice(-2); };
      $saveTip.text('已自动保存 ' + pad(d.getHours()) + ':' + pad(d.getMinutes()) + ':' + pad(d.getSeconds()));
    }, 600);
  }

  /* ---------- HTML 源码转 Markdown（切回可视化时使用） ---------- */
  function htmlToMd(html) {
    if (!html) {
      return '';
    }
    try {
      if (window.Lute && typeof window.Lute.New === 'function') {
        var lute = window.Lute.New();
        if (typeof lute.HTML2Md === 'function') {
          var md = lute.HTML2Md(html);
          if (typeof md === 'string') {
            /* 保留 Lute 插入的零宽保护符：IR 模式 setValue 解析依赖它，
               去掉会让中文标点紧邻的 ** 无法闭合、加粗不渲染 */
            return md;
          }
        }
      }
    } catch (e) { /* 转换失败时降级为原文，保证内容不丢失 */ }
    return html;
  }

  /* ---------- 暗色主题联动 ---------- */
  function isDark() {
    return document.documentElement.getAttribute('data-theme') === 'dark';
  }

  function applyThemeToEditor() {
    if (!vditor) {
      return;
    }
    try {
      if (isDark()) {
        vditor.setTheme('dark', 'dark', 'github-dark');
      } else {
        vditor.setTheme('classic', 'light', 'github');
      }
    } catch (e) { /* 主题切换失败不阻塞编辑 */ }
  }

  /* ---------- 模式切换（可视化编辑 <-> HTML 源码） ----------
     当前激活模式与源码脏标记：只有从源码模式切走且用户真编辑过 CodeMirror 时，
     才把源码重新导入可视化；否则（如「示例」在可视化模式下 setValue 后再触发
     switchMode('tui')）会用过期的源码覆盖编辑器内容。 */
  var currentMode = 'tui';
  var htmlDirty = false;
  var cmSyncing = false;

  function setHtmlSource(html) {
    cmSyncing = true;
    htmlCm.setValue(html || '');
    cmSyncing = false;
    htmlDirty = false;
  }

  function switchMode(mode) {
    if (mode === currentMode) {
      return;
    }
    var isHtml = mode === 'html';
    currentMode = mode;
    $('#modeTabs .t-tab').removeClass('active')
      .filter('[data-mode="' + mode + '"]').addClass('active');
    $('#paneTui, #paneHtml').removeClass('active');
    $('#pane' + (isHtml ? 'Html' : 'Tui')).addClass('active');

    if (isHtml) {
      setHtmlSource(cleanHtml(renderHtml()));
      window.setTimeout(function () { htmlCm.refresh(); }, 10);
    } else {
      /* 先显示可视化面板，再渲染内容，避免在 display:none 下初始化 */
      if (htmlDirty) {
        var src = htmlCm.getValue() || '';
        vditor.setValue(src ? htmlToMd(src) : '');
        htmlDirty = false;
      }
      updateStats();
      scheduleSave();
      window.setTimeout(function () { vditor.focus(); }, 60);
    }
  }

  /* ---------- 复制 ---------- */
  function copyText(text, okMsg) {
    function fallback() {
      var ta = document.createElement('textarea');
      ta.value = text;
      ta.setAttribute('readonly', 'readonly');
      ta.style.position = 'fixed';
      ta.style.left = '-9999px';
      document.body.appendChild(ta);
      ta.select();
      try {
        document.execCommand('copy');
        flash(okMsg);
      } catch (e) {
        flash('复制失败，请手动复制');
      }
      document.body.removeChild(ta);
    }
    if (navigator.clipboard && navigator.clipboard.writeText) {
      navigator.clipboard.writeText(text).then(function () {
        flash(okMsg);
      }, fallback);
    } else {
      fallback();
    }
  }

  /* ---------- 下载 ---------- */
  function downloadFile(text, filename, mime) {
    var blob = new Blob([text], { type: mime + ';charset=utf-8' });
    if (window.saveAs) {
      window.saveAs(blob, filename);
    } else {
      var url = window.URL.createObjectURL(blob);
      var a = document.createElement('a');
      a.href = url;
      a.download = filename;
      document.body.appendChild(a);
      a.click();
      document.body.removeChild(a);
      window.setTimeout(function () { window.URL.revokeObjectURL(url); }, 500);
    }
  }

  /* ---------- 智能粘贴：粘贴的 markdown 不被 Vditor 自动转义 ----------
     Vditor 在所见即所得模式下，纯文本粘贴遇到 markdown 符号会转义
     （** → \*\*），导致粘贴的 markdown 变成字面符号。这里在捕获阶段
     拦截：检测到 markdown 语法时，先经 Lute 渲染成 HTML 再插入，
     让粘贴的 markdown 直接成为格式而非转义后的字面符号。 */
  function isMarkdownish(text) {
    return /(^|\n)\s{0,3}(#{1,6}\s|[-*+]\s|\d{1,3}[.)]\s|>\s|```)/.test(text) ||
      /\*\*|__|~~|`|!\[[^\]]*\]\([^)]*\)|\[[^\]]*\]\([^)]*\)/.test(text);
  }

  function bindSmartPaste() {
    if (!vditor || !vditor.element) {
      return;
    }
    vditor.element.addEventListener('paste', function (e) {
      var cd = e.clipboardData;
      if (!cd) {
        return;
      }
      var types = cd.types || [];
      var hasHtml = false;
      for (var i = 0; i < types.length; i++) {
        if (types[i] === 'text/html') {
          hasHtml = true;
          break;
        }
      }
      /* 带 HTML 的富文本粘贴交给 Vditor 默认处理（不会转义 markdown 符号） */
      if (hasHtml) {
        return;
      }
      var text = cd.getData('text/plain');
      if (!text || !isMarkdownish(text)) {
        return;
      }
      e.preventDefault();
      e.stopPropagation();
      var mode = vditor.getCurrentMode();
      if (mode === 'wysiwyg') {
        /* 所见即所得：markdown 渲染成 HTML 后插入 */
        var html = '';
        try {
          html = window.Lute.New().Md2HTML(text);
        } catch (err) {
          html = '';
        }
        if (html) {
          vditor.insertValue(html, false);
        } else {
          vditor.insertValue(text);
        }
      } else {
        /* 即时渲染/分屏：直接插入 markdown 原文，由 Vditor 自行渲染 */
        vditor.insertValue(text);
      }
      updateStats();
      scheduleSave();
    }, true);
  }

  /* ---------- 初始化 ---------- */
  $(function () {
    if (!window.Vditor) {
      flash('编辑器组件加载失败，请刷新页面重试');
      return;
    }

    vditor = new Vditor('vditor', {
      height: DEFAULT_HEIGHT,
      mode: 'ir',
      value: loadDraft() || '',
      placeholder: '在这里输入内容…支持 Markdown 语法，工具栏可切换 所见即所得 / 即时渲染 / 分屏预览 模式',
      lang: 'zh_CN',
      theme: isDark() ? 'dark' : 'classic',
      icon: 'ant',
      cdn: '/static/vditor',
      cache: { enable: false },
      tab: '    ',
      toolbar: [
        'headings', 'bold', 'italic', 'strike', '|',
        'list', 'ordered-list', 'check', '|',
        'quote', 'line', 'code', 'inline-code', '|',
        'table', 'link', 'image', '|',
        'undo', 'redo', '|',
        'edit-mode', '|',
        'outline', 'preview', 'fullscreen', 'export'
      ],
      toolbarConfig: { pin: false },
      counter: { enable: false },
      preview: {
        hljs: { enable: true, style: isDark() ? 'github-dark' : 'github', lineNumber: true },
        markdown: { toc: true, mark: true }
      },
      upload: {
        url: '',
        handler: function (files) {
          var file = files && files[0];
          if (!file) {
            return;
          }
          if (file.size > 5 * 1024 * 1024) {
            flash('图片超过 5MB，请压缩后再试');
            return;
          }
          var reader = new FileReader();
          reader.onload = function (e) {
            vditor.insertValue('\n![](' + e.target.result + ')\n');
            flash('图片已以 base64 格式插入');
          };
          reader.readAsDataURL(file);
        }
      },
      input: function () {
        updateStats();
        scheduleSave();
      },
      after: function () {
        updateStats();
        bindSmartPaste();
      }
    });

    /* 监听全站主题切换（app.js 通过 data-theme 属性切换），联动 Vditor 暗色主题 */
    if (window.MutationObserver) {
      var themeObserver = new MutationObserver(function () {
        applyThemeToEditor();
      });
      themeObserver.observe(document.documentElement, {
        attributes: true,
        attributeFilter: ['data-theme']
      });
    }

    /* ---------- CodeMirror：HTML 源码视图 ---------- */
    htmlCm = CodeMirror.fromTextArea(document.getElementById('htmlSource'), {
      mode: 'htmlmixed',
      lineNumbers: true,
      lineWrapping: false,
      tabSize: 2,
      indentUnit: 2,
      viewportMargin: 20
    });
    htmlCm.setSize(null, DEFAULT_HEIGHT);
    /* 用户在源码视图编辑过才需要回灌可视化；程序 setValue 不算 */
    htmlCm.on('change', function () {
      if (!cmSyncing) {
        htmlDirty = true;
      }
    });

    /* ---------- 事件绑定 ---------- */
    $('#modeTabs').on('click', '.t-tab', function () {
      switchMode($(this).attr('data-mode'));
    });

    $('#btnSample').on('click', function () {
      var cur = getValue() || '';
      if (cur.replace(/\s/g, '').length > 0) {
        if (!window.confirm('插入示例内容将覆盖当前内容，确定继续吗？')) {
          return;
        }
      }
      vditor.setValue(SAMPLE_MD);
      switchMode('tui');
      updateStats();
      scheduleSave();
      flash('已插入示例内容');
    });

    $('#btnClear').on('click', function () {
      if (!window.confirm('确定清空当前内容吗？')) {
        return;
      }
      vditor.setValue('');
      setHtmlSource('');
      clearDraft();
      updateStats();
      $saveTip.text('');
      flash('已清空');
    });

    $('#btnCopyHtml').on('click', function () {
      copyText(cleanHtml(renderHtml()) || '', 'HTML 已复制到剪贴板');
    });

    $('#btnCopyTxt').on('click', function () {
      var t = getText();
      if (!t) {
        flash('暂无可复制的文本内容');
        return;
      }
      copyText(t, '纯文本已复制到剪贴板');
    });

    $('#btnCopyMd').on('click', function () {
      copyText(getValue() || '', 'Markdown 已复制到剪贴板');
    });

    $('#btnDlHtml').on('click', function () {
      var body = cleanHtml(renderHtml()) || '';
      var doc = '<!DOCTYPE html>\n<html lang="zh-CN">\n<head>\n<meta charset="utf-8">\n'
        + '<meta name="viewport" content="width=device-width, initial-scale=1">\n'
        + '<title>在线编辑器导出</title>\n</head>\n<body>\n' + body + '\n</body>\n</html>';
      downloadFile(doc, 'editor-export.html', 'text/html');
      flash('HTML 文件已开始下载');
    });

    $('#btnDlMd').on('click', function () {
      downloadFile(getValue() || '', 'editor-export.md', 'text/markdown');
      flash('Markdown 文件已开始下载');
    });
  });
})(window, document, window.jQuery);
