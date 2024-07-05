@extends('v1.layouts.app')
@section('title' , 'Задачи')
@section('body')
    <p>Количество: {{ $products->total() }} @choice('единица|едц.', $products->total())</p>
    @if($products->count() > 0)
        @foreach($products as $product)
            <div class="nk-tb-item nk-tb-head">
                <div class="nk-tb-col"><span class="sub-text">ID:{{$product->id}}</span></div>
                <div class="nk-tb-col"><span class="sub-text">Задача:{{$product->name}}</span></div>
                <div class="nk-tb-col"><span class="sub-text">Категория задачи:{{$product->category->name}}</span></div>
                <div class="nk-tb-col"><span class="sub-text">Описание задачи:{{$product->description}}</span></div>
                <div class="nk-tb-col"><span class="sub-text">Статус задачи:{{$product->status}}</span></div>
                @foreach($product->getMedia('media') as $image)
                    <div class="col-sm-6 col-lg-4 col-xxl-3" id="model-media-{{$image->id}}">
                        <div class="gallery card card-bordered">
                            <a class="gallery-image popup-image" href="{{$image->getUrl()}}">
                                <img class="w-100 rounded-top" src="{{$image->getUrl()}}" alt="">
                            </a>
                            <div class="gallery-body card-inner align-center justify-between flex-wrap g-2">
                                <div class="user-card">
                                    <div class="user-info">
                                        <span class="lead-text">#{{$image->id}} - {{$image->name}}</span>
                                    </div>
                                </div>
                                <div>
                                    <a id="model-media-delete-{{$image->id}}" href="#" data-id="{{$image->id}}"
                                       data-model-id="{{$product->id}}"
                                       class="product-media-delete btn btn-p-0 btn-nofocus" title="Удалить"><em
                                            class="icon ni ni-trash"></em></a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                <ul class="link-list-opt no-bdr">
                    <li><a href="{{route('products.edit' , $product)}}" data-id="{{$product->id}}">
                            <em class="icon ni ni-edit"></em><span>Редактировать</span></a></li>
                    <li>
                        <form action="{{route('products.delete' , $product)}}" method="POST">
                            @csrf
                            <button type="submit" class="product-delete" id="product-delete-{{$product->id}}"
                                    data-id="{{$product->id}}">Удалить
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        @endforeach
    @else
        <p>На данный момент задач нет</p>
    @endif
    <a href="{{route('products.create')}}" class="btn btn-primary">Добавить задачу</a>
@endsection
