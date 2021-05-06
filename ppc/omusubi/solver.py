li = [map(int, input().split()) for _ in range(25)]

t = 0
for i,j in li:
    if j == 1:
        t = max(t,1001-i)
    else:
        t = max(t,i+1)

print(t)
