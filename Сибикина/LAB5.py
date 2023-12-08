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
#начало программы
a = input()
k = len(a)
d = k - 1
r = math.ceil(math.log2(k+1+math.ceil(math.log2(k+1))))
print(r)
c = ""
d = ""
if (r == 3):
    c = "1101"
    d = "1000"
a_10 = int(a,2)
c_10 = int(c,2)
d_10 = int(d,2)
a_d = d_10*a_10 
str_a_d = binar(a_d)
while(len(str_a_d)<k+r):
    str_a_d = '0' + str_a_d
str_1 = divide_bin(str_a_d,c)
str_10 = int(str_1,2)
b = binar(str_10 ^ a_d)
while(len(b)<k+r):
    b = '0' + b
print("a = ", a, "\n", "b = ", b, "\n", "c = ", c, "\n", )

### проверка ошибкиr
print("хотите внести ошибку?\n")

b_error = input()

print("b_error = " , b_error)
#print(left_rotate_string(b_error,1))
ost = divide_bin(b_error, c)
amount_shift = 0
while(int(ost,2) > 1):
    b_error = left_rotate_string(b_error,1)
    ost = divide_bin(b_error, c)
    amount_shift = amount_shift + 1


b_error_int= int(b_error,2) ^ int(ost,2)
b_error = binar(b_error_int)
while(len(b_error)< k+r):
    b_error = '0' + b_error
b_error = right_rotate_string(b_error,amount_shift)
if(amount_shift == 0):
    print("ошибок нет")
else:
    print ("Исправленная комбинация: ", b_error ,"\n", "Ошибка допущена в ", amount_shift, "разряде" )


