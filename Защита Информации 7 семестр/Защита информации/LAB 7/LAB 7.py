def create_square(key):
    alphabet = "ABCDEFGHIKLMNOPQRSTUVWXYZ"  # Без 'J'
    seen = set()
    square = []
    # Создаем квадрат на основе ключа
    for char in key.upper():
        if char not in seen and char in alphabet:
            seen.add(char)
            square.append(char)
    # Заполняем квадрат оставшимися буквами алфавита
    for char in alphabet:
        if char not in seen:
            square.append(char)

    return [square[i:i + 5] for i in range(0, 25, 5)]  # Возвращаем квадрат 5x5
def bigrams(message):
    # Формируем биграммы, заменяем 'J' на 'I' и добавляем 'X' в качестве заполнителя
    message = message.upper().replace('J', 'I')
    result = []
    i = 0

    while i < len(message):
        if i + 1 < len(message):
            if message[i] == message[i + 1]:
                result.append(message[i] + 'X')
                i += 1
            else:
                result.append(message[i] + message[i + 1])
                i += 2
        else:
            result.append(message[i] + 'X')  # Если осталась одна буква
            i += 1

    return result
def encrypt_bigrams(bigrams, left_square, right_square):
    encrypted_message = ""

    for bigram in bigrams:
        row1, col1 = None, None
        row2, col2 = None, None

        # Находим индексы для первой буквы в левой таблице
        for r in range(5):
            if bigram[0] in left_square[r]:
                row1, col1 = r, left_square[r].index(bigram[0])
        # Находим индексы для второй буквы в правой таблице
        for r in range(5):
            if bigram[1] in right_square[r]:
                row2, col2 = r, right_square[r].index(bigram[1])

        # Шифруем биграмму
        if row1 is not None and row2 is not None:
            if row1 == row2:  # Одна строка
                encrypted_message += left_square[row1][col2] + right_square[row2][col1]
            else:  # Прямоугольник
                encrypted_message += left_square[row1][col2] + right_square[row2][col1]

    return encrypted_message


def decrypt_bigrams(bigrams, left_square, right_square):
    decrypted_message = ""

    for bigram in bigrams:
        row1, col1 = None, None
        row2, col2 = None, None

        # Находим индексы для первой буквы в левой таблице
        for r in range(5):
            if bigram[0] in left_square[r]:
                row1, col1 = r, left_square[r].index(bigram[0])
        # Находим индексы для второй буквы в правой таблице
        for r in range(5):
            if bigram[1] in right_square[r]:
                row2, col2 = r, right_square[r].index(bigram[1])

        # Расшифровываем биграмму
        if row1 is not None and row2 is not None:
            if row1 == row2:  # Одна строка
                decrypted_message += left_square[row1][col1] + right_square[row2][col2]
            else:  # Прямоугольник
                decrypted_message += left_square[row1][col1] + right_square[row2][col2]

    return decrypted_message
# Пример использования
key_left = "SECURITY"
key_right = "ANOTHERKEY"
left_square = create_square(key_left)
right_square = create_square(key_right)

# Шифруем сообщение
original_message = "ABCDEF"
bigrams_list = bigrams(original_message)
encrypted = encrypt_bigrams(bigrams_list, left_square, right_square)

# Расшифровка
decrypted_bigrams = bigrams(encrypted)
decrypted = decrypt_bigrams(decrypted_bigrams, left_square, right_square)

print("Исходное сообщение:", original_message)
print("Биграммы:", bigrams_list)
print("Зашифрованное сообщение:", encrypted)
print("Расшифрованное сообщение:", original_message)

print("\nЛевый квадрат:")
for row in left_square:
    print(' '.join(row))

print("\nПравый квадрат:")
for row in right_square:
    print(' '.join(row))