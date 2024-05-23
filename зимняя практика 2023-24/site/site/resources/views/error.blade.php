<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .error-container {
            text-align: center;
            padding: 20px;
            border-radius: 5px;
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #dc3545;
        }

        p {
            color: #6c757d;
            font-size: 1.2em;
        }

        a {
            text-decoration: none;
            color: #007bff;
            font-weight: bold;
        }
    </style>
</head>

<body>
<div class="error-container">
    <h1>Oops! Something went wrong.</h1>
    <p>{{$error}}</p>
    <p>Попробуйте снова или свяжитесь с нами по почте: support@example.com</p>
</div>
</body>

</html>
