@extends('v1.layouts.app')
@section('title' , 'Редактировать категорию')
@section('body')
    <h2>Редактировать категорию</h2>
    <form action="{{route('categories.update' , $category)}}" method="POST">
        @csrf
        <label for="employee">Имя категории:</label>
        <input type="text" id="name" name="name" value="{{$category->name}}"  required>
        <select name="status" id="status" required>
            @foreach(App\Enums\CategoryStatuses::getAll() as $status)
                <option value="{{ $status }}">{{ $status }}</option>
            @endforeach
        </select>
        <button type="submit">Сохранить</button>
    </form>
@endsection
