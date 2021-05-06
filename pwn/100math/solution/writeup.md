# math

`nc math.chal.ipfctf2021.cf 4000`

ひたすらに計算をさせられる問題．

もちろん手動でやるのは面倒なので，Pythonで自動化する

```python
#!/usr/bin/env python3
from pwn import *
context.log_level = 'error'
io = remote('math.chal.ipfctf2021.cf', 4000)

io.recvuntil('== proof-of-work: disabled ==')

for _ in range(100):
    io.sendline(str(eval(''.join(io.recvuntil('=').decode('utf-8', 'ignore').split()[0:-1]))))

print(io.recvuntil('flag{').decode('utf-8', 'ignore'), end='')
print(io.recvuntil('}').decode('utf-8', 'ignore'))
```
