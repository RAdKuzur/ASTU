
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel = "stylesheet" type="text/css" href="../css/bootstrap.css">
    <link rel = "stylesheet" type="text/css" href="../css/main.css">
    <link rel="shortcut icon" href="/img/bus.png" type="image/png">
    <title>Профиль</title>
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
        <h1>Мой профиль:</h1></br>
        <h3>Почта:</h3>{{$login_query['email']}}
        <h3>Ваши персональные данные(фамилия и имя):</h3>
        <h6>{{$login_query['surname']}} {{$login_query['name']}}</h6>
        <h3>Серия и номер паспорта:</h3>
        <h6>{{$login_query['passport_series']}} {{$login_query['passport_number']}}</h6>
    </div>
    <form action = "{{route('profile_post')}}" method="POST">
        @csrf
        <div id = "div-3">
            <button type="submit" class="btn btn-primary">Выйти</button>
        </div>
    </form>
</div>
<div id = "div-1">
    <div id = "div-2">
        <h1>Мои бронирования:</h1></br>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Код бронирования</th>
                <th scope="col">Маршрут</th>
                <th scope="col">Автобус</th>
                <th scope="col">Место</th>
                <th scope="col">Пассажир</th>
                <th scope="col">Время рейса</th>
                <th scope="col">Цена за билет</th>
            </tr>
            </thead>
            <tbody>
            @if ($bookings != null)
                @foreach($bookings as $booking)
                    <tr>
                        <td>{{$booking['id']}}</td>
                        <td>{{$booking['departure_city_name']}}---{{$booking['arrival_city_name']}}</td>
                        <td>{{$booking['brand']}} {{$booking['model']}} {{$booking['reg_number']}} </td>
                        <td>{{$booking['number']}}</td>
                        <td>{{$login_query['surname']}} {{$login_query['name']}}</td>
                        <td>{{$booking['departure_time']}}  {{$booking['arrival_time']}}</td>
                        <td>{{$booking['price']}}</td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
