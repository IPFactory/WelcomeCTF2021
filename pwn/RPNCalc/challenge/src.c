#include <stdio.h>
#include <stdlib.h>
#include <unistd.h>

#define MUL 0
#define ADD 1
#define SUB 3
#define DIV 5

void win() {
    system("cat flag.txt");
}

typedef long (*operation)(long, long);

long add(long a, long b) {
    return a + b;
}

long sub(long a, long b) {
    return a - b;
}

long multiplication(long a, long b) {
    return a * b;
}

long division(long a, long b) {
    return a / b;
}

void help() {
    puts("Welcome to Reverse Polish Notation Calculator");
}

struct Calculator {
    long a, b;
    operation ops[6];
};

int op_to_index(char op) {
    return op-'*';
}

int main() {
    help();
    struct Calculator calc = {
        .a = 0,
        .b = 0,
        .ops[MUL] = multiplication,
        .ops[ADD] = add,
        .ops[SUB] = sub,
        .ops[DIV] = division,
    };
    int op;

    while(1) {
        puts("two number please");
        puts("example: 10 25");
        scanf("%ld %ld", &calc.a, &calc.b);
        getchar(); // skip \n
        puts("operator please");
        op = getchar();
        printf("%ld %c %ld\n", calc.a , op, calc.b);
        long ans = (calc.ops[op_to_index(op)])(calc.a, calc.b);
        printf("= %ld\n", ans);
    }
}

__attribute__((constructor))
void setup() {
    setvbuf(stdin, NULL, _IONBF, 0);
    setvbuf(stdout, NULL, _IONBF, 0);
    alarm(60);
}
