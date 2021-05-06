def Fib(n, memo):
    if n == 1:
        return 0
    elif n == 2:
        return 1
    elif n in memo:
        return memo[n]
    else:
        memo[n] = Fib(n-1, memo) + Fib(n-2, memo)
        return memo[n]

N = 3
memo = {}

while True:
    if Fib(N,memo) >= 31271819149290786098591076778525667781144930000000:
        print(N)
        exit()
    N += 1
