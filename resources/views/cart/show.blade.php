@extends('layouts.app')
@section('title','سبد خرید')
@section('content')
    <div class="container-narrow">
        <div class="card shadow-sm">
            <div class="card-body">
                <h2 class="h5 mb-3">سبد خرید</h2>

                @if(empty($cart))
                    <div class="text-center text-muted">سبد شما خالی است.</div>
                @else
                    <div class="table-responsive">
                        <table class="table table-bordered align-middle text-center">
                            <thead class="table-light">
                            <tr>
                                <th>نام</th>
                                <th>تعداد</th>
                                <th>قیمت واحد</th>
                                <th>جمع</th>
                                <th>حذف</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($cart as $id => $item)
                                <tr>
                                    <td>{{ $item['name'] }}</td>
                                    <td>{{ $item['qty'] }}</td>
                                    <td>{{ number_format($item['price']) }} تومان</td>
                                    <td>{{ number_format($item['qty'] * $item['price']) }} تومان</td>
                                    <td>
                                        <form method="POST" action="{{ route('cart.remove', $id) }}">
                                            @csrf @method('DELETE')
                                            <button class="btn btn-sm btn-danger">✕</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-3">
                        <p>جمع جزء: <strong>{{ number_format($subtotal) }} تومان</strong></p>
                        <p>تخفیف: <strong>{{ number_format($discount['amount']) }} ({{ $discount['code'] ?? '—' }})</strong></p>
                        <p class="fs-5 text-success">مبلغ قابل پرداخت: <strong>{{ number_format($total) }} تومان</strong></p>
                    </div>

                    <div class="d-flex flex-wrap gap-2 mt-4">
                        <form action="{{ route('discounts.apply') }}" method="POST" class="d-flex gap-2 flex-grow-1">
                            @csrf
                            <input type="text" name="code" class="form-control" placeholder="کد تخفیف">
                            <button class="btn btn-outline-primary">اعمال</button>
                        </form>

                        @auth
                            <form action="{{ route('orders.store') }}" method="POST">
                                @csrf
                                <button class="btn btn-warning text-white">ثبت سفارش و ادامه پرداخت</button>
                            </form>
                        @else
                            <a class="btn btn-primary" href="{{ route('login') }}">ابتدا وارد شوید</a>
                        @endauth

                        <form action="{{ route('cart.clear') }}" method="POST">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger">خالی کردن سبد</button>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
