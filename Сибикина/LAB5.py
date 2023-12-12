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
            #print(n_10, "  ", b_10, "  ", str_10)
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
            #print(n, " ", b, " " ,str ," ",k)
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
def amount_one(p):
    n = 0
    for i in range(len(p)):
        if(p[i] == '1'):
            n = n + 1
    return n
#начало программы
a = input() #input combination
k = len(a) #length code word
r = math.ceil(math.log2(k+1+math.ceil(math.log2(k+1)))) #
t = 1 #количество ошибок
d = 2*t+1 #кодовое расстояние
print("a = ", a , "\nk = ", k, "\nr = ", r, "\nd0 = ", d)


P = ['11', '101', '111', '1001','1011','1101','1111','10001','10011','10101','10111',
     '11101','11111','100001','100011','100101111','100111','101001','101011','101101','101111',
     '110001','110101','110111']
i = 0
while i != len(P) and len(P[i])<=len(a):
    p = P[i]  #проверочный многочлен
    if(amount_one(p)>= d and len(p)>=r+1):   #сомнительный момент       
        break
    i = i + 1
print("Образующий многочлен p = ",p)
a_new = a
for i in range(len(p)-1):
    a_new = a_new + '0'
print(a_new , ' % ', p , ' = ',  divide_bin(a_new, p))
b = binar(int(a_new, 2) ^ int(divide_bin(a_new, p), 2))
while len(b) < len(a_new):
    b = '0' + b
print(a_new , ' + ', divide_bin(a_new, p), ' = ', b)
ost = divide_bin(a_new, p)
print('b = ', b)

print('\n Хотите внести ошибку? ')
b_error = input()
print('b =       ', b)
print('b_error = ', b_error)

print( b_error , ' : ', p , ' = ', divide_bin(b_error, p))

ost2 = divide_bin(b_error, p)
amount_shift = 0
while int(ost2,2)>1:
    b_error = left_rotate_string(b_error,1)
    amount_shift = amount_shift + 1
    ost2 = divide_bin(b_error, p)
    print( b_error , ' : ', p , ' = ', ost2)
str_10 = binar(int(b_error, 2) ^ int(ost2, 2))
while len(str_10) < len(a_new):
    str_10 = '0' + str_10

b_error = right_rotate_string(str_10, amount_shift)
print("b_true =  ", b_error)
