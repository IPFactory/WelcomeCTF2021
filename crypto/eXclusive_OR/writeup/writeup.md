## [Crypto] eXclusive OR

### 問題文

論理演算の性質を考えてみよう。

### 配布ファイル

- `eXclusive_OR.py`

```python=
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
```


- `eXclusive_OR.txt`

```
key1 =  261578874264819908609102035485573088411
key1 ^ key2 =  17052490798561597545061002127486288567
key2 ^ key3 ^ key4 =  186976162308630335415189981258845335283
key1 ^ key4 ^ key5 =  181354257732180722573550809356757667426
key2 ^ key 5 =  59505221799843167759295714312404311801
flag ^ key1^ key2 ^ key3 ^ key4 ^ key5 =  10786438895796675502428746810490179974064885678569159502404369969600
```

### 必要な知識と簡単な解説

- XOR
- `long_to_bytes`

論理演算にはand, or, not, xor等いくつか種類があり、この論理演算を組み合わせて回路を作成していきます。  
高校数学で出てきた「かつ」は「and演算」、「または」は「or演算」、「補集合」が「not」に当たります。  

> 完全な余談ですが、1937年、クロード・シャロンという方が「継電器及び回閉回路の記号的解析」という論文を出しました。電子回路のスイッチを開けた状態で0, 閉じた状態で1とすると、組み合わせることでブール代数が解けるよと主張した最初の論文です。ブール代数(真偽値)で物事は計算できるというものはそれ以前からあったようですが、「機械で物事を計算できるんじゃない？」となった重要な論文です。

XOR演算の真理値表は以下のようになります。  

p | q | p XOR q
---|---| ---
0 | 0 | 0
1 | 0 | 1
0 | 1 | 1
1 | 1 | 0

p=1, q=1のときにp XOR qの結果が0になるのが特徴的です。  

想定解法ではXORの性質を使うだけでは解けなくて、[pycryptodome](https://pypi.org/project/pycryptodome/)の[long_to_bytes](https://www.kite.com/python/docs/Crypto.Util.number.long_to_bytes)関数を利用する必要があります。`long_to_bytes`の説明は難しいので、「おまじないとして必要」とさせてください。  

### 方針

XORの以下の性質を利用します。  

```
A XOR B XOR B = A
```

### writeup

XORについての問題です。  

`eXclusive_OR.txt`のflagの部分見てみると、以下のようになっています。  

```
flag ^ key1^ key2 ^ key3 ^ key4 ^ key5 = 107......
```

flagに対して、key1, key2, key3, key4, key5のXOR演算をしています。  
Pythonでは、XOR演算を`^`で表現します。  

p, qのXOR演算をもう少し考えてみます。  

p | q | p XOR q
---|---| ---
0 | 0 | 0
1 | 0 | 1
0 | 1 | 1
1 | 1 | 0

p XOR qの状態から、pを取り出すにはどうすればよいでしょうか？  
答えは単純で、p XOR q にさらにqでXOR演算すればよいです。  

p | q | p XOR q | p XOR q XOR q = p
--- | --- | --- | --- 
0 | 0 | 0 | 0
1 | 0 | 1 | 1
0 | 1 | 1 | 0 
1 | 1 | 0 | 1

つまり、各keyを求めて、それぞれの値をflagとXOR演算することでflagが手に入ります。  
各keyは芋づる式に手に入ります。  

```python=
from Crypto.Util.number import *

key1 =  261578874264819908609102035485573088411
key2 = key1 ^ 17052490798561597545061002127486288567
key5 = key2 ^ 59505221799843167759295714312404311801
key4 = key1 ^ key5 ^ 181354257732180722573550809356757667426
key3 = key2 ^ key4 ^ 186976162308630335415189981258845335283
flag = key1 ^ key2 ^ key3 ^ key4 ^ key5 ^ 10786438895796675502428746810490179974064885678569159502404369969600

print(long_to_bytes(flag))
```

上記のPythonスクリプトを実行するとflagが手に入ります。  

```
flag{X0R_Is_Exc1uSion_L0giC}
```
