@extends('client.layouts.master')

@section('title', 'Quên mật khẩu')

@section('content')
    <div class="my-5">
        <div class="w-100" style="max-width: 500px; margin: 0 auto;">
            <h1 class="fw-semibold text-center mb-3">
                Quên mật khẩu
            </h1>

            <form class="d-flex flex-column" method="POST" action="{{ route('password.email') }}">
                @csrf

                <input type="hidden" name="time" value="{{ time() }}">
                <input type="hidden" name="device" value="{{ request()->header('User-Agent') }}">

                <div class="form-group mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}">
                    @error('email')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <button type="submit" class="btn btn-red w-100" id="loginButton">Xác thực email</button>
                </div>

                <div class="form-group mb-3">
                    <div class="d-flex justify-content-center">
                        <a href="{{ route('login') }}" class="text-decoration-none ms-2 text-red">Quay lại đăng nhập</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#loginButton').click(function() {
                $(this).addClass('btn-loading');
            });
        });
    </script>
@endpush
