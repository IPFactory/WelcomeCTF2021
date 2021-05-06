#include <stdio.h>
#include <string.h>
#include <stdlib.h>

int main() {
    int base = 100;
    char input[21];
    fgets(input, 21, stdin);
    if (    input[0] == base + 2 &&
            input[1] == base + 8 &&
            input[2] == base - 3 &&
            input[3] == base + 3 &&
            input[4] == base + 23 &&
            input[5] == base - 48 &&
            input[6] == base + 14 &&
            input[7] == base - 49 &&
            input[8] == base - 5 &&
            input[9] == base + 21 &&
            input[10] == base - 52 &&
            input[11] == base + 17 &&
            input[12] == base - 5 &&
            input[13] == base - 3 &&
            input[14] == base + 10 &&
            input[15] == base + 3 &&
            input[16] == base + 14 &&
            input[17] == base + 21 &&
            input[18] == base - 37 &&
            input[19] == base + 25)
        puts("Correct!!");
    else
        puts("Incorrect!!");
}
