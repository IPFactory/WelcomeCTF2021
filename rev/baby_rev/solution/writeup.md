# baby_rev

読むだけの問題

mainを読む．

```
[0x00001040]> pdf @main
            ; DATA XREF from entry0 @ 0x1061
┌ 72: int main (int argc, char **argv, char **envp);
│           ; var signed int64_t var_4h @ rbp-0x4
│           0x00001129      f30f1efa       endbr64
│           0x0000112d      55             push rbp
│           0x0000112e      4889e5         mov rbp, rsp
│           0x00001131      c745fc000000.  mov dword [var_4h], 0
│       ┌─< 0x00001138      eb2d           jmp 0x1167
│       │   ; CODE XREF from main @ 0x116b
│      ┌──> 0x0000113a      8b45fc         mov eax, dword [var_4h]
│      ╎│   0x0000113d      4898           cdqe
│      ╎│   0x0000113f      488d15ca2e00.  lea rdx, obj.enc            ; 0x4010 ; "RYWPC@\nNc^\nQ\x1f3qw \x1a$v&}821"
│      ╎│   0x00001146      0fb60410       movzx eax, byte [rax + rdx]
│      ╎│   0x0000114a      8b55fc         mov edx, dword [var_4h]
│      ╎│   0x0000114d      83c234         add edx, 0x34
│      ╎│   0x00001150      31d0           xor eax, edx
│      ╎│   0x00001152      89c1           mov ecx, eax
│      ╎│   0x00001154      8b45fc         mov eax, dword [var_4h]
│      ╎│   0x00001157      4898           cdqe
│      ╎│   0x00001159      488d15b02e00.  lea rdx, obj.enc            ; 0x4010 ; "RYWPC@\nNc^\nQ\x1f3qw \x1a$v&}821"
│      ╎│   0x00001160      880c10         mov byte [rax + rdx], cl
│      ╎│   0x00001163      8345fc01       add dword [var_4h], 1
│      ╎│   ; CODE XREF from main @ 0x1138
│      ╎└─> 0x00001167      837dfc18       cmp dword [var_4h], 0x18
│      └──< 0x0000116b      7ecd           jle 0x113a
│           0x0000116d      90             nop
│           0x0000116e      90             nop
│           0x0000116f      5d             pop rbp
└           0x00001170      c3             ret
```

ループの部分を読むと，

```c
for i in range(0x18):
    enc[i] = enc[i] ^ (0x34 + i)
```

みたいな処理だとわかる．

やる．

```python
>>> print(''.join([chr(ord(c) ^ (0x34+i)) for i, c in enumerate("RYWPC@\nNc^\nQ\x1f3qw \x1a$v&}821")]))
flag{y0u_c4n_r34d_b1n4ry}
```

はい．
