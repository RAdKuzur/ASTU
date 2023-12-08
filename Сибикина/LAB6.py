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
def NOK(a, b):
    m = a * b
    while a != 0 and b != 0:
        if a > b:
            a %= b
        else:
            b %= a
    return m // (a + b)
 
print("Лаба шестая. Коды БЧХ\n")
print("Введите a = ")
#a = input()
a = "10011"
k = len(a)
print("Введите s = ")
#s = input()

s = 3
print("Введите m = ")
#m = input()
m = 2
#n = []
n = 15
h = math.log2(n+1)
P = []
i = 2*s-1
P = [[],[],[],["10011","11111","111"],[],[],[],[],[]]
index = 0
index_2 = 0  
p1_10 = int(P[3][index_2],2)
while index < i - 1:
    p2_10 = int(P[3][index_2+1],2)
    index = index + 2
    #print(index_2, P[3][index_2+1])
    index_2 = index_2 + 1
    
    p1_10 = NOK(p1_10,p2_10)
p1 = binar(p1_10)
p1 = "10100110111"
r = len(p1)
#print(r)

rp = "1"
for t in range(r-1):
    rp = rp + '0'
#rp = "10000000000"
rp_10 = int(rp,2)
a_10 = int(a,2)
af_10 = a_10*rp_10
af = binar(af_10) 
#print(af)
#af = "100110000000000" #поменять
res = divide_bin(af, p1)
#print(res)
length = max(len(af),len(res))
b_10 = int(res,2 )| int(af,2)
b = binar(b_10)
while len(b)<length:
    b = '0'+b
print("b = ", b)
###################
print("хотите внести ошибку?\n")

#b_error = input()
b_error = "111110111000010"
print("b =                      " , b)
print("b_error =                " , b_error)
#print(left_rotate_string(b_error,1))
ost = divide_bin(b_error, p1)
amount_shift = 0
while(int(ost,2) > s):
    b_error = left_rotate_string(b_error,1)
    ost = divide_bin(b_error, p1)
    amount_shift = amount_shift + 1
    #print("                         ",ost)

b_error_int= int(b_error,2) ^ int(ost,2)
b_error = binar(b_error_int)
while(len(b_error)< k+r-1):
    b_error = '0' + b_error
b_error = right_rotate_string(b_error,amount_shift)
if(amount_shift == 0):
    print("ошибок нет")
else:
    print ("Исправленная комбинация: ", b_error)
