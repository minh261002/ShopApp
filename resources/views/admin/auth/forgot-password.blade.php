@extends('admin.layout.guard_layout');

@section('guard_title', 'Đăng nhập')
@section('guard_content')

    <div class="card-body">
        <h2 class="h2 text-center mb-4">Quên mật khẩu</h2>
        <form action="{{ route('admin.password.email') }}" method="post" autocomplete="off" novalidate>
            @csrf
            <input type="hidden" name="time" id="time">
            <input type="hidden" name="device" id="device">

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" class="form-control" autocomplete="off" name="email" value="{{ old('email') }}">
                @error('email')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-footer">
                <button type="submit" class="btn btn-primary w-100">
                    Gửi yêu cầu
                </button>
            </div>

            <div class="text-center text-muted mt-3">
                Quay lại <a href="{{ route('admin.login') }}">Đăng nhập</a>
            </div>
        </form>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const form = document.querySelector('form');
                form.addEventListener('submit', function() {
                    const button = form.querySelector('button[type="submit"]');
                    button.innerHTML =
                        '<div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div>';
                    button.disabled = true;
                });
            });

            document.getElementById('time').value = new Date().toLocaleString('en-US', {
                timeZone: 'Asia/Ho_Chi_Minh'
            });
            document.getElementById('device').value = navigator.userAgent;

            document.querySelector('form').addEventListener('submit', function() {
                document.querySelector('button').innerHTML =
                    '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Đang xử lý...';
                document.querySelector('button').setAttribute('disabled', 'disabled');
            });
        </script>
    @endpush
@endsection
