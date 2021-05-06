## [Crypto] Attack on the RSA

### 問題文

RSA暗号運用でやってはいけないnのこと。  

### 配布ファイル

- `Attack_on_the_RSA.txt`

```
N =  117187799739088816439178283594737774234847566105762779984533933562731634880449069981008043473924258316276336588420636439754839823424692938548114859404968593001003108015853561101242345343453470236654844738176842290902452819810429910031517608311944047417666631954645349836945407693207863255329835415592656256181
e1 =  3
e2 =  65537
c1 =  17661725593133910124991307339935963864570318303745855280260002175618762653428740904082696134059547908473857852275159019164079499107452671983422882553164679584696849112738650416433832768956613013794954050818017605301769587767581584872239769264039556637186677873431742520119229587277415284718963530399313631672
c2 =  104645960848534548834452729271375511700929201234045355715140809442845507473006402850229315646296108903951949396425533025675804159773163792186769365344851444802520693563325689130690890227021251599665673062540404894503052344111665207448969208302531216313292569124476646457164757124201691307367597881609059471962
```

### 必要な知識と簡単な解説

- Common Modulus Attack

RSA公開鍵(N, e1), (N, e2)と平文m、それぞれの公開鍵で暗号化した暗号文c1, c2があり、gcd(e1, e2)=1の時、N,e1,e2,c1,c2から平文mを導出することができます。  


### 方針

m, nが共通でeが異なるe, cの組があるので、拡張ユークリッド互除法を用いて平文mを導出します。  

### writeup

まずRSAの暗号化は以下の式で行われます。(C: 暗号文, M: 平文)  

<a href="https://www.codecogs.com/eqnedit.php?latex=C&space;=&space;M&space;^&space;e&space;\&space;mod&space;\&space;N" target="_blank"><img src="https://latex.codecogs.com/gif.latex?C&space;=&space;M&space;^&space;e&space;\&space;mod&space;\&space;N" title="C = M ^ e \ mod \ N" /></a>  

今回のc1, c2は以下の式で作成されます。

<a href="https://www.codecogs.com/eqnedit.php?latex=C_{1}&space;=&space;M&space;^&space;{e_{1}}&space;\&space;mod&space;\&space;N" target="_blank"><img src="https://latex.codecogs.com/gif.latex?C_{1}&space;=&space;M&space;^&space;{e_{1}}&space;\&space;mod&space;\&space;N" title="C_{1} = M ^ {e_{1}} \ mod \ N" /></a>  

<a href="https://www.codecogs.com/eqnedit.php?latex=C_{2}&space;=&space;M&space;^&space;{e_{2}}&space;\&space;mod&space;\&space;N" target="_blank"><img src="https://latex.codecogs.com/gif.latex?C_{2}&space;=&space;M&space;^&space;{e_{2}}&space;\&space;mod&space;\&space;N" title="C_{2} = M ^ {e_{2}} \ mod \ N" /></a>  

ベズーの定理より、<a href="https://www.codecogs.com/eqnedit.php?latex=a" target="_blank"><img src="https://latex.codecogs.com/gif.latex?a" title="a" /></a>と<a href="https://www.codecogs.com/eqnedit.php?latex=b" target="_blank"><img src="https://latex.codecogs.com/gif.latex?b" title="b" /></a>を0でない整数とした時、次の等式を満たす整数<a href="https://www.codecogs.com/eqnedit.php?latex=x" target="_blank"><img src="https://latex.codecogs.com/gif.latex?x" title="x" /></a>と<a href="https://www.codecogs.com/eqnedit.php?latex=y" target="_blank"><img src="https://latex.codecogs.com/gif.latex?y" title="y" /></a>が存在するとされています。  

<a href="https://www.codecogs.com/eqnedit.php?latex=xa&space;&plus;&space;yb&space;=&space;gcd(a,&space;b)" target="_blank"><img src="https://latex.codecogs.com/gif.latex?xa&space;&plus;&space;yb&space;=&space;gcd(a,&space;b)" title="xa + yb = gcd(a, b)" /></a>  

<a href="https://www.codecogs.com/eqnedit.php?latex=gcd(e1,&space;e2)&space;=&space;1" target="_blank"><img src="https://latex.codecogs.com/gif.latex?gcd(e1,&space;e2)&space;=&space;1" title="gcd(e1, e2) = 1" /></a>のとき、次の式を満たす整数<a href="https://www.codecogs.com/eqnedit.php?latex=s_{1}" target="_blank"><img src="https://latex.codecogs.com/gif.latex?s_{1}" title="s_{1}" /></a>と<a href="https://www.codecogs.com/eqnedit.php?latex=s_{2}" target="_blank"><img src="https://latex.codecogs.com/gif.latex?s_{2}" title="s_{2}" /></a>が存在します。  

<a href="https://www.codecogs.com/eqnedit.php?latex=s_{1}e_{1}&space;&plus;&space;s_{2}e_{2}&space;=&space;1" target="_blank"><img src="https://latex.codecogs.com/gif.latex?s_{1}e_{1}&space;&plus;&space;s_{2}e_{2}&space;=&space;1" title="s_{1}e_{1} + s_{2}e_{2} = 1" /></a>  

ここで、拡張ユークリッドの互除法を適用することで<a href="https://www.codecogs.com/eqnedit.php?latex=s_{1}" target="_blank"><img src="https://latex.codecogs.com/gif.latex?s_{1}" title="s_{1}" /></a>と<a href="https://www.codecogs.com/eqnedit.php?latex=s_{2}" target="_blank"><img src="https://latex.codecogs.com/gif.latex?s_{2}" title="s_{2}" /></a>を見つけることができれば、平文<a href="https://www.codecogs.com/eqnedit.php?latex=M" target="_blank"><img src="https://latex.codecogs.com/gif.latex?M" title="M" /></a>の復元ができます。  

<a href="https://www.codecogs.com/eqnedit.php?latex=C_{1}^{s_{1}}&space;*&space;C_{2}^{s_{2}}&space;=&space;(M^{e_{1}})^{s_{1}}&space;*&space;(M^{e_{2}})^{s_{2}}&space;\&space;mod&space;\&space;N" target="_blank"><img src="https://latex.codecogs.com/gif.latex?C_{1}^{s_{1}}&space;*&space;C_{2}^{s_{2}}&space;=&space;(M^{e_{1}})^{s_{1}}&space;*&space;(M^{e_{2}})^{s_{2}}&space;\&space;mod&space;\&space;N" title="C_{1}^{s_{1}} * C_{2}^{s_{2}} = (M^{e_{1}})^{s_{1}} * (M^{e_{2}})^{s_{2}} \ mod \ N" /></a>  

<a href="https://www.codecogs.com/eqnedit.php?latex==&space;M^{e_{1}s_{1}}&space;*&space;M^{e_{2}s_{2}}&space;\&space;mod&space;\&space;N" target="_blank"><img src="https://latex.codecogs.com/gif.latex?=&space;M^{e_{1}s_{1}}&space;*&space;M^{e_{2}s_{2}}&space;\&space;mod&space;\&space;N" title="= M^{e_{1}s_{1}} * M^{e_{2}s_{2}} \ mod \ N" /></a>  

<a href="https://www.codecogs.com/eqnedit.php?latex==&space;M^{e_{1}s_{1}&space;&plus;&space;{e_{2}s_{2}}}&space;\&space;mod&space;\&space;N" target="_blank"><img src="https://latex.codecogs.com/gif.latex?=&space;M^{e_{1}s_{1}&space;&plus;&space;{e_{2}s_{2}}}&space;\&space;mod&space;\&space;N" title="= M^{e_{1}s_{1} + {e_{2}s_{2}}} \ mod \ N" /></a>  

<a href="https://www.codecogs.com/eqnedit.php?latex==&space;M^1" target="_blank"><img src="https://latex.codecogs.com/gif.latex?=&space;M^1" title="= M^1" /></a>  

<a href="https://www.codecogs.com/eqnedit.php?latex==&space;M" target="_blank"><img src="https://latex.codecogs.com/gif.latex?=&space;M" title="= M" /></a>  

```python=
from Crypto.Util.number import *
import math

N =  117187799739088816439178283594737774234847566105762779984533933562731634880449069981008043473924258316276336588420636439754839823424692938548114859404968593001003108015853561101242345343453470236654844738176842290902452819810429910031517608311944047417666631954645349836945407693207863255329835415592656256181
e1 =  3
e2 =  65537
c1 =  17661725593133910124991307339935963864570318303745855280260002175618762653428740904082696134059547908473857852275159019164079499107452671983422882553164679584696849112738650416433832768956613013794954050818017605301769587767581584872239769264039556637186677873431742520119229587277415284718963530399313631672
c2 =  104645960848534548834452729271375511700929201234045355715140809442845507473006402850229315646296108903951949396425533025675804159773163792186769365344851444802520693563325689130690890227021251599665673062540404894503052344111665207448969208302531216313292569124476646457164757124201691307367597881609059471962

def egcd(a, b):
    if a == 0:
        return (b, 0, 1)
    else:
        g, y, x = egcd(b % a, a)
        return (g, x - (b // a) * y, y)

def modinv(a, m):
    g, x, y = egcd(a, m)
    return x % m

def common_modulus_attack(c1, c2, e1, e2, N):
    s1 = modinv(e1, e2)
    s2 = (math.gcd(e1, e2) - e1 * s1) // e2
    tmp = modinv(c2, N)
    m1 = pow(c1, s1, N)
    m2 = pow(tmp, -s2, N)
    return (m1 * m2) % N

print(long_to_bytes(common_modulus_attack(c1, c2, e1, e2, N)))
```

```
flag{RsA_encrYpTi0n_NEEDs_ProPEr_OPerATi0N}
```
