@extends('layouts.app')
@section('title', $menu->name)
@section('content')
    <div class="container-narrow">

        <div class="card shadow-sm mb-4">
            <div class="row g-0">
                <div class="col-md-5">
                    <img src="{{ $menu->image_url ?? 'https://via.placeholder.com/500x350' }}" class="img-fluid rounded-start" alt="{{ $menu->name }}">
                </div>
                <div class="col-md-7">
                    <div class="card-body d-flex flex-column h-100">
                        <h2 class="card-title mb-3">{{ $menu->name }}</h2>
                        <p class="text-muted mb-2">دسته: {{ $menu->category->name }}</p>
                        <p class="fw-bold text-success mb-3">قیمت: {{ number_format($menu->price) }} تومان</p>
                        <p class="mb-4">{{ $menu->description }}</p>

                        <form action="{{ route('cart.add', $menu) }}" method="POST" class="mt-auto">
                            @csrf
                            <div class="input-group">
                                <input type="number" name="quantity" class="form-control text-center" value="1" min="1">
                                <button class="btn btn-warning text-white">افزودن به سبد</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @auth

            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <h3 class="h6 mb-3">ثبت نظر</h3>
                    <form action="{{ route('comments.store', $menu) }}" method="POST">
                        @csrf
                        <textarea name="body" rows="3" class="form-control mb-3" placeholder="نظر شما..."></textarea>
                        <button class="btn btn-primary">ارسال</button>
                    </form>
                </div>
            </div>
        @endauth

        <div class="card shadow-sm">
            <div class="card-body">
                <h3 class="h6 mb-3">نظرات</h3>
                @forelse($menu->comments as $c)
                    <div class="border-bottom pb-2 mb-2">
                        <strong>{{ $c->user->name }}</strong>
                        <p class="mb-0">{{ $c->body }}</p>
                    </div>
                @empty
                    <div class="text-muted">نظری ثبت نشده است.</div>
                @endforelse
            </div>
        </div>

    </div>
@endsection
