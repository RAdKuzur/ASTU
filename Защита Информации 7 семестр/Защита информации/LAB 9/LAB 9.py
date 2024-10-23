import random


def generate_key(length, m):
    """Сгенерировать случайную ключевую последовательность."""
    return [random.randint(0, m - 1) for _ in range(length)]


def encrypt(plaintext, key):
    """Зашифровать сообщение методом Цезаря с использованием ключа."""
    m = 26  # Количество символов в алфавите (например, 26 для английского)
    ciphertext = []

    for i in range(len(plaintext)):
        if plaintext[i].isalpha():  # Проверка на буквы
            shift = key[i] % m
            if plaintext[i].isupper():
                encrypted_char = chr((ord(plaintext[i]) - ord('A') + shift) % m + ord('A'))
            else:
                encrypted_char = chr((ord(plaintext[i]) - ord('a') + shift) % m + ord('a'))
            ciphertext.append(encrypted_char)
        else:
            ciphertext.append(plaintext[i])  # Не изменяем символы, не являющиеся буквами

    return ''.join(ciphertext)


def decrypt(ciphertext, key):
    """Расшифровать сообщение методом Цезаря с использованием ключа."""
    m = 26  # Количество символов в алфавите (например, 26 для английского)
    decrypted_text = []

    for i in range(len(ciphertext)):
        if ciphertext[i].isalpha():  # Проверка на буквы
            shift = key[i] % m
            if ciphertext[i].isupper():
                decrypted_char = chr((ord(ciphertext[i]) - ord('A') - shift + m) % m + ord('A'))
            else:
                decrypted_char = chr((ord(ciphertext[i]) - ord('a') - shift + m) % m + ord('a'))
            decrypted_text.append(decrypted_char)
        else:
            decrypted_text.append(ciphertext[i])  # Не изменяем символы, не являющиеся буквами

    return ''.join(decrypted_text)


# Пример использования:
print("Введите сообщение:")
message = input()
key_length = len(message.replace(" ", ""))  # Длина ключа, игнорируя пробелы
key = generate_key(key_length, 26)

print(f"Начальное сообщение: {message}")
print(f"Ключ: {key}")

encrypted_message = encrypt(message, key)
print(f"Зашифрованное сообщение: {encrypted_message}")

decrypted_message = decrypt(encrypted_message, key)
print(f"Зашифрованное сообщение: {decrypted_message}")