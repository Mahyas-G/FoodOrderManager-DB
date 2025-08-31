@extends('layouts.app')
@section('title','تأیید ایمیل')

@section('content')
    <div class="container-narrow">
        <div class="card shadow-sm">
            <div class="card-body text-center">
                <h1 class="h5 mb-3">ایمیل خود را تأیید کنید</h1>
                <p class="text-muted">لینک تأیید به ایمیل شما ارسال شده است.</p>

                @if (session('status') == 'verification-link-sent')
                    <div class="alert alert-success">یک لینک تأیید جدید ارسال شد.</div>
                @endif

                <form method="POST" action="{{ route('verification.send') }}" class="mb-3">
                    @csrf
                    <button type="submit" class="btn btn-success">ارسال مجدد لینک تأیید</button>
                </form>

                @if(isset($autoVerify) && $autoVerify)
                    <div id="loading-message" style="display:none; margin-top: 15px;">
                        <div class="spinner-border text-success" role="status"></div>
                        <p class="mt-2">در حال تأیید...</p>
                    </div>

                    <script>
                        document.getElementById('loading-message').style.display = 'block';
                        setTimeout(function() {
                            fetch("{{ route('verification.auto') }}", {
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                    'Accept': 'application/json',
                                    'Content-Type': 'application/json'
                                }
                            }).then(() => {
                                window.location.href = "{{ route('dashboard') }}";
                            });
                        }, 3000);
                    </script>
                @endif
            </div>
        </div>
    </div>
@endsection
