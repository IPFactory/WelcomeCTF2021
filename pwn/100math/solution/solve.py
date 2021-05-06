#!/usr/bin/env python3
from pwn import *
context.log_level = 'error'
io = remote('localhost', 4000)

for _ in range(100):
    line = io.recvuntil('=').decode('UTF-8', 'ignore')[0:-1]
    io.sendline(str(eval(line)))

print(io.recvuntil(b'flag{').decode(), end='')
print(io.recvuntil(b'}').decode())
