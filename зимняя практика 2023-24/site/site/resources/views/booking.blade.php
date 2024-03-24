<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel = "stylesheet" type="text/css" href="../css/bootstrap.css">
        <link rel = "stylesheet" type="text/css" href="../css/main.css">
        <link rel="shortcut icon" href="/img/bus.png" type="image/png"> 
    <title>Бронирование</title>
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
        <form action = "{{route('booking')}}" method="POST">
            @csrf
        <div id = "div-button-2"><h4>Выберите направление</h4>
            <div id = "title-1"><h5>Город отправления                                      Город прибытия                                           Дата отправления</h5></div>
            <div id = "selector-1">
            <select class="form-select" aria-label="Default select example" id = "select-box" name = "city-1">
                <option selected>Open this select menu</option>
                <option value="1">One</option>
                <option value="2">Two</option>
                <option value="3">Three</option>
            </select>
            <select class="form-select" aria-label="Default select example" id = "select-box" name = "city-2" >
                <option selected>Open this select menu</option>
                <option value="1">One</option>
                <option value="2">Two</option>
                <option value="3">Three</option>
            </select>
            <select class="form-select" aria-label="Default select example" id = "select-box" name = "date-1">
                <option selected>Open this select menu</option>
                <option value="1">One</option>
                <option value="2">Two</option>
                <option value="3">Three</option>
            </select>
            <button type="submit" class="btn btn-primary">Бронировать</button>
            </div>
        </div>
        </form>
        <div id = "div-button-3"><h4>Доступные билеты</h4></div>
    </body>
</html>
