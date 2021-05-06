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
