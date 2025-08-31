@extends('layouts.app')
@section('title','گزارش پرداخت‌ها')
@section('content')
    <div class="container">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white fw-bold">گزارش پرداخت‌ها</div>
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle">
                    <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>سفارش</th>
                        <th>کاربر</th>
                        <th>وضعیت</th>
                        <th>مبلغ</th>
                        <th>ارجاع</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($payments as $p)
                        <tr>
                            <td>{{ $p->id }}</td>
                            <td>{{ $p->order->id }}</td>
                            <td>{{ $p->order->user->name }}</td>
                            <td>
                                @if($p->status === 'success')
                                    <span class="badge bg-success">پرداخت موفق</span>
                                @else
                                    <span class="badge bg-danger">ناموفق</span>
                                @endif
                            </td>
                            <td>{{ number_format($p->order->total) }} تومان</td>
                            <td>{{ $p->transaction_ref }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="p-3">{{ $payments->links() }}</div>
        </div>
    </div>
@endsection
