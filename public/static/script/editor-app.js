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

  /* ---------- 统计 ---------- */
  function updateStats() {
    var html = getHTML() || '';
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

  /* ---------- 模式切换（可视化编辑 <-> HTML 源码） ---------- */
  function switchMode(mode) {
    var isHtml = mode === 'html';
    if (isHtml) {
      htmlCm.setValue(getHTML() || '');
      window.setTimeout(function () { htmlCm.refresh(); }, 10);
    } else {
      vditor.setValue(htmlCm.getValue() || '');
    }
    $('#modeTabs .mtab').removeClass('active')
      .filter('[data-mode="' + mode + '"]').addClass('active');
    $('#paneTui, #paneHtml').removeClass('active');
    $('#pane' + (isHtml ? 'Html' : 'Tui')).addClass('active');
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
      theme: 'classic',
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
        hljs: { enable: true, style: 'github', lineNumber: true },
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
      }
    });

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

    /* ---------- 事件绑定 ---------- */
    $('#modeTabs').on('click', '.mtab', function () {
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
      htmlCm.setValue('');
      clearDraft();
      updateStats();
      $saveTip.text('');
      flash('已清空');
    });

    $('#btnCopyHtml').on('click', function () {
      copyText(getHTML() || '', 'HTML 已复制到剪贴板');
    });

    $('#btnCopyMd').on('click', function () {
      copyText(getValue() || '', 'Markdown 已复制到剪贴板');
    });

    $('#btnDlHtml').on('click', function () {
      var body = getHTML() || '';
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
