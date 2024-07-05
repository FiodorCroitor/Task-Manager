<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <title>@yield('title')</title>
</head>
<body>
<nav>
    <ul>
        <li><a href="{{route('dashboard.index')}}">Главная</a></li>
        <li><a href="{{route('categories.index')}}">Категории</a></li>
        <li><a href="{{route('products.index')}}">Задачи</a></li>
        <li><a href="{{route('payouts.index')}}">Выплаты</a></li>
        <li><a href="{{route('prepayments.index')}}">Авансы</a></li>
        <li><a href="{{route('users.index')}}">Пользователи</a></li>

        @auth
            <li class="user-info" style="float: right;">
                <a href="#">
                    {{ Auth::user()->name }}

                    <span></span>
                </a>
                <a href="{{ route('auth.logout') }}"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Выйти
                </a>
                <form id="logout-form" action="{{ route('auth.logout') }}" method="GET" style="display: none;">
                    @csrf
                </form>
            </li>
        @endauth

    </ul>
</nav>
@yield('body')
</body>
</html>
