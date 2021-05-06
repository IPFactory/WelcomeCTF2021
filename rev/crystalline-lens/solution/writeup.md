# Writeup - [Web 50pts] Crystalline Lens (1/33 Solves)

## 解説

配布ファイル[eyes](../rawdistfiles/eyes)を、例えばバイナリエディタで開く。
すると、👀と"ゼロ幅スペース"の2つの文字で構成されたテキストファイルであることがわかる。
次に、その2種の文字をそれぞれ0と1に置き換えて、8バイトごとに区切ると、2進数で表記された"ASCIIコード"の列であることがわかる。
最終的には、各ASCIIコードを文字に置き換えると、Flagが得られる。

## 必要な知識

- ゼロ幅スペース(zero-width space): <https://ja.wikipedia.org/wiki/%E3%82%BC%E3%83%AD%E5%B9%85%E3%82%B9%E3%83%9A%E3%83%BC%E3%82%B9>
- ASCIIコード: <https://ja.wikipedia.org/wiki/ASCII>

## Solver

Solverは、例えばPythonであれば、下記のように書ける。

```py
#!/usr/bin/env python3.9

DECRYPTION_TABLE = str.maketrans({
    '👀': '0',
    '\u200b': '1'  # zero width space
})


def decrypt(cipher: str) -> str:
    translated_to_0_and_1 = cipher_text.translate(DECRYPTION_TABLE)
    return ''.join([chr(int(translated_to_0_and_1[i: i + 8], 2)) for i in range(0, len(translated_to_0_and_1), 8)])


if __name__ == "__main__":
    with open('eyes', encoding='utf8') as f:
        cipher_text = f.read()

    print(decrypt(cipher_text))
```

### 実行結果

```shell-session
$ python solver.py
Congratulation! The flag is flag{D0_y0u_kn0w_"N0n-pr1n74bl3_ch4r4c73r5"?}. Check https://pbs.twimg.com/profile_images/1155844500473827328/K9esM-_-_400x400.jpg, OK?
```

## Flag

`flag{D0_y0u_kn0w_"N0n-pr1n74bl3_ch4r4c73r5"?}`

## 補足事項

「0と1の羅列が出てきたらASCII！」みたいな発想を必要とするという点で、あまり良い問題ではないと思います。
今回のCTFに参加してくれた入門者の方々は、この問題は「CTF作問のベストプラクティスに反した問題だ」ということを覚えておいていただけると嬉しいです。
