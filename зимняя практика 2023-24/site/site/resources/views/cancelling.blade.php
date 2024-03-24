<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel = "stylesheet" type="text/css" href="../css/bootstrap.css">
        <link rel = "stylesheet" type="text/css" href="../css/main.css">
        <link rel="shortcut icon" href="/img/bus.png" type="image/png"> 
    <title>Отмена</title>
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
        <div id = "div-button-4"><h4 id = "title-2">Отмена бронирования</h4>
            <form action = "{{route('cancelling')}}" method="POST">
                @csrf
                <div id = "cancelling-1">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Код бронирования</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name = "booking_code">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Код безопасности</label>
                        <input type="text" class="form-control" id="exampleInputPassword1" name = "secuirity_code">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary" id = "button_cancel-1">Отменить бронирования</button>
            </form>
        
        
        
        </div>




    </body>
</html>
