class LCG:
    def __init__(self, a, b, m, Y0, Y1):
        self.a = a
        self.b = b
        self.m = m
        self.Y = [Y0, Y1]

    def next(self):
        new_value = (self.a * self.Y[-1] + self.b) % self.m
        self.Y.append(new_value)
        return new_value

    def generate_stream(self, length):
        return [self.next() for _ in range(length)]


def xor_string(s, key):
    return ''.join(chr(ord(c) ^ k) for c, k in zip(s, key))


def main():
    # Входные данные
    message = input("Введите сообщение: ")

    # Параметры LCG
    a = 5
    b = 7
    m = 4096
    Y0 = 4003
    Y1 = 59

    # Генерация гаммы
    lcg = LCG(a, b, m, Y0, Y1)
    key_stream = lcg.generate_stream(len(message))

    # Шифрование
    encrypted_message = xor_string(message, key_stream)
    print("Зашифрованное сообщение:", encrypted_message)

    # Расшифрование (то же самое, что и шифрование)
    decrypted_message = xor_string(encrypted_message, key_stream)
    print("Расшифрованное сообщение:", decrypted_message)
if __name__ == "__main__":
    main()
