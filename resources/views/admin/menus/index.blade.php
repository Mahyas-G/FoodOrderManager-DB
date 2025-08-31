@extends('layouts.app')
@section('title','مدیریت منو')
@section('content')
    <div class="container">
        <div class="d-flex justify-content-between mb-3">
            <h4 class="fw-bold">مدیریت آیتم‌های منو</h4>
            <a class="btn btn-success" href="{{ route('admin.menus.create') }}">+ آیتم جدید</a>
        </div>

        <div class="card shadow-sm">
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle">
                    <thead class="table-light">
                    <tr>
                        <th>نام</th>
                        <th>دسته</th>
                        <th>قیمت</th>
                        <th>موجودی</th>
                        <th>عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($menus as $m)
                        <tr>
                            <td>{{ $m->name }}</td>
                            <td>{{ $m->category->name ?? '-' }}</td>
                            <td>{{ number_format($m->price) }}</td>
                            <td>{{ $m->stock }}</td>
                            <td>
                                <a class="btn btn-sm btn-warning" href="{{ route('admin.menus.edit',$m) }}">ویرایش</a>
                                <form method="POST" action="{{ route('admin.menus.destroy',$m) }}" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-danger" onclick="return confirm('حذف شود؟')">حذف</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="p-3">{{ $menus->links() }}</div>
        </div>
    </div>
@endsection
