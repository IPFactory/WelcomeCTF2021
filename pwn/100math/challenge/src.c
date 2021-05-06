#include <stdio.h>
#include <stdlib.h>
#include <unistd.h>
#include <err.h>
#include <time.h>

FILE* flagfile = NULL;

void main() {
    if (!flagfile)
        err(1, "Oops! flag is broken!");

    for (int i = 0; i < 100; i++) {
        long a, b, ans, input;
        a = rand();
        b = rand();
        switch (rand()%2) {
            case 0:
                ans = a + b;
                printf("%ld + %ld = ", a, b);
                scanf("%ld", &input);
                if (input != ans)
                    fprintf(stderr, "Incorrect..."), exit(1);
                break;
            case 1:
                ans = a - b;
                printf("%ld - %ld = ", a, b);
                scanf("%ld", &input);
                if (input != ans)
                    fprintf(stderr, "Incorrect..."), exit(1);
                break;
        }
    }
    char c;
    while((c = fgetc(flagfile)) != EOF)
        putchar(c);
}

__attribute__((constructor))
void setup() {
    srandom(time(NULL));
    setvbuf(stdin, NULL, _IONBF, 0);
    setvbuf(stdout, NULL, _IONBF, 0);
    flagfile = fopen("flag.txt", "r");
    alarm(60);
}
