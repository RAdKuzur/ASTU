import random
def create_random_square():
    alphabet = list("ABCDEFGHIKLMNOPQRSTUVWXYZ")  # Искомый алфавит без J
    random.shuffle(alphabet)  # Перемешиваем буквы
    return alphabet
def create_bigrams(message):
    message = message.upper().replace('J', 'I')
    bigrams = []
    i = 0
    while i < len(message):
        first = message[i]
        if i + 1 < len(message):
            second = message[i + 1]
            if first == second:  # если одинаковые буквы
                bigrams.append(first + 'X')
                i += 1
            else:
                bigrams.append(first + second)
                i += 2
        else:  # если осталась одна буква
            bigrams.append(first + 'X')
            i += 1
    return bigrams
def find_position(square, char):
    index = square.index(char)
    return index // 5, index % 5  # строчка и столбец
def encrypt_wheatstone(message):
    square = create_random_square()
    bigrams = create_bigrams(message)
    encrypted_message = []
    for bigram in bigrams:
        r1, c1 = find_position(square, bigram[0])
        r2, c2 = find_position(square, bigram[1])
        if r1 == r2:  # одна строка
            encrypted_message.append(square[r1 * 5 + (c1 + 1) % 5])
            encrypted_message.append(square[r2 * 5 + (c2 + 1) % 5])
        elif c1 == c2:  # один столбец
            encrypted_message.append(square[((r1 + 1) % 5) * 5 + c1])
            encrypted_message.append(square[((r2 + 1) % 5) * 5 + c2])
        else:  # образуют прямоугольник
            encrypted_message.append(square[r1 * 5 + c2])
            encrypted_message.append(square[r2 * 5 + c1])
    return ''.join(encrypted_message), ''.join(square)
def decrypt_wheatstone(encrypted_message, square):
    decrypted_message = []
    bigrams = create_bigrams(encrypted_message)  # Используем ту же логику для биграмм
    for bigram in bigrams:
        r1, c1 = find_position(square, bigram[0])
        r2, c2 = find_position(square, bigram[1])
        if r1 == r2:  # одна строка
            decrypted_message.append(square[r1 * 5 + (c1 - 1) % 5])
            decrypted_message.append(square[r2 * 5 + (c2 - 1) % 5])
        elif c1 == c2:  # один столбец
            decrypted_message.append(square[((r1 - 1) % 5) * 5 + c1])
            decrypted_message.append(square[((r2 - 1) % 5) * 5 + c2])
        else:  # образуют прямоугольник
            decrypted_message.append(square[r1 * 5 + c2])
            decrypted_message.append(square[r2 * 5 + c1])
    return ''.join(decrypted_message)
# Пример использования
message = input("Введите сообщение для шифрования: ")
encrypted, square = encrypt_wheatstone(message)
print("Зашифрованное сообщение:", encrypted)
print("Случайная таблица:", square)
index = 0
while(index < 25):
    print(square[index], square[index+1], square[index+2], square[index+3],  square[index+4])
    index = index + 5
decrypted = decrypt_wheatstone(encrypted, square)
print("Расшифрованное сообщение:", decrypted)