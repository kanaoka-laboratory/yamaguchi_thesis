# -*- coding: utf-8 -*-
import shutil
shutil.copy('a.txt', 'b.txt')
with open('b.txt', 'a') as f:
    f.write('hoge')