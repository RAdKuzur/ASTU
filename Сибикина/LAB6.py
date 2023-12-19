import math
def binar(n):
    b = ''
    while n > 0:
        b = str(n % 2) + b
        n = n // 2
    return b
def divide_bin(a,b):
    k = a
    for i in range(len(a)-len(b)+1):
        n = ''
        k_double = k
        for t in range(len(b)):
            n = n+k[i+t]
        
        n_10 = int(n,2)
        b_10 = int(b,2)     
        if(n[0]!='0'):
            str_10 = n_10^b_10
          #  print(n_10, "  ", b_10, "  ", str_10)
            str = binar(str_10)
            while(len(str) < len(b)):
                str = '0' + str
            k = ''
            index = 0
            for t in range(len(a)):
                if (n[0] != 0):
                    if t>=i and t<i+len(b): 
                        k = k + str[index]
                        index = index + 1
                    else:
                        k = k + k_double[t]
                else:
                    continue
         #   print(n, " ", b, " " ,str ," ",k)
            k_double = ''
    return k
def stab(a,length):
    while(len(a)<length):
        a='0'+ a
def left_rotate_string(s, n):
    n = n % len(s) 
    return s[n:] + s[:n]
def right_rotate_string(s, n):
    n = n % len(s) 
    return s[-n:] + s[:-n]
def xor_two_str(a,b):
    xored = []
    for i in range(max(len(a), len(b))):
        xored_value = ord(a[i%len(a)]) ^ ord(b[i%len(b)])
        xored.append(hex(xored_value)[2:])
    return ''.join(xored)
def NOK(p, length):
    a = p[0]
    answer = a
    if (length>1):
        for i in range(length-1):
            b = p[i+1]
            for t in range(len(b)-1):
                mnozh = a + '0'*(t+1)
                print(a, mnozh, binar(int(answer,2)^int(mnozh,2)))
                answer = binar(int(answer,2)^int(mnozh,2))
            a = answer
    return a
def amount_one(p):
    n = 0
    for i in range(len(p)):
        if(p[i] == '1'):
            n = n + 1
    return n
print("Лаба шестая. Коды БЧХ\n")
print("Введите a")
a = input()
k = len(a)
#соотношение корректирующих и информационных разрядов для БЧХ кодов: n k r s
array_of_indexes = [
    [7, 4, 3, 1], 
    [15, 5, 10, 3], 
    [31, 6, 25, 7],
    [63, 7, 56, 15],
    ]
for i in range(len(array_of_indexes)):
    if(array_of_indexes[i][1] == k):
        n = array_of_indexes[i][0]
        r = array_of_indexes[i][2]
        s = array_of_indexes[i][3]
h = int(math.log2(n+1))
i = 2*s-1
    #МНОГОЧЛЕНЫ В В ПОЛЕ ГАЛУА
P = [
    [],
    ['111'],
    ['1011','1101'],
    ['10011','11111', '111', '11001'],
    ['100101', '111101', '110111', '101111', '110111', '111011'],
    ['1000011', '1010111', '1100111', '1001001', '1101', '1101101'],
    [],
    [],
    []
    ]
print("Информационное сообщение          a = ", a)
print("Число информационных символов     k = ", k)
print("Поле Галуа                        h = ", h)
print("Степень                           i = ", i)
print("Число корректирующих символов     r = ", r)
print("Число исправляемых символов       s = ", s)
g_x = NOK(P[h-1], len(P[h-1])-1)
print("Образующий многочлен              g = ", g_x)
a = a + (r)*'0'
print(a, ' % ', g_x, ' = ', divide_bin(a, g_x))
b = binar(int(a,2)^int(divide_bin(a, g_x),2))
while n > len(b):
    b = '0' + b
print("Итоговая комбинация               b = ", b)
print("внесем ошибку b_error")
b_error = input()
b_error_2 = b_error
print("b =                      " , b)
print("b_error =                " , b_error)
amount_shift = 0
ostatok = divide_bin(b_error, g_x)
print(b_error, ' % ', g_x, ' = ', ostatok)
while(amount_one(binar(int(ostatok, 2))) > s):
    b_error = left_rotate_string(b_error,1)
    ostatok = divide_bin(b_error, g_x)
    print(b_error, ' % ', g_x, ' = ', ostatok)
    amount_shift = amount_shift + 1
b_error_int= int(b_error,2) ^ int(ostatok,2)
b_error = binar(b_error_int)
while(len(b_error) < len(b)):
    b_error = '0' + b_error
b_error = right_rotate_string(b_error, amount_shift)
print("Начальная комбинация:     ", b_error_2)
print("Исправленная комбинация:  ", b_error)
for i in range(len(b_error)):
    if(b_error[i] != b_error_2[i]):
        print("Ошибка в ", i + 1, " разряде")
