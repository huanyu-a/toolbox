import sqlite3, re

DB = r'C:\project\wwwroot\toolbox\backup\sessions-backup-2026-08-26\sessions.db.bak'
con = sqlite3.connect(f'file:{DB}?mode=ro', uri=True)
cur = con.cursor()

patterns = ['ADMIN_PATH', 'admin_path=', 'portal', '后台', 'login', ':8080', 'bx9y.com']
seen = set()
for pat in patterns:
    rows = cur.execute(
        'SELECT session_id, role, content FROM transcript_entries WHERE content LIKE ?',
        (f'%{pat}%',)).fetchall()
    for sid, role, content in rows:
        for m in re.finditer(re.escape(pat), content, re.IGNORECASE):
            s = max(0, m.start() - 120)
            e = min(len(content), m.end() + 160)
            snippet = content[s:e].replace('\n', ' ')
            key = snippet[:80]
            if key in seen:
                continue
            seen.add(key)
            print(f'[{pat}] {sid[:8]} {role}: ...{snippet}...')
con.close()
print('TOTAL snippets:', len(seen))
