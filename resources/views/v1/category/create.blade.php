@extends('v1.layouts.app')
@section('title' , 'Добавить категорию')
@section('body')
    <h2>Добавить категорию</h2>
    <form action="{{route('categories.store')}}" method="POST">
        @csrf
        <label for="employee">Категория:</label>
        <input type="text" id="name" name="name" required>
        <select name="status" id="status" required>
            @foreach(App\Enums\CategoryStatuses::getAll() as $status)
                <option value="{{ $status }}">{{ $status }}</option>
            @endforeach
        </select>
        <button type="submit">Добавить</button>
    </form>
@endsection
