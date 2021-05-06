# caesar
baby_revと同様，読むだけで解けるが，別の方法で解く

gdbでmainのケツに移動して変数の中身をみる．

```
gdb-peda$ b *main+178
Breakpoint 1 at 0x11fb
gdb-peda$ r
Starting program: /home/lilium/src/github.com/IPFactory/WelcomeCTF2021/rev/caesar/challenge/chall
[----------------------------------registers-----------------------------------]
RAX: 0x64f16d38b28fff00
RBX: 0x0
RCX: 0x34 ('4')
RDX: 0x7d ('}')
RSI: 0x7fffffffd2f8 --> 0x7fffffffd7a0 ("/home/lilium/src/github.com/IPFactory/WelcomeCTF2021/rev/caesar/challenge/chall")
RDI: 0x1
RBP: 0x7fffffffd200 --> 0x555555555210 (<__libc_csu_init>:      endbr64)
RSP: 0x7fffffffd1b0 --> 0xd ('\r')
RIP: 0x5555555551fb (<main+178>:        sub    rax,QWORD PTR fs:0x28)
R8 : 0x0
R9 : 0x7ffff7fdffa0 (endbr64)
R10: 0xfffffffffffffa4a
R11: 0x202
R12: 0x555555555060 (<_start>:  endbr64)
R13: 0x0
R14: 0x0
R15: 0x0
EFLAGS: 0x202 (carry parity adjust zero sign trap INTERRUPT direction overflow)
[-------------------------------------code-------------------------------------]
   0x5555555551f4 <main+171>:   jle    0x5555555551cc <main+131>
   0x5555555551f6 <main+173>:   nop
   0x5555555551f7 <main+174>:   mov    rax,QWORD PTR [rbp-0x8]
=> 0x5555555551fb <main+178>:   sub    rax,QWORD PTR fs:0x28
   0x555555555204 <main+187>:   je     0x55555555520b <main+194>
   0x555555555206 <main+189>:   call   0x555555555050 <__stack_chk_fail@plt>
   0x55555555520b <main+194>:   leave
   0x55555555520c <main+195>:   ret
[------------------------------------stack-------------------------------------]
0000| 0x7fffffffd1b0 --> 0xd ('\r')
0008| 0x7fffffffd1b8 --> 0x3500000000 ('')
0016| 0x7fffffffd1c0 ("flag{y0u_d0nt_h4v3_t0_b3_C43s3r_t0_und3rst4nd_C43s4r}\177")
0024| 0x7fffffffd1c8 ("_d0nt_h4v3_t0_b3_C43s3r_t0_und3rst4nd_C43s4r}\177")
0032| 0x7fffffffd1d0 ("v3_t0_b3_C43s3r_t0_und3rst4nd_C43s4r}\177")
0040| 0x7fffffffd1d8 ("_C43s3r_t0_und3rst4nd_C43s4r}\177")
0048| 0x7fffffffd1e0 ("t0_und3rst4nd_C43s4r}\177")
0056| 0x7fffffffd1e8 ("st4nd_C43s4r}\177")
[------------------------------------------------------------------------------]
Legend: code, data, rodata, value

Breakpoint 1, 0x00005555555551fb in main ()
gdb-peda$
```

flag{y0u_d0nt_h4v3_t0_b3_C43s3r_t0_und3rst4nd_C43s4r}
