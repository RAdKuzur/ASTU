def affine_encrypt(message, a, b):
    encrypted_message = ""
    m = 26  # для английского алфавита

    # Проверка, что a и 26 взаимно просты
    def gcd(a, b):
        while b:
            a, b = b, a % b
        return a

    if gcd(a, m) != 1:
        raise ValueError("a должно быть взаимно простым с 26")

    for char in message:
        if char.isalpha():  # только для букв
            # Приводим к заглавным буквам
            char = char.upper()
            # Преобразуем в номер (0-25)
            x = ord(char) - ord('A')
            # Применяем формулу шифрования
            encrypted_char = (a * x + b) % m
            # Преобразуем обратно в букву
            encrypted_message += chr(encrypted_char + ord('A'))
        else:
            encrypted_message += char  # оставляем символ без изменений

    return encrypted_message
def gcd_extended(a, b):
    if a == 0:
        return b, 0, 1
    gcd, x1, y1 = gcd_extended(b % a, a)
    x = y1 - (b // a) * x1
    y = x1
    return gcd, x, y
def mod_inverse(a, m):
    gcd, x, _ = gcd_extended(a, m)
    if gcd != 1:
        raise ValueError("Обратного элемента не существует.")
    else:
        return x % m
def affine_decrypt(encrypted_message, a, b):
    decrypted_message = ""
    m = 26  # для английского алфавита

    a_inv = mod_inverse(a, m)  # находим обратный элемент

    for char in encrypted_message:
        if char.isalpha():  # только для букв
            char = char.upper()
            x = ord(char) - ord('A')
            # Применяем формулу расшифрования
            decrypted_char = (a_inv * (x - b)) % m
            decrypted_message += chr(decrypted_char + ord('A'))
        else:
            decrypted_message += char  # оставляем символ без изменений

    return decrypted_message
# Пример использования
message = input("Введите сообщение для шифрования: ")
a = int(input("Введите коэффициент a (должен быть взаимно прост с 26): "))
b = int(input("Введите смещение b: "))

encrypted = affine_encrypt(message, a, b)
decrypted = affine_decrypt(encrypted, a, b)
print("Зашифрованное сообщение:", encrypted)
print("Расшифрованное сообщение:", decrypted)
