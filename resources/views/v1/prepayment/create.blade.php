@extends('v1.layouts.app')
@section('title' , 'Аванс')
@section('body')
    <h2>Добавить аванс</h2>
    <form action="{{route('prepayments.store')}}" method="POST">
        @csrf
        <select name="user_id" id="user_id" required>
            <option value="">Выберите пользователя</option>
            @foreach($users as $user)
                <option value="{{ $user->id }}">{{ $user->name }}</option>
            @endforeach
        </select>
        <br>
        <select name="payout_id" id="payout_id" required>
            <option value="">Выберите выплату</option>
            @foreach($payouts as  $payout)
                <option value="{{$payout->id}}">ID:{{$payout->id}}</option>
            @endforeach
        </select>
        <br>
        <label for="employee">Сумма:</label>
        <input type="text" id="amount" name="amount" required>
        <button type="submit">Добавить</button>
    </form>
@endsection
