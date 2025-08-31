@extends('layouts.app')
@section('title','سفارش '.$order->id)
@section('content')
    <div class="container-narrow">
        <div class="card shadow-sm">
            <div class="card-body">
                <h2 class="h5 mb-3">سفارش #{{ $order->id }}</h2>

                <div class="mb-3">
                    <p><strong>وضعیت:</strong> {{ $order->status }}</p>
                    <p><strong>جمع جزء:</strong> {{ number_format($order->subtotal) }} تومان</p>
                    <p><strong>تخفیف:</strong> {{ number_format($order->discount_amount) }} تومان</p>
                    <p class="fs-5 text-success"><strong>نهایی:</strong> {{ number_format($order->total) }} تومان</p>
                </div>

                <hr>

                <div class="table-responsive">
                    <table class="table table-striped text-center align-middle">
                        <thead class="table-light">
                        <tr>
                            <th>غذا</th>
                            <th>تعداد</th>
                            <th>قیمت واحد</th>
                            <th>جمع</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($order->items as $it)
                            <tr>
                                <td>{{ $it->menu->name }}</td>
                                <td>{{ $it->quantity }}</td>
                                <td>{{ number_format($it->unit_price) }} تومان</td>
                                <td>{{ number_format($it->line_total) }} تومان</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
@endsection
