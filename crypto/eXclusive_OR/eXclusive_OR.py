import hashlib
from Crypto.Util.number import *
from flag import *

flag = bytes_to_long(flag)

key1 = int(hashlib.md5(b"1").hexdigest(), 16)
key2 = int(hashlib.md5(b"2").hexdigest(), 16)
key3 = int(hashlib.md5(b"3").hexdigest(), 16)
key4 = int(hashlib.md5(b"4").hexdigest(), 16)
key5 = int(hashlib.md5(b"5").hexdigest(), 16)

print("key1 = ", key1)
print("key1 ^ key2 = ", key1 ^ key2)
print("key2 ^ key3 ^ key4 = ", key2 ^ key3 ^ key4)
print("key1 ^ key4 ^ key5 = ", key1 ^ key4 ^ key5)
print("key2 ^ key 5 = ", key2 ^ key5)
print("flag ^ key1 ^ key2 ^ key3 ^ key4 ^ key5 = ", flag ^ key1 ^ key2 ^ key3 ^ key4 ^ key5)