
<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel = "stylesheet" type="text/css" href="../css/bootstrap.css">
    <link rel = "stylesheet" type="text/css" href="../css/main.css">
    <link rel="shortcut icon" href="/img/bus.png" type="image/png">
    <title>Прочее</title>
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
<div id = "div-other-1">
    <div id = "div-2">
        <h3>Добавление городов:</h3>
        <form action = "{{route('other_post')}}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Введите название населённого пункта</label>
                <input class="form-control" type="text" placeholder="Название населённого пункта" name = "city">
            </div>
            <button type="submit" class="btn btn-primary">Добавить город</button>
        </form>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">№</th>
                <th scope="col">Населённый пункт</th>
            </tr>
            </thead>
            <tbody>
            @foreach($cities as $city)
            <tr>
                <td>{{$first_counter++}}</td>
                <td>{{$city->name}}</td>
                <td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
<div id = "div-other-1">
    <div id = "div-2">
        <h3>Добавление автобусов:</h3></br>
        <h3>Выберите автобус:</h3>
        <form action = "{{route('other_post')}}" method="POST">
            @csrf
            <select class="form-select" aria-label="Выберите автобус" id = "select-box" name = "bus">
                <option selected>Выберите автобус</option>
                @foreach($model_buses as $m_bus)
                    <option value="{{$m_bus->id}}">{{$m_bus->brand}}  {{$m_bus->model}}</option>
                @endforeach
            </select>
            </br>  </br>
            <input class="form-control" type="text" id = "input-other" placeholder="Введите регистрационный номер" name = "number">
            </br>
            <input class="form-control" type="text" id = "input-other"placeholder="Введите вместимость автобуса" name = "seats">
            </br>
            <select class="form-select" aria-label="Выберите статус состояния автобуса" id = "select-box" name = "status">
                <option selected>Выберите статус</option>
                    <option value="1">Готов к эксплуатации</option>
                    <option value="2">В ремонте/нуждается в ремонте</option>
            </select>
            </br>
            </br>
            <button type="submit" class="btn btn-primary">Добавить</button>
        </form>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">№</th>
                <th scope="col">Марка автобуса</th>
                <th scope="col">Регистрационный номер</th>
                <th scope="col">Вместимость</th>
                <th scope="col">Статус</th>
            </tr>
            </thead>
            <tbody>
            @foreach($buses as $bus)
                <tr>
                    <td>{{$second_counter++}}</td>
                    <td>{{$bus->brand}}  {{$bus->model}}</td>
                    <td>{{$bus->number}}</td>
                    <td>{{$bus->seats}}</td>
                    @if($bus->status == 1)
                        <td>Готов к эксплуатации</td>
                    @else
                        <td>В ремонте/нуждается в ремонте</td>
                    @endif
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
<div id = "div-other-1">
    <div id = "div-2">
        <h3>Добавление перевозчиков:</h3>
        <form action = "{{route('other_post')}}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Введите название перевозчика</label>
                <input class="form-control" type="text" placeholder="Название перевозчика" name = "carrier">
            </div>
            <button type="submit" class="btn btn-primary">Добавить перевозчика</button>
        </form>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">№</th>
                <th scope="col">Перевозчик</th>
            </tr>
            </thead>
            <tbody>
            @foreach($carriers as $carrier)
                <tr>
                    <td>{{$third_counter++}}</td>
                    <td>{{$carrier->name}}</td>
                    <td>
                </tr>
            @endforeach

            </tbody>
        </table>
    </div>
</div>
<div id = "div-other-1">
    <div id = "div-2">
        <h3>Добавление маршрута:</h3>
        <form action = "{{route('other_post')}}" method="POST">
            @csrf
            <h3>Выберите города отбытия</h3>
            <select class="form-select" aria-label="Выберите город" id = "select-box" name = "city_1">
                <option selected>Выберите город отправления</option>
                @foreach($cities as $city)
                    <option value="{{$city->id}}">{{$city->name}}</option>
                @endforeach
            </select>
            </br>
            <h3>Выберите города прибытия</h3>
            <select class="form-select" aria-label="Выберите город" id = "select-box" name = "city_2">
                <option selected>Выберите город прибытия</option>
                @foreach($cities as $city)
                    <option value="{{$city->id}}">{{$city->name}}</option>
                @endforeach
            </select>
            </br>  </br>
            <button type="submit" class="btn btn-primary">Добавить маршрут</button>
            </br>  </br>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Город отправления</th>
                    <th scope="col">Город прибытия</th>
                </tr>
                </thead>
                <tbody>
                @foreach($routes as $route)
                    <tr>
                        <td>{{$route->departure_city_name}}</td>
                        <td>{{$route->arrival_city_name}}</td>
                        <td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </form>
    </div>
</div>
</body>
</html>
