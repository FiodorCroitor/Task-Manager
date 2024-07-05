<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7fafc;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .login-container {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .form-group button {
            width: 100%;
            padding: 10px;
            background-color: #3490dc;
            border: none;
            border-radius: 4px;
            color: white;
            font-size: 16px;
        }

        .form-group button:hover {
            background-color: #2779bd;
        }

    </style>
</head>
<body>
<div class="login-container">
    <form action="{{route('store')}}" method="POST">
        @csrf
        <div class="form-group">
            <label for="first_name">Имя</label>
            <input id="first_name" type="text" name="first_name" required>
        </div>
        <div class="form-group">
            <label for="last_name">Фамилия</label>
            <input id="last_name" type="text" name="last_name" required>
        </div>
        <div class="form-group">
            <label for="email">Почта</label>
            <input id="email" type="email" name="email" required autofocus>
        </div>
        <div class="form-group">
            <label for="password">Пароль</label>
            <input id="password" type="password" name="password" required>
        </div>
        <div class="form-group">
            <button type="submit">Зарегистрироваться</button>
        </div>
    </form>
    <div class="form-group">
        <a href="{{ route('login') }}" class="btn">Войти в аккаунт</a>
    </div>
</div>
</body>
</html>
