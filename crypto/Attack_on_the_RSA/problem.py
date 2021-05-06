from Crypto.Util.number import *
from flag import *

e1 = 3
e2 = 65537

m = bytes_to_long(flag)

p = getStrongPrime(512)
q = getStrongPrime(512)
N = p * q

c1 = pow(m, e1, N)
c2 = pow(m, e2, N)



print("N = ", N)
print("e1 = ", e1)
print("e2 = ", e2)
print("c1 = ", c1)
print("c2 = ", c2)
