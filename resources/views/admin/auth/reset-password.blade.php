@extends('admin.layout.guard_layout')

@section('guard_title', 'Cập nhật mật khẩu')
@section('guard_content')
    <div class="card-body">
        <h2 class="h2 text-center mb-4">
            Cập nhật mật khẩu
        </h2>
        <form action="{{ route('admin.password.update') }}" method="post" autocomplete="off" novalidate>
            @csrf

            <input type="hidden" name="token" value="{{ request()->token }}">

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" class="form-control" autocomplete="off" name="email" value="{{ request()->email }}"
                    readonly>
                @error('email')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">
                    Mật khẩu
                </label>
                <div class="input-group input-group-flat">
                    <input type="password" class="form-control" name="password" autocomplete="off" tabindex="2">

                    <span class="input-group-text">
                        <a href="#" class="link-secondary" title="Hiển thị mật khẩu" data-bs-toggle="tooltip"
                            id="show_password">
                            <i class="ti ti-eye fs-3"></i>
                        </a>
                    </span>
                </div>
                @error('password')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">
                    Nhập lại mật khẩu
                </label>
                <div class="input-group input-group-flat">
                    <input type="password" class="form-control" name="password_confirmation" autocomplete="off"
                        tabindex="3">

                    <span class="input-group-text">
                        <a href="#" class="link-secondary" title="Hiển thị mật khẩu" data-bs-toggle="tooltip"
                            id="show_password_confimation">
                            <i class="ti ti-eye fs-3"></i>
                        </a>
                    </span>
                </div>
                @error('password')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-footer">
                <button type="submit" class="btn btn-primary w-100">
                    Cập nhật mật khẩu
                </button>
            </div>

            <div class="w-100 text-center mt-3">
                <a href="{{ route('admin.login') }}" class=" text-primary">
                    Quay lại đăng nhập
                </a>
            </div>
        </form>
    </div>

@endsection

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
    </script>
@endpush
