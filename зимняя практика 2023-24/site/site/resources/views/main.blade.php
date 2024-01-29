<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel = "stylesheet" type="text/css" href="../css/bootstrap.css">
        <link rel = "stylesheet" type="text/css" href="../css/main.css">
        <link rel="shortcut icon" href="/img/bus.png" type="image/png"> 
    <title>Авторизация</title>
    </head>
    <body id = "body-1">    
        <header id= "header">
            <div id = "head">
                <img src="/img/bus3.jpg" alt="Логотип" id = "image-1">
                <span id="nav">
                    <span class = "panel">Главная</span>
                    <span class = "panel">О нас</span>
                    <span class = "panel">Услуги</span>
                    <span class = "panel">Контакты</span>
                    <span class = "panel">Войти</span>
                    <span class = "panel">Зарегистрироваться</span>


                </span>
            </div>
        </header>
        <div class = "form-auth">
            <h3 id = "text-1">Вход в систему</h3>
        <form>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Электронная почта</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Пароль</label>
                <input type="password" class="form-control" id="exampleInputPassword1">
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Запомнить меня</label>
            </div>
            <button type="submit" class="btn btn-primary">Войти</button>
        </form>
        </div>

    </body>
</html>
