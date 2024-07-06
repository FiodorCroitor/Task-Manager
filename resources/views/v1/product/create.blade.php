@extends('v1.layouts.app')
@section('title' , 'Задачи')
@section('body')
    <h2>Добавить продукт</h2>
    <form action="{{route('products.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="employee">Задача:</label>
        <input type="text" id="name" name="name" required>
        <br>
        <label for="employee">Описание:</label>
        <input type="text" id="description" name="description" required>
        <br>
        @if($categories->count() > 0)
        <select name="category_id" id="category_id" required>
            <option value="">Выберите категорию</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
        @else
            <p>Категории не найдены</p>
        @endif
        <br>
        <select name="status" id="status" required>
            @foreach($statuses as $status)
                <option value="{{$status}}">{{ $status }}</option>
            @endforeach
        </select>
        <br>
        <div class="col-12">
            <div class="form-group">
                <label class="form-label">Фотографии к задаче</label>
                <div class="form-control-wrap">
                    <div class="form-file">
                        <input type="file" name="attachments[]" multiple=""  class="form-file-input"
                               id="attachments[]">
                    </div>
                </div>
            </div>
        </div>
        <br>
        <button type="submit">Добавить</button>
    </form>
@endsection
