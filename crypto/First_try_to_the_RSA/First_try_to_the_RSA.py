from Crypto.Util.number import *
from flag import *

m = bytes_to_long(flag)

p = getStrongPrime(512)
q = getStrongPrime(512)
N = p * q
e = 65537

print("N =", N)
print("p =", p)
print("q =", q)
print("e =", e)
print("c =", pow(m, e, N))