@extends('v1.layouts.app')
@section('title' , 'Пользователи')
@section('body')
    <h2>Добавить пользователя</h2>
    <form action="{{route('users.store')}}" method="POST">
        @csrf
        <label for="employee">Имя:</label>
        <input type="text" id="first_name" name="first_name" required>
        <br>
        <label for="employee">Фамилия:</label>
        <input type="text" id="last_name" name="last_name" required>
        <br>
        <label for="employee">Email:</label>
        <input type="email" id="email" name="email" required>
        <br>
        <label for="employee">Пароль:</label>
        <input type="password" id="password" name="password" required>
        <br>
        <button type="submit">Добавить</button>
    </form>
@endsection
