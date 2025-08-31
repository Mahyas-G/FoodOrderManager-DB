@extends('layouts.app')
@section('title','ویرایش آیتم')
@section('content')
    <div class="container" style="max-width:700px;">
        <div class="card shadow-sm">
            <div class="card-header bg-warning text-dark fw-bold">ویرایش آیتم</div>
            <div class="card-body">
                <form method="POST" enctype="multipart/form-data" action="{{ route('admin.menus.update',$menu) }}" class="row g-3">
                    @csrf
                    @method('PUT')

                    <div class="col-12">
                        <label class="form-label">نام غذا</label>
                        <input name="name" class="form-control" value="{{ old('name',$menu->name) }}" required>
                    </div>

                    <div class="col-12">
                        <label class="form-label">دسته‌بندی</label>
                        <select name="category_id" class="form-select">
                            @foreach($categories as $c)
                                <option value="{{ $c->id }}" @selected($menu->category_id==$c->id)>{{ $c->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">قیمت (تومان)</label>
                        <input type="number" name="price" class="form-control" value="{{ old('price',$menu->price) }}" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">موجودی</label>
                        <input type="number" name="stock" class="form-control" value="{{ old('stock',$menu->stock) }}" required>
                    </div>

                    <div class="col-12">
                        <label class="form-label">توضیحات</label>
                        <textarea name="description" class="form-control" rows="3">{{ old('description',$menu->description) }}</textarea>
                    </div>

                    <div class="col-12">
                        <label class="form-label">تصویر جدید (اختیاری)</label>
                        <input type="file" name="image" class="form-control" accept="image/*">
                    </div>

                    <div class="col-12 text-end">
                        <button class="btn btn-warning px-4">ذخیره تغییرات</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
