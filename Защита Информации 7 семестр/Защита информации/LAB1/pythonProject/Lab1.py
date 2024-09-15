#const
from math import sqrt

k1 = 2
k2 = 0.5

#fence
print('Введите Х < 50 забора:')
X = float(input())
while X >= 50:
    print('Введите Х < 50 забора:')
    X = float(input())
print('Введите Y < 50 забора:')
Y = float(input())
while Y >= 50:
    print('Введите Y < 50 забора:')
    Y = float(input())


#window
print('Введите Х1 окн:')
win1_X = float(input())
while win1_X >= X:
    print('Введите Х1 окн:')
    win1_X = float(input())

print('Введите Х2 окн:')
win2_X = float(input())
while win2_X >= X:
    print('Введите Х2 окн:')
    win2_X = float(input())

print('Введите Y окн:')
win_Y = float(input())
while win_Y >= Y:
    print('Введите Y окн:')
    win_Y = float(input())

#informations
print('Введите Х инф:')
inf_X = float(input())
while inf_X >= X:
    print('Введите Х инф:')
    inf_X = float(input())

print('Введите Y инф:')
inf_Y = float(input())
while inf_Y >= win_Y:
    print('Введите Y инф:')
    inf_Y = float(input())
#prob
print('Введите P1 окн:')
p1 = float(input())
print('Введите P2 окн:')
p2 = float(input())

#iterations
xi = X/100
yi = Y/100
P1_min = 10000000
P2_min = 10000000
x1_min = 10000000
x2_min = 10000000
y1_min = 10000000
y2_min = 10000000
l21 = sqrt((inf_X - win1_X) * (inf_X - win1_X) + (inf_Y - win_Y) * (inf_Y - win_Y))
l22 = sqrt((inf_X - win2_X) * (inf_X - win2_X) + (inf_Y - win_Y) * (inf_Y - win_Y))
for i in range(100):
    l11 = sqrt((xi - win1_X) * (xi - win1_X) + (yi - win_Y) * (yi - win_Y))
    l12 = sqrt((xi - win2_X) * (xi - win2_X) + (yi - win_Y) * (yi - win_Y))

    Pi1 = k1 * k2 * p1 / (l11 * l21)
    Pi2 = k1 * k2 * p2 / (l12 * l22)
    if P1_min > Pi1:
        P1_min = Pi1
        x1_min = xi
        y1_min = yi
    if P2_min > Pi2:
        P2_min = Pi2
        x2_min = xi
        y2_min = yi
    xi = xi + X/100
    yi = yi + Y/100
print('x1  y1: ', x1_min,' ', y1_min)
print('min P1: ', P1_min)
print('x2  y2: ', x2_min,' ', y2_min)
print('min P2: ', P2_min)


