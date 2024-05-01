<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel = "stylesheet" type="text/css" href="../css/bootstrap.css">
    <link rel = "stylesheet" type="text/css" href="../css/main.css">
    <link rel="shortcut icon" href="/img/bus.png" type="image/png">
    <title>Рейсы</title>
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
    </body>
<div id = "div-1">
    <div id = "div-2">
        <h3>Расписание рейсов:</h3>
        <form action = "{{route('run_post')}}" method="POST">
            @csrf
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Маршрут</th>
                <th scope="col">Автобус</th>
                <th scope="col">Перевозчик</th>
                <th scope="col">Время отправления</th>
                <th scope="col">Время прибытия</th>
                <th scope="col">Статус</th>
                <th scope="col">Действия</th>
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
                    <td><button type="submit" class="btn btn-danger" name = "delete" value= "{{$run->run_id}}">Удалить</button></td>
                </tr>
            @endforeach
            </tbody>
        </table>
        </form>
    </div>
</div>
<div id = "div-1">
    <div id = "div-2">
        <h3>Добавление рейса:</h3>
        <form action = "{{route('run_post')}}" method="POST">
            @csrf
            <select class="form-select" aria-label="Выберите автобус" id = "select-box" name = "carrier">
                <option selected>Выберите перевозчика</option>
                @foreach($carriers as $carrier)
                    <option value="{{$carrier->id}}">{{$carrier->name}}</option>
                @endforeach
            </select>
            </br>
            </br>
            <select class="form-select" aria-label="Выберите автобус" id = "select-box" name = "bus">
                <option selected>Выберите автобус</option>
                @foreach($buses as $bus)
                    @if($bus->status != 2)
                    <option value="{{$bus->id}}">{{$bus->brand}}  {{$bus->brand}}  {{$bus->number}}</option>
                    @endif
                @endforeach
            </select>
            </br>
            </br>
            <select class="form-select" aria-label="Выберите автобус" id = "select-box" name = "route">
                <option selected>Выберите маршрут</option>
                @foreach($routes as $route)
                    <option value="{{$route->id}}">{{$route->departure_city}}  ---  {{$route->arrival_city}}</option>
                @endforeach
            </select>
            </br>
            </br>
            <div>
                <h5 >Укажите время отправления и прибытия</h5>
                <input type="datetime-local" placeholder="время отправления" name = "dep_time"/>
                <input type="datetime-local" placeholder="время прибытия" name = "arr_time"/>
            </div>
            <div>
                <h5 >Укажите цену билета</h5>
                <input type="text" placeholder="Цена билета" name = "price"/>
            </div>
            </br>
            </br>
            <button type="submit" class="btn btn-primary">Добавить</button>
        </form>
    </div>
</div>
</html>
