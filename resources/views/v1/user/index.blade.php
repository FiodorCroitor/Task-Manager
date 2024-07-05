@extends('v1.layouts.app')
@section('title' , 'Пользователи')
@section('body')
    <p>Количество: {{ $users->total() }} @choice('единица|едц.', $users->total())</p>
    @foreach($users as $user)
        <div class="nk-tb-item nk-tb-head">
            <div class="nk-tb-col"><span class="sub-text">ID:{{$user->id}}</span></div>
            <div class="nk-tb-col"><span class="sub-text">Имя:{{$user->profile->first_name}}</span></div>
            <div class="nk-tb-col"><span class="sub-text">Фамилия:{{$user->profile->last_name}}</span></div>
            <div class="nk-tb-col"><span class="sub-text">Email:{{$user->email}}</span></div>
            <div class="nk-tb-col"><span class="sub-text">Пароль:{{$user->password}}</span></div>
            <br>
        </div>
        <ul class="link-list-opt no-bdr">
        <li><a href="{{route('users.edit' , $user)}}" data-id="{{$user->id}}">
                <em class="icon ni ni-edit"></em><span>Редактировать</span></a></li>
            <li>
                <form action="{{route('users.delete' , $user)}}" method="POST">
                    @csrf
                    <button type="submit" class="product-delete" id="product-delete-{{$user->id}}"
                            data-id="{{$user->id}}">Удалить
                    </button>
                </form>
            </li>
        </ul>
    @endforeach
    <a href="{{route('users.create')}}" class="nk-btn nk-btn-rounded nk-btn-outline nk-btn-color-main-1">Добавить</a>
@endsection
