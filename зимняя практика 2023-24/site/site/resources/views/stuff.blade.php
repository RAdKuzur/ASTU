<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel = "stylesheet" type="text/css" href="../css/bootstrap.css">
    <link rel = "stylesheet" type="text/css" href="../css/main.css">
    <link rel="shortcut icon" href="/img/bus.png" type="image/png">
    <title>Для сотрудников</title>
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
<a href="stuff/run" class = "ref-2" text-decoration="none"><div id = "div-button-1"><h2 class="ref-1">Рейсы</h2></div></a>
<a href="stuff/other" class = "ref-2" text-decoration="none"><div id = "div-button-1"><h2 class="ref-1">Перевозчики, автобусы и другое</h2></div></a>
<a href="stuff/comment" class = "ref-2" text-decoration="none"><div id = "div-button-1"><h2 class="ref-1">Отзывы</h2></div></a>

</body>
</html>
