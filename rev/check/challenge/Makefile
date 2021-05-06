all: chall

CC=tigress
#CFLAGS= --Verbosity=1
CFLAGS+= --Environment=x86_64:Linux:Gcc:10.2.0
CFLAGS+= --Seed=42
CFLAGS+= --Transform=Flatten
CFLAGS+= --Functions=main
CFLAGS+= --FlattenDispatch=switch
CFLAGS+= --FlattenObfuscateNext=false
CFLAGS+= --FlattenRandomizeBlocks=true
CFLAGS+= --FlattenConditionalKinds=branch,compute,flag
CFLAGS+= --FlattenImplicitFlowNext=true
#CFLAGS+= --Transform=Virtualize
#CFLAGS+= --Functions=main
#CFLAGS+= --VirtualizeDispatch=direct
#CFLAGS+= --Transform=CleanUp
#CFLAGS+= --CleanUpKinds=randomize
CFLAGS+= --out=src_obfuscated.c
CFLAGS+= -o chall

chall: src.c Makefile
	$(CC) $(CFLAGS) src.c

clean: chall
	rm chall
	rm src_obfuscated.c
