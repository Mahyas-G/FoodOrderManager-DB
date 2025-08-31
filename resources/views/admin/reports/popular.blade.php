@extends('layouts.app')
@section('title','غذاهای محبوب')
@section('content')
    <div class="container">
        <div class="card shadow-sm">
            <div class="card-header bg-secondary text-white fw-bold">غذاهای محبوب</div>
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle">
                    <thead class="table-light">
                    <tr>
                        <th>نام غذا</th>
                        <th>تعداد فروش</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($popular as $row)
                        <tr>
                            <td>{{ $row->menu->name ?? '-' }}</td>
                            <td>{{ $row->qty }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="p-3">{{ $popular->links() }}</div>
        </div>
    </div>
@endsection
