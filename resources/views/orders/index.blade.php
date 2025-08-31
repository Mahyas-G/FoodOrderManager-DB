@extends('layouts.app')

@section('title','لیست سفارشات من')

@section('content')
    <div class="container-narrow">
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <h2 class="h5 mb-3">سفارشات شما</h2>

                @if($orders->isEmpty())
                    <div class="alert alert-info">شما هیچ سفارشی ثبت نکرده‌اید.</div>
                @else
                    <div class="table-responsive">
                        <table class="table table-bordered align-middle">
                            <thead class="table-light">
                            <tr>
                                <th>شماره سفارش</th>
                                <th>تاریخ ثبت</th>
                                <th>وضعیت</th>
                                <th>مبلغ نهایی</th>
                                <th>جزئیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($orders as $order)
                                <tr>
                                    <td>#{{ $order->id }}</td>
                                    <td>{{date($order->created_at)}}</td>
                                    <td>
                                        @if($order->status === 'pending')
                                            <span class="badge bg-warning text-dark">در انتظار پرداخت</span>
                                        @elseif($order->status === 'paid')
                                            <span class="badge bg-success">پرداخت شده</span>
                                        @else
                                            <span class="badge bg-secondary">{{ $order->status }}</span>
                                        @endif
                                    </td>
                                    <td><strong>{{ number_format($order->total) }}</strong> تومان</td>
                                    <td>
                                        <a href="{{ route('orders.show',$order->id) }}" class="btn btn-sm btn-outline-primary">
                                            مشاهده
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-3">
                        {{ $orders->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
