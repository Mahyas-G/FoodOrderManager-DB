@extends('layouts.app')
@section('title', 'ورود')
@section('content')
    <div class="container-narrow">
        <div class="card shadow-sm">
            <div class="card-body">
                <h1 class="h4 mb-3">ورود</h1>

                @if ($errors->any())
                    <div class="alert alert-danger">{{ $errors->first() }}</div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">ایمیل</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email') }}" required autofocus>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">رمز عبور</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember">
                        <label class="form-check-label" for="remember">مرا به خاطر بسپار</label>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <button type="submit" class="btn btn-success">ورود</button>
                        <a href="{{ route('password.request') }}" class="link-secondary">فراموشی رمز عبور</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
