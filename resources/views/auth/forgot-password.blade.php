@extends('layouts.app')
@section('title', 'بازیابی رمز')
@section('content')
    <div class="container-narrow">
        <div class="card shadow-sm">
            <div class="card-body">
                <h1 class="h5 mb-3">ارسال لینک بازیابی رمز عبور</h1>

                @if (session('status'))
                    <div class="alert alert-success">{{ session('status') }}</div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger">{{ $errors->first() }}</div>
                @endif

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">ایمیل</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                    </div>
                    <button type="submit" class="btn btn-success w-100">ارسال لینک</button>
                </form>
            </div>
        </div>
    </div>
@endsection
