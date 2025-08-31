@extends('layouts.app')
@section('title', 'ثبت‌نام')
@section('content')
    <div class="container-narrow">
        <div class="card shadow-sm">
            <div class="card-body">
                <h1 class="h4 mb-3">ثبت‌نام</h1>

                @if ($errors->any())
                    <div class="alert alert-danger">{{ $errors->first() }}</div>
                @endif

                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">نام</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">ایمیل</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">رمز عبور</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <div class="mb-4">
                        <label class="form-label">تایید رمز عبور</label>
                        <input type="password" name="password_confirmation" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-success w-100">ایجاد حساب</button>
                </form>
            </div>
        </div>
    </div>
@endsection
