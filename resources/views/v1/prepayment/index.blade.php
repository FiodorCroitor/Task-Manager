@extends('v1.layouts.app')
@section('title' , 'Аванс')
@section('body')
    <p>Количество: {{ $prepayments->total() }} @choice('единица|едц.', $prepayments->total())</p>
    @if($prepayments->count() > 0)
        @foreach($prepayments as $prepayment)
            <div class="nk-tb-item nk-tb-head">
                <div class="nk-tb-col"><span class="sub-text">ID Пользователя:{{$prepayment->user_id}}</span></div>
                <div class="nk-tb-col"><span class="sub-text">Имя пользователя:</span></div>
                <div class="nk-tb-col"><span class="sub-text">ID Аванса:{{$prepayment->id}}</span></div>
                <div class="nk-tb-col"><span class="sub-text">Аванс:{{$prepayment->amount}}</span></div>
                <ul class="link-list-opt no-bdr">
                    <li><a href="{{route('prepayments.edit' , $prepayment)}}" data-id="{{$prepayment->id}}">
                            <em class="icon ni ni-edit"></em><span>Редактировать</span></a></li>
                    <li>
                        <form action="{{route('prepayments.delete' , $prepayment)}}" method="POST">
                            @csrf
                            <button type="submit" class="product-delete" id="product-delete-{{$prepayment->id}}"
                                    data-id="{{$prepayment->id}}">Удалить
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        @endforeach
    @else
        <p>На данный авансов нет</p>
    @endif
    <a href="{{route('prepayments.create')}}" class="btn btn-primary">Добавить аванс</a>
@endsection
