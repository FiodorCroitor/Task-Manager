@extends('v1.layouts.app')
@section('title', 'Выплаты')
@section('body')
    <p>Количество: {{ $payouts->total() }} @choice('единица|едц.', $payouts->total())</p>
    @if($payouts->count() > 0)
        @foreach($payouts as $payout)
            <div class="nk-tb-item nk-tb-head">
                <div class="nk-tb-col"><span class="sub-text">ID выплаты: {{$payout->id}}</span></div>
                <div class="nk-tb-col"><span class="sub-text">ID пользователя: {{$payout->user_id}}</span></div>
                <div class="nk-tb-col"><span class="sub-text">ID задачи:{{$payout->product_id}}</span></div>
                <div class="nk-tb-col"><span class="sub-text">Пользователь:{{$payout->user->name}}</span></div>
                <div class="nk-tb-col"><span class="sub-text">Сумма: {{$payout->price}}</span></div>
                <div class="nk-tb-col"><span class="sub-text">Статус выплаты: {{$payout->status}}</span></div>
                <ul class="link-list-opt no-bdr">
                    <li><a href="{{ route('payouts.edit', $payout) }}" data-id="{{$payout->id}}">
                            <em class="icon ni ni-edit"></em><span>Редактировать</span></a></li>
                    <li>
                        <form action="{{ route('payouts.delete', $payout) }}" method="POST">
                            @csrf
                            <button type="submit" class="product-delete" id="product-delete-{{$payout->id}}"
                                    data-id="{{$payout->id}}">Удалить
                            </button>
                        </form>
                    </li>
                </ul>
                <br>
            </div>
        @endforeach
    @else
        <p>На данный момент выплат нет</p>
    @endif
    <a href="{{ route('payouts.create') }}" class="btn btn-primary">Добавить выплаты</a>
@endsection
