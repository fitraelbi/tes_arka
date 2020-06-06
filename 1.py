

def divideAndSort(num):
    lst= []
    num_str = str(num)
    split_num_str = num_str.split("0")
    for i in split_num_str:
        lst.append("".join(sorted(i)))
    lst_join = "".join(lst)
    return print(lst_join)



divideAndSort(5956560159466056)