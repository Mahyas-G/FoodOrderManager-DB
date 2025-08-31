@extends('layouts.app')
@section('title','نتیجه پرداخت')
@section('content')
    <div class="container-narrow">
        <div class="card shadow-sm text-center">
            <div class="card-body">
                @if($status === 'success')
                    <div class="mb-3 text-success" style="font-size:50px;">✔</div>
                    <h2 class="h5 mb-3">پرداخت با موفقیت انجام شد</h2>
                    <p>شماره سفارش شما: <strong>{{ $order->id }}</strong></p>
                    <a href="{{ route('orders.show',$order) }}" class="btn btn-outline-success mt-3">
                        مشاهده جزئیات سفارش
                    </a>
                @else
                    <div class="mb-3 text-danger" style="font-size:50px;">✖</div>
                    <h2 class="h5 mb-3">پرداخت ناموفق بود</h2>
                    <p>لطفاً مجدداً تلاش کنید یا با پشتیبانی تماس بگیرید.</p>
                    <a href="{{ route('payment.create',$order) }}" class="btn btn-outline-danger mt-3">
                        تلاش مجدد
                    </a>
                @endif
            </div>
        </div>
    </div>
@endsection
