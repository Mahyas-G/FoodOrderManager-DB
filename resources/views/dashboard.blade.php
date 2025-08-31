@extends('layouts.app')
@section('title','داشبورد')

@section('content')
    <div class="container">
        <div class="row g-3">
            <div class="col-12 col-lg-6">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h2 class="h5 mb-2">سلام، {{ auth()->user()->name }} </h2>
                        <p class="text-muted mb-0">
                            خوش آمدید! از اینجا می‌توانید سفارش‌های خود را مدیریت کنید، وضعیت پرداخت‌ها را بررسی کنید و به امکانات حساب کاربری خود دسترسی داشته باشید.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h3 class="h6 mb-3">میانبرهای سریع</h3>
                        <div class="d-flex gap-2 flex-wrap">
                            <a class="btn btn-outline-success" href="{{ url('/menu') }}">مشاهده منو</a>
                            <a class="btn btn-outline-primary" href="{{ route('home') }}">خانه</a>
                            <a class="btn btn-outline-warning" href="{{ url('/orders') }}">سفارش‌های من</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
