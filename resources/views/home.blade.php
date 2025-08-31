@extends('layouts.app')

@section('title','خانه')

@section('content')
    <div class="container my-4">

        <div class="text-center mb-5">
            <h1 class="fw-bold text-success">خوش آمدید</h1>
            <p class="text-muted fs-5">
                برای سفارش غذا ابتدا وارد حساب خود شوید یا ثبت‌نام کنید، سپس از طریق منو انتخاب کنید.
            </p>
        </div>

        <div class="row g-4">
            @forelse($popular as $m)
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm hover-card border-0">
                        @if(!empty($m->image_url))
                            <img src="{{ $m->image_url }}" class="card-img-top" alt="{{ $m->name }}" style="height:200px; object-fit:cover;">
                        @else
                            <div class="bg-light d-flex align-items-center justify-content-center" style="height:200px;">
                                <span class="text-muted">بدون تصویر</span>
                            </div>
                        @endif

                        <div class="card-body text-center">
                            <h5 class="card-title text-warning fw-bold mb-2">{{ $m->name }}</h5>
                            <p class="fw-bold text-success mb-1">{{ number_format($m->price) }} تومان</p>
                            @if($m->ratings && $m->ratings->count())
                                <p class="text-muted">⭐ {{ number_format($m->ratings->avg('stars'),1) }} / 5</p>
                            @else
                                <p class="text-muted">بدون امتیاز</p>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center">
                    <p class="text-muted">غذای محبوبی برای نمایش وجود ندارد.</p>
                </div>
            @endforelse
        </div>
    </div>

    <style>
        .hover-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .hover-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 15px rgba(0,0,0,0.15);
        }
    </style>
@endsection
