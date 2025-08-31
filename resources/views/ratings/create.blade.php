@extends('layouts.app')

@section('title','ثبت امتیاز برای '.$menu->name)

@section('content')
    <div class="container-narrow">
        <div class="card shadow-sm">
            <div class="card-body">
                <h5 class="mb-3">ثبت امتیاز برای {{ $menu->name }}</h5>
                <form action="{{ route('ratings.store',$menu) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="stars" class="form-label">امتیاز (۱ تا ۵)</label>
                        <input type="number" name="stars" id="stars" class="form-control" min="1" max="5" required>
                    </div>
                    <button class="btn btn-success">ثبت</button>
                </form>
            </div>
        </div>
    </div>
@endsection
