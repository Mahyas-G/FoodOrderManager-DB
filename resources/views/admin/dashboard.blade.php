@extends('layouts.app')
@section('title','داشبورد ادمین')

@section('content')
    <div class="container">
        <div class="row g-3">
            <div class="col-12">
                <div class="card shadow-sm mb-3">
                    <div class="card-body">
                        <h2 class="h5 mb-2">داشبورد مدیریت</h2>
                        <p class="text-muted">خوش آمدید، {{ auth()->user()->name }}. از این بخش می‌توانید منو، سفارش‌ها و گزارش‌ها را مدیریت کنید.</p>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h3 class="h6 mb-3">میانبرها</h3>
                        <div class="d-flex gap-2 flex-wrap">
                            <a class="btn btn-outline-primary" href="{{ route('admin.menus.index') }}">مدیریت منو</a>
                            <a class="btn btn-outline-success" href="{{ route('admin.reports.orders') }}">گزارش سفارش‌ها</a>
                            <a class="btn btn-outline-warning" href="{{ route('admin.reports.popular') }}">غذاهای محبوب</a>
                            <a class="btn btn-outline-info" href="{{ route('admin.reports.payments') }}">گزارش پرداخت‌ها</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
