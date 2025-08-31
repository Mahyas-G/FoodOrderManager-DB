@extends('layouts.app')
@section('title', 'تنظیم رمز جدید')
@section('content')
    <div class="container-narrow">
        <div class="card shadow-sm">
            <div class="card-body">
                <h1 class="h5 mb-3">تنظیم رمز عبور جدید</h1>

                @if ($errors->any())
                    <div class="alert alert-danger">{{ $errors->first() }}</div>
                @endif

                <form method="POST" action="{{ route('password.update') }}">
                    @csrf
                    <input type="hidden" name="token" value="{{ $request->route('token') }}">

                    <div class="mb-3">
                        <label class="form-label">ایمیل</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email', $request->email) }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">رمز عبور جدید</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <div class="mb-4">
                        <label class="form-label">تایید رمز عبور</label>
                        <input type="password" name="password_confirmation" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-success w-100">ذخیره رمز</button>
                </form>
            </div>
        </div>
    </div>
@endsection
