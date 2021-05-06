# writeup
Docker imageの各レイヤの情報を確認できるdiveというツールがあり，それを用いると

`COPY file:{{hash}} in /tmp/flag.txt`というレイヤーに`a45979a88c26fbfec9e34424371d0e6b229e82bc8232add8685b117dd02ea3ac`というIdが割り振られているのがわかる

`image.tar.gz`を展開し，`image/a45979a88c26fbfec9e34424371d0e6b229e82bc8232add8685b117dd02ea3ac`にある`layer.tar`を展開すると，`tmp/flag.txt`があるので，勝ち．
