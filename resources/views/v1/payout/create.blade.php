@extends('v1.layouts.app')
@section('title' , 'Выплаты')
@section('body')
    <h2>Добавить выплату</h2>
    <form action="{{route('payouts.store')}} " method="POST">
        @csrf
        @if($users->count() > 0)
            <select name="user_id" id="user_id" required>
                <option value="">Выберите пользователя</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        @else()
            <p>Пользователи не найдены</p>
        @endif

        @if($products->count() > 0)
            @foreach($products as $product)
                <select name="product_id" id="product_id" required>
                    <option value="">Выберите задачу</option>
                    <option value="{{ $product->id }}">{{$product->name}}</option>
                </select>
            @endforeach
        @else()
            <p>Задачи не найдены</p>
        @endif
        <br>
        <select name="status" id="status" required>
            @foreach($statuses as $status)
                <option value="{{$status}}">{{ $status }}</option>
            @endforeach
        </select>
        <br>
        <label for="employee">Сумма:</label>
        <input type="text" id="price" name="price" required>
        <button type="submit">Добавить</button>
    </form>
@endsection
