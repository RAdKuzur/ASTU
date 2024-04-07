<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel = "stylesheet" type="text/css" href="../css/bootstrap.css">
        <link rel = "stylesheet" type="text/css" href="../css/main.css">
        <link rel="shortcut icon" href="/img/bus.png" type="image/png">
    <title>Главная страница</title>
    </head>
    <body id = "body-2">
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
        <img src = "/img/bus7.jpg" alt = "Картинка автобуса" id = "image-2">
        <div id = "text-2" class = "container">
            <h3>ПАССАЖИРСКИЕ ПЕРЕВОЗКИ</h3>
            <h4 id = "text-3">Профессиональные водители с отзывами, рейтингами и фото, выгодные цены, разные автомобили. Отличные цены, проверенные машины!</h4>
            <a href="../purchase">
            <button type="button" class="btn btn-success" id = "button-1">КУПИТЬ БИЛЕТЫ</button>
            </a>
            <a href="../schedule">
            <button type="button" class="btn btn-light">РАСПИСАНИЕ РЕЙСОВ</button>
            </a>

        </div>
        <img src = "/img/bus5.jpg" alt = "Картинка автобуса" id = "image-3">
        <div id = "text-4">
            <div id = "text-5">
            <h1 id = "top-1" >О НАШЕМ АВТОВОКЗАЛЕ</h1></br>
            <p id = "text-6">Описание автовокзала нужно вставить сюда тем же шрифтом и тем же размером текста. Описание вокзала нужно вставить сюда тем же шрифтом и тем же размером текста.</p>
            <button type="button" class="btn btn-primary" id = "button-2">УЗНАТЬ ПОДРОБНЕЕ</button>
            </div>
        </div>
        <div id = text-7 class = "container">
            <p id = "text-8">ЗДЕСЬ БУДЕТ ТОЖЕ ОПИСАНИЕ АВТОВОКЗАЛА</p>
            <p id = "text-9">Описание текста ниже в 2 предложениях</p>
            <p id = "text-10">Если у вас есть возможность увидеть только один город в Италии, то пусть это будет Рим, великий, многогранный, одновременно шумный и уютный, узнаваемый и не до конца известный. Ехать на 2-3 дня сюда, если вы едете впервые и в город, и в страну, — не самая лучшая идея. Неделя — вот то количество времени, которое можно считать адекватным.
            </br></br>Планируя свои дни в городе, пожалуйста, отведите достаточно времени на то, чтобы увидеть не только Колизей, Испанскую лестницу, площадь Навона и обалдеть от красоты и количества туристов, но и для того, чтобы познакомиться с другим, жилым, спокойным, но не менее красивым Римом. </p>
        </div>
        <div>
            <div id = "block-1" >
                <div class = "block-2 container"><img src = "/img/man.webp"  class = "man-photo"> <div class = "text-11 container">Сотрудник 1</br></br> Информация о сотруднике</div></div>

                <div class = "block-2 container"><img src = "/img/man.webp"  class = "man-photo"> <div class = "text-11 container">Сотрудник 2</br></br> Информация о сотруднике</div></div>
                <div class = "block-2 container"><img src = "/img/man.webp"  class = "man-photo"><div class = "text-11 container">Сотрудник 3</br></br> Информация о сотруднике</div></div>
                <div class = "block-2 container"><img src = "/img/man.webp"  class = "man-photo"><div class = "text-11 container">Сотрудник 4</br></br> Информация о сотруднике</div> </div>
                <div class = "block-2 container"><img src = "/img/man.webp"  class = "man-photo"><div class = "text-11 container">Сотрудник 5</br></br> Информация о сотруднике</div> </div>
                <div class = "block-2 container"><img src = "/img/man.webp"  class = "man-photo"> <div class = "text-11 container">Сотрудник 6</br></br>Информация о сотруднике</div></div>

            </div>

        </div>



    </body>
</html>
