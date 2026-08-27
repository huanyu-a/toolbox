import sqlite3

DB = r'C:\Users\WIN11\AppData\Roaming\@opensquilla\desktop-electron\opensquilla\state\agents\main\memory.db'
con = sqlite3.connect(f'file:{DB}?mode=ro', uri=True)
cur = con.cursor()
print('files:')
for r in cur.execute('SELECT path, source, size FROM files'):
    print('  ', r)
print('chunks:')
for rid, path, text in cur.execute('SELECT id, path, text FROM chunks'):
    print(f'--- {path} ---')
    print(text[:500])
con.close()
