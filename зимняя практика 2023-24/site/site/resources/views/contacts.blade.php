<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel = "stylesheet" type="text/css" href="../css/bootstrap.css">
        <link rel = "stylesheet" type="text/css" href="../css/main.css">
        <link rel="shortcut icon" href="/img/bus.png" type="image/png"> 
    <title>Контакты</title>
    </head>
    <body id = "body-1">    
        <header id= "header"> 
            <div id = "head">
                <img src="/img/bus3.jpg" alt="Логотип" id = "image-1">
                <div id="nav">
                    <span class = "panel">Главная</span>
                    <span class = "panel">Для сотрудников</span>
                    <span class = "panel">Услуги</span>
                    <span class = "panel">Контакты</span>
                    <span class = "panel">Войти</span>
                    <span class = "panel">Зарегистрироваться</span>
                </div>
            </div>
        </header>
        <div id = "div-1">
            <div id = "div-2">
                <h1>Контактная информация</h1></br>
                <h3>Почта:</h3>mail@mail.ru</br>
                <h3>Контактный телефон:</h3>+7-777-777-77-77</br>
            </div>
            <form action = "{{route('contacts')}}" method="POST">
                @csrf
            <div id = "div-3">
                <div class="mb-3">
                    <label for="exampleFormControlTextarea0" class="form-label">Напишите ваше имя</label>
                    <input class="form-control" id="exampleFormControlTextarea0" rows="3" name = "name"></textarea>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Напишите ваш отзыв</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name = "comment"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Отправить отзыв</button>
            </div>
            </form>




        </div>



    </body>
</html>
