# -*- coding: utf-8 -*-
import re, glob, collections

classes = collections.Counter()
for f in glob.glob(r"C:\project\wwwroot\toolbox\application\index\view\index\*.html"):
    src = open(f, encoding="utf-8", errors="ignore").read()
    for c in re.findall(r'class="([^"]+)"', src):
        for one in c.split():
            if one.startswith("t-"):
                classes[one] += 1
for c, n in classes.most_common():
    print("%-22s %d" % (c, n))
