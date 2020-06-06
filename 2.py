import numpy as np
def cetak_gambar(num):
    str = ""
    for Row in range(1, num+1):
        for Col in range(1, num+1):
            if ((Col == 1 or Col == num) or (Row == np.median(range(1, num+1)) and Col > 0 and Col < num)):
                str = str + "*"
            else:
                str = str + "="
        str = str + "\n"
    print(str)

cetak_gambar(9)



