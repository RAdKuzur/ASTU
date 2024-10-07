import matplotlib.pyplot as plt
import numpy as np

def X(t, A, B, C, a, b, c):
    return A * np.sin(a*t) + B * np.cos(b * t) + t*C* np.cos(np.cos(c * t))
print('Введите A:')
A = float(input())
print('Введите B:')
B = float(input())
print('Введите C:')
C = float(input())
print('Введите a:')
a = float(input())
while a <= 0:
    print('Введите a:')
    a = float(input())

print('Введите b:')
b = float(input())
while b <= 0:
    print('Введите b:')
    b = float(input())
print('Введите c:')
c = float(input())
while c <= 0:
    print('Введите c:')
    c = float(input())
print('Введите криптографический ключ k:')
K = int(input())
print('Введите количество интервалов N:')
N = int(input())
print('Введите начало исследуемого интервала t1:')
t1 = int(input())
print('Введите начало исследуемого интервала t2:')
t2 = int(input())
# Генерация значений t
t_values = np.linspace(t1, t2, 1000)
# Вычисление значений функции
y_at_x = X(t_values, A, B, C, a, b, c)
# Построение графика
plt.title('График функции X(t)')
plt.xlabel('t')
plt.ylabel('X(t)')
x_coords = []
y_coords = []
ti = t1
for i in range(N+1):
    x_coords.append(ti)
    y_coords.append(X(ti, A, B, C, a, b, c))
    plt.plot([ti, ti], [0, X(ti, A, B, C, a, b, c)], color='red', linestyle='-')  # Вторичные данные
    ti = ti + abs(t2-t1)/N
# Построение линии от point1 до point2
plt.plot(t_values, y_at_x, color='blue', linestyle='-')  # Основные данные
plt.plot(x_coords, y_coords, color='orange', linestyle='-')  # Вторичные данные
plt.axhline(0, color='black',linewidth=0.5, ls='--')
plt.axvline(0, color='black',linewidth=0.5, ls='--')
plt.grid()
plt.show()
x_pairs = []
y_pairs = []
for i in range(N):
    x_pairs.append([x_coords[i], x_coords[i+1]])
    y_pairs.append([y_coords[i], y_coords[i+1]])
rng = np.random.RandomState(K)
indices = rng.permutation(len(x_pairs))
x_pairs = np.array(x_pairs)
y_pairs = np.array(y_pairs)
shuffle_x = x_pairs
shuffle_y = y_pairs[indices]
#print('x: ',shuffle_x, '    y: ' , shuffle_y)
plt.title('График функции Y(t)')
plt.xlabel('t')
plt.ylabel('Y(t)')
for i in range(N):
   plt.plot(shuffle_x[i], shuffle_y[i], color='green', linestyle='-')
for i in range(N-1):
    if shuffle_y[i+1, 0] > shuffle_y[i, 1]:
        pair = [0, shuffle_y[i+1, 0]]
    else:
        pair = [0, shuffle_y[i, 1]]
    plt.plot([shuffle_x[i+1, 0], shuffle_x[i+1, 0]], pair, color='red', linestyle='-')
plt.plot([shuffle_x[0, 0], shuffle_x[0, 0]], [0, shuffle_y[0,0]], color='red', linestyle='-')
plt.plot([shuffle_x[N-1, 1], shuffle_x[N-1, 1]], [0, shuffle_y[N-1,1]], color='red', linestyle='-')
plt.grid()
plt.show()

original_indices = np.argsort(indices)  # Получаем индексы, которые сортируют перемешанный массив
restored_array_x = shuffle_x
restored_array_y = shuffle_y[original_indices]

for i in range(N):
    plt.plot(restored_array_x[i], restored_array_y[i], color='blue', linestyle='-')
for i in range(N-1):
    if restored_array_y[i+1, 0] > restored_array_y[i, 1]:
        pair = [0, restored_array_y[i+1, 0]]
    else:
        pair = [0, restored_array_y[i, 1]]
    plt.plot([restored_array_x[i+1, 0], restored_array_x[i+1, 0]], pair, color='red', linestyle='-')
plt.plot([restored_array_x[0, 0], restored_array_x[0, 0]], [0, restored_array_y[0,0]], color='red', linestyle='-')
plt.plot([restored_array_x[N-1, 1], restored_array_x[N-1, 1]], [0, restored_array_y[N-1,1]], color='red', linestyle='-')
#print('x: ',restored_array_x, '    y: ' , restored_array_y)
plt.grid()
plt.show()
