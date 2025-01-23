@extends('client.layouts.master')

@section('title', 'Đăng ký')

@section('content')
    <div class="my-5">
        <div class="w-100" style="max-width: 500px; margin: 0 auto;">
            <h1 class="fw-semibold text-center mb-3">
                Đăng ký
            </h1>

            <form class="d-flex flex-column" action="{{ route('register.post') }}" method="POST">
                @csrf

                <div class="form-group mb-3">
                    <label for="name" class="form-label">Họ và tên</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}">
                    @error('email')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="password" class="form-label">Mật khẩu</label>
                    <div class="input-group">
                        <input type="password" class="form-control" id="password" name="password">
                        <span class="input-group-text cursor-pointer" id="icon-password">
                            <i class="ti ti-eye fs-20px"></i>
                        </span>
                    </div>
                    @error('password')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="password_confirmation" class="form-label">Nhập lại mật khẩu</label>
                    <div class="input-group">
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                        <span class="input-group-text cursor-pointer" id="icon-password-confirmation">
                            <i class="ti ti-eye fs-20px"></i>
                        </span>
                    </div>
                    @error('password_confirmation')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <div class="d-flex align-items-center justify-content-between">
                        <div></div>

                        <a href="{{ route('password.forgot') }}" class="text-decoration-none text-red">Quên mật khẩu?</a>
                    </div>
                </div>

                <div class="form-group mb-3">
                    <button type="submit" class="btn btn-red w-100" id="registerButton">Đăng ký</button>
                </div>

                <div class="form-group mb-3">
                    <div class="d-flex justify-content-center">
                        <span class="text-muted">Bạn đã có tài khoản?</span>
                        <a href="{{ route('login') }}" class="text-decoration-none ms-2 text-red">Đăng nhập ngay</a>
                    </div>
                </div>

                <div class="form-group mb-3">
                    <div class="d-flex justify-content-between align-items-center gap-5">
                        <hr class="flex-grow-1">
                        <span class="text-muted fs-20px">Hoặc</span>
                        <hr class="flex-grow-1">
                    </div>
                </div>

                <div class="form-group flex flex-column">
                    <a href="#" class="btn btn-facebook w-100 mb-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M7 10v4h3v7h4v-7h3l1 -4h-4v-2a1 1 0 0 1 1 -1h3v-4h-3a5 5 0 0 0 -5 5v2h-3" />
                        </svg>

                        Đăng nhập bằng Facebook
                    </a>

                    <a href="#" class="btn btn-google w-100">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M17.788 5.108a9 9 0 1 0 3.212 6.892h-8" />
                        </svg>

                        Đăng nhập bằng Google
                    </a>
                </div>

            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#icon-password').click(function() {
                let password = $('#password');
                let icon = $('#icon-password i');

                if (password.attr('type') === 'password') {
                    password.attr('type', 'text');
                    icon.removeClass('ti-eye').addClass('ti-eye-closed');
                } else {
                    password.attr('type', 'password');
                    icon.removeClass('ti-eye-closed').addClass('ti-eye');
                }
            });

            $('#icon-password-confirmation').click(function() {
                let passwordConfirmation = $('#password_confirmation');
                let icon = $('#icon-password-confirmation i');

                if (passwordConfirmation.attr('type') === 'password') {
                    passwordConfirmation.attr('type', 'text');
                    icon.removeClass('ti-eye').addClass('ti-eye-closed');
                } else {
                    passwordConfirmation.attr('type', 'password');
                    icon.removeClass('ti-eye-closed').addClass('ti-eye');
                }
            });

            $('#registerButton').click(function() {
                $(this).addClass('btn-loading');
            });
        });
    </script>
@endpush
