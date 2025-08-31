@extends('layouts.app')
@section('title','گزارش سفارش‌ها')
@section('content')
    <div class="container">
        <div class="card shadow-sm">
            <div class="card-header bg-info text-white fw-bold">گزارش سفارش‌ها</div>
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle">
                    <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>کاربر</th>
                        <th>وضعیت</th>
                        <th>مبلغ</th>
                        <th>تاریخ</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($orders as $o)
                        <tr>
                            <td>{{ $o->id }}</td>
                            <td>{{ $o->user->name }}</td>
                            <td>{{ $o->status }}</td>
                            <td>{{ number_format($o->total) }}</td>
                            <td>{{ $o->created_at }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="p-3">{{ $orders->links() }}</div>
        </div>
    </div>
@endsection
