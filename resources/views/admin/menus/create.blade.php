@extends('layouts.app')
@section('title','افزودن آیتم جدید')
@section('content')
    <div class="container" style="max-width:700px;">
        <div class="card shadow-sm">
            <div class="card-header bg-success text-white fw-bold">افزودن آیتم جدید</div>
            <div class="card-body">
                <form method="POST" enctype="multipart/form-data" action="{{ route('admin.menus.store') }}" class="row g-3">
                    @csrf
                    <div class="col-12">
                        <label class="form-label">نام غذا</label>
                        <input name="name" class="form-control" placeholder="نام" value="{{ old('name') }}" required>
                    </div>

                    <div class="col-12">
                        <label class="form-label">دسته‌بندی</label>
                        <select name="category_id" class="form-select" required>
                            @foreach($categories as $c)
                                <option value="{{ $c->id }}">{{ $c->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">قیمت (تومان)</label>
                        <input type="number" name="price" class="form-control" placeholder="قیمت" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">موجودی</label>
                        <input type="number" name="stock" class="form-control" placeholder="موجودی" required>
                    </div>

                    <div class="col-12">
                        <label class="form-label">توضیحات</label>
                        <textarea name="description" class="form-control" rows="3" placeholder="توضیحات"></textarea>
                    </div>

                    <div class="col-12">
                        <label class="form-label">تصویر غذا</label>
                        <input type="file" name="image" class="form-control" accept="image/*">
                    </div>

                    <div class="col-12 text-end">
                        <button class="btn btn-success px-4">ثبت آیتم</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
