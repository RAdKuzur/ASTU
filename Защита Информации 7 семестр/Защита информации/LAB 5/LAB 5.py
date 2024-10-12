def my_input():
    print("Введите сообщение")
    message = input()
    return message
def split(message):
    return [message[i:i+4] for i in range(0, len(message), 4)]
### МАРШРУТНАЯ ПЕРЕСТАНОВКА ###
def create_matrix(split_message):
    matrix = [
        ['0','0'],
        ['0','0']
    ]
    if len(split_message) == 1:
        matrix[0][0] = split_message[0]
    if len(split_message) == 2:
        matrix[0][0] = split_message[0]
        matrix[0][1] = split_message[1]
    if len(split_message) == 3:
        matrix[0][0] = split_message[0]
        matrix[0][1] = split_message[1]
        matrix[1][0] = split_message[2]
    if len(split_message) == 4:
        matrix[0][0] = split_message[0]
        matrix[0][1] = split_message[1]
        matrix[1][0] = split_message[2]
        matrix[1][1] = split_message[3]
    return matrix
def encode(split_message):
    code = ''
    for i in range(len(split_message)):
        matrix = create_matrix(split_message[i])
        local_code = ''
        if matrix[1][1] == '0':
            local_code = local_code + ''
        else:
            local_code = local_code + matrix[1][1]
        if matrix[0][1] == '0':
            local_code = local_code + ''
        else:
            local_code = local_code + matrix[0][1]
        if matrix[1][0] == '0':
            local_code = local_code + ''
        else:
            local_code = local_code + matrix[1][0]
        if matrix[0][0] == '0':
            local_code = local_code + ''
        else:
            local_code = local_code + matrix[0][0]
        code = code + local_code
    return code
def decode(code):
    split_code = split(code)
    decode_message = ''
    for i in range(len(split_code)):
        matrix = create_matrix(split_code[i])
        local_decode = ''
        if matrix[1][1] == '0':
            local_decode = local_decode + ''
        else:
            local_decode = local_decode + matrix[1][1]
        if matrix[0][1] == '0':
            local_decode = local_decode + ''
        else:
            local_decode = local_decode + matrix[0][1]
        if matrix[1][0] == '0':
            local_decode = local_decode + ''
        else:
            local_decode = local_decode + matrix[1][0]
        if matrix[0][0] == '0':
            local_decode = local_decode + ''
        else:
            local_decode = local_decode + matrix[0][0]
        decode_message = decode_message + local_decode
    return decode_message
def main():
    message = my_input()
    split_message = split(message)
    code = encode(split_message)
    decode_message = decode(code)
    print(' MESSAGE: ',message, '\n','CODE:', code,  '\n','DECODE_MESSAGE: ',decode_message, '\n')
### MAIN ###
main()