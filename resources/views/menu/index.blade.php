@extends('layouts.app')

@section('title', 'منوی غذاها')

@section('content')
    <div class="container py-4">

        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <form method="GET" action="{{ route('menu.index') }}" class="row g-3 align-items-center">
                    <div class="col-md-6">
                        <input type="text" name="search" class="form-control" placeholder="جستجو..." value="{{ request('search') }}">
                    </div>
                    <div class="col-md-4">
                        <select name="category" class="form-select">
                            <option value="">همه دسته‌ها</option>
                            @foreach($categories as $c)
                                <option value="{{ $c->id }}" @selected(request('category')==$c->id)>{{ $c->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2 text-end">
                        <button class="btn btn-success w-100">فیلتر</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            @forelse($menus as $m)
                <div class="col">
                    <div class="card h-100 shadow-sm border-0">

                        @if(!empty($m->image_url))
                            <img src="{{ $m->image_url }}" class="card-img-top" alt="{{ $m->name }}" style="height:200px; object-fit:cover;">
                        @else
                            <div class="bg-light d-flex align-items-center justify-content-center" style="height:200px;">
                                <span class="text-muted">بدون تصویر</span>
                            </div>
                        @endif

                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title text-warning mb-2">
                                <a href="{{ route('menu.show', $m) }}" class="text-decoration-none text-warning">{{ $m->name }}</a>
                            </h5>

                            <p class="text-muted mb-1">دسته: {{ $m->category->name }}</p>
                            <p class="fw-bold text-success mb-2">قیمت: {{ number_format($m->price) }} تومان</p>

                            @if($m->ratings && $m->ratings->count())
                                <div class="text-warning mb-3">⭐ {{ number_format($m->ratings->avg('stars'),1) }} / 5</div>
                            @else
                                <div class="text-muted mb-3">بدون امتیاز</div>
                            @endif

                            <div class="d-flex justify-content-between align-items-center mt-auto gap-2">
                                <a href="{{ route('ratings.create', $m) }}" class="btn btn-success px-3">ثبت امتیاز</a>

                                <form action="{{ route('cart.add', $m) }}" method="POST" class="d-flex">
                                    @csrf
                                    <div class="input-group">
                                        <input type="number" name="quantity" class="form-control text-center" value="1" min="1" style="width: 70px;">
                                        <button class="btn btn-warning text-white px-3">افزودن به سبد</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col">
                    <div class="alert alert-info text-center w-100">هیچ آیتمی یافت نشد.</div>
                </div>
            @endforelse
        </div>

        <div class="d-flex justify-content-center mt-4">
            {{ $menus->withQueryString()->links() }}
        </div>
    </div>
@endsection
