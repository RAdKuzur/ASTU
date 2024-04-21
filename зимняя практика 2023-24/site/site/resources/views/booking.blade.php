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
        <form action = "{{route('booking')}}" method="POST">
            @csrf
        <div id = "div-button-2"><h4>Выберите направление</h4>
            <div id = "title-1"><h5>Город отправления                                      Город прибытия                                           Дата отправления</h5></div>
            <div id = "selector-1">
            <select class="form-select" aria-label="Default select example" id = "select-box" name = "city_1">
                <option selected>Выберите город отправления</option>
                @foreach($cities as $city)
                    <option value="{{$city->id}}">{{$city->name}}</option>
                @endforeach
            </select>
            <select class="form-select" aria-label="Default select example" id = "select-box" name = "city_2">
                <option selected>Выберите город назначения</option>
                @foreach($cities as $city)
                    <option value="{{$city->id}}">{{$city->name}}</option>
                @endforeach

            </select>
            <select class="form-select" aria-label="Default select example" id = "select-box" name = "date_1">
                <option selected>Open this select menu</option>
                <option value="1">One</option>
                <option value="2">Two</option>
                <option value="3">Three</option>
            </select>
            <button type="submit" class="btn btn-primary">Бронировать</button>
            </div>
        </div>
        </form>
        <div id = "div-button-3"><h4>Доступные билеты</h4>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Город отправления</th>
                    <th scope="col">Город прибытия</th>
                    <th scope="col">Забронировать</th>
                    </tr>
                </thead>
                <tbody>
                @if ($runs != null)
                @foreach($runs as $run)
                    @if($run->status == 'Scheduled')
                    <tr>
                        <th scope="row"></th>
                        <td>{{$run->departure_time}}</td>
                        <td>{{$run->arrival_time}}</td>
                        <td><a href="/purchase/booking/{{$run->id}}">
                <button type="button" class="btn btn-primary">Забронировать место</button>
                </a></td>
                    </tr>
                    @endif
                @endforeach
                @endif
                </tbody>
            </table>
        </div>
    </body>
</html>
