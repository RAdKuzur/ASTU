<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel = "stylesheet" type="text/css" href="../css/bootstrap.css">
        <link rel = "stylesheet" type="text/css" href="../css/main.css">
        <link rel="shortcut icon" href="/img/bus.png" type="image/png">
    <title>Регистрация</title>
    </head>
    <body id = "body-1">
        <header id= "header">
            <div id = "head">
                <img src="/img/bus3.jpg" alt="Логотип" id = "image-1">
                <div id="nav">
                    <span class = "panel"><a href="../main" class="navigation-reff">Главная</a></span>
                    <span class = "panel"><a href="../stuff" class="navigation-reff">Для сотрудников</a></span>
                    <span class = "panel"><a href="../purchase" class="navigation-reff">Услуги</a></span>
                    <span class = "panel"><a href="../contacts" class="navigation-reff">Контакты</a></span>
                    @if(session('key')==null)
                    <span class = "panel"><a href="../login" class="navigation-reff">Войти</a></span>
                    <span class = "panel"><a href="../register" class="navigation-reff">Зарегистрироваться</a></span>
                    @endif
                    @if(session('key')!=null)
                        <span class = "panel"><a href="../profile" class="navigation-reff">Профиль</a></span>
                    @endif
                </div>
            </div>
        </header>
        <div class = "form-auth">
            <h3 id = "text-1">Регистрация</h3>
        <form action = "{{route('register')}}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Фамилия</label>
                <input type="text" class="form-control" id="surname" name = "surname">
            </div>
            <div class="mb-3">
                <label  class="form-label">Имя</label>
                <input type="text" class="form-control" id="name"  name = "name">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Электронная почта</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name = "email">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Пароль</label>
                <input type="password" class="form-control" id="exampleInputPassword1" name = "password">
            </div>
            <div class="mb-3">
                <label  class="form-label">Серия паспорта</label>
                <input type="text" class="form-control" id="serial"  name = "serial">
            </div>
            <div class="mb-3">
                <label  class="form-label">Номер паспорта</label>
                <input type="text" class="form-control" id="number"  name = "number">
            </div>
            <button type="submit" class="btn btn-primary">Зарегистрироваться</button>
        </form>
        </div>

    </body>
</html>
