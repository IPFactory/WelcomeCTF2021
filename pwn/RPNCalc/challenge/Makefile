all: chall

chall: src.c
	gcc -fno-stack-protector -no-pie src.c -o chall
	cp chall ../distfiles/
	cp chall ../solver/

clean: chall
	rm chall ../distfiles/chall ../solver/chall
