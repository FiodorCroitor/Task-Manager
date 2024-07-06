@extends('v1.layouts.app')
@section('title' , 'Задачи')
@section('body')
    <h2>Редактировать задачу</h2>
    <form action="{{route('products.update' , $product)}}" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="employee">Задача:</label>
        <input type="text" id="name" name="name" value="{{$product->name}}" required>
        <br>
        <select name="category_id" id="category_id" required>
            <option value="">Выберите категорию</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
        <br>
        <label for="employee">Описание:</label>
        <input type="text" id="description" name="description" value="{{$product->description}}" required>
        <br>
        <select name="status" id="status" required>
            @foreach(App\Enums\ProductStatuses::getAll() as $status)
                <option value="{{ $status }}">{{ $status }}</option>
            @endforeach
        </select>
        <div class="col-12">
            <div class="form-group">
                <label class="form-label">Фотографии к товару</label>
                <div class="form-control-wrap">
                    <div class="form-file">
                        <input type="file" name="attachments[]" multiple="" class="form-file-input"
                               id="productAttachments">
                        <label class="form-file-label" for="productAttachments">Выбрать</label>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <button type="submit">Добавить</button>
    </form>
@endsection
