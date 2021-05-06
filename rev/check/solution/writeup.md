# check
flagの確認ができるバイナリ．

難読化されていて読みづらいので，angrで解く

```python
#!/usr/bin/env python3
import angr
import logging

logging.getLogger("angr").setLevel("CRITICAL")
proj = angr.Project("./chall")

while True:
    simgr = proj.factory.simgr()
    simgr.explore(find=lambda s: b"Correct" in s.posix.dumps(1))
    if len(simgr.found) > 0:
        found = simgr.found[0].posix.dumps(0).decode("utf-8", "ignore")
        if found.startswith('flag{') and found.endswith('}'):
            print(found)
            exit(0)
```

```
↯ ./solve.py
WARNING | 2021-04-27 00:38:04,555 | cle.loader | The main binary is a position-independent executable. It is being loaded with a base address of 0x400000.
flag{4r3_y0u_angry?}
```

