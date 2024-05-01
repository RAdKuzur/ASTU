<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel = "stylesheet" type="text/css" href="../css/bootstrap.css">
    <link rel = "stylesheet" type="text/css" href="../css/main.css">
    <link rel="shortcut icon" href="/img/bus.png" type="image/png">
    <title>Расписание</title>
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
<div id = "div-1">
    <div id = "div-2">
        <h3>Расписание рейсов:</h3>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Маршрут</th>
                <th scope="col">Автобус</th>
                <th scope="col">Перевозчик</th>
                <th scope="col">Время отправления</th>
                <th scope="col">Время прибытия</th>
                <th scope="col">Статус</th>
            </tr>
            </thead>
            <tbody>
            @foreach($runs as $run)
                <tr>
                    <td>{{$run->departure_city}}---{{$run->arrival_city}}</td>
                    <td>{{$run->brand}} {{$run->model}} {{$run->number}}</td>
                    <td>{{$run->name}}</td>
                    <td>{{$run->departure_time}}</td>
                    <td>{{$run->arrival_time}}</td>
                    @if($run->status == "0")
                        <td>Рейс запланирован</td>
                    @endif
                    @if($run->status == "1")
                        <td>В пути</td>
                    @endif
                    @if($run->status == "2")
                        <td>Рейс завершён</td>
                    @endif
                </tr>
            @endforeach
            </tbody>
        </table>

    </div>
</div>
</body>
</html>
