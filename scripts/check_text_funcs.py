# -*- coding: utf-8 -*-
"""查看 jianfan convert/qqlized、pinyin transs、shuformat 绑定"""
import re

# jianfan convert
src = open(r"C:\project\wwwroot\toolbox\public\static\script\pcjs\jianfan.js", encoding="utf-8", errors="ignore").read()
i = src.find("function convert")
print("=== jianfan convert ===")
print(src[i:i+700] if i > 0 else "N/A")
i = src.find("function qqlized")
print("\n=== qqlized ===")
print(src[i:i+300] if i > 0 else "N/A")

# pinyin transs
src2 = open(r"C:\project\wwwroot\toolbox\public\static\script\pcjs\pinyin.js", encoding="utf-8", errors="ignore").read()
i = src2.find("function transs")
print("\n=== pinyin transs ===")
print(src2[i:i+900] if i > 0 else "N/A")
i = src2.find("function ClearAll")
print("\n=== pinyin ClearAll ===")
print(src2[i:i+300] if i > 0 else "N/A")
