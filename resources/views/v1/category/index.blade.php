@extends('v1.layouts.app')
@section('title' , 'Категории')
@section('body')
    <p>Количество: {{ $categories->total() }} @choice('единица|едц.', $categories->total())</p>
    @if($categories->count() > 0)
    @foreach($categories as $category)
        <div class="nk-tb-item nk-tb-head">
            <div class="nk-tb-col"><span class="sub-text">ID:{{$category->id}}</span></div>
            <div class="nk-tb-col"><span class="sub-text">Название категории:{{$category->name}}</span></div>
            <div class="nk-tb-col"><span class="sub-text">Статус категории:{{$category->status}}</span></div>
            <ul class="link-list-opt no-bdr">
                <li><a href="{{route('categories.edit' , $category)}}" data-id="{{$category->id}}"><em
                            class="icon ni ni-edit"></em><span>Редактировать</span></a></li>
                <li>
                    <form action="{{route('categories.delete' , $category)}}" method="POST">
                        @csrf
                        <button type="submit" class="product-delete" id="product-delete-{{$category->id}}"
                                data-id="{{$category->id}}">Удалить
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    @endforeach
    @else
    <p>На данный момент категорий нет</p>
    @endif
    <a href="{{route('categories.create')}}" class="btn btn-primary">Добавить категорию</a>
@endsection
