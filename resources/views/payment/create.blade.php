@extends('layouts.app')
@section('title','درگاه پرداخت')
@section('content')
    <div class="container-narrow">
        <div class="card shadow-sm">
            <div class="card-body text-center">
                <h2 class="h5 mb-3">پرداخت سفارش #{{ $order->id }}</h2>
                <p class="fs-5">مبلغ قابل پرداخت: <strong class="text-success">{{ number_format($order->total) }} تومان</strong></p>
                <hr>
                <form method="POST" action="{{ route('payment.process',$order) }}">
                    @csrf
                    <button class="btn btn-lg btn-warning text-white w-100">
                        <i class="bi bi-credit-card"></i> پرداخت
                    </button>
                </form>
                <p class="mt-3 text-muted">با کلیک روی پرداخت، به درگاه بانکی شبیه‌سازی‌شده هدایت می‌شوید.</p>
            </div>
        </div>
    </div>
@endsection
