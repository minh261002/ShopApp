@extends('client.layouts.master')

@section('title', 'Đăng nhập')

@section('content')
    <div class="my-5">
        <div class="w-100" style="max-width: 600px; margin: 0 auto;">
            <h2 class="fw-semibold text-center mb-3">
                Đăng nhập
            </h2>

            <div class="d-flex flex-column">
                <div class="form-group mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}">
                    <span class="email-error"></span>
                </div>

                <div class="form-group mb-3">
                    <label for="password" class="form-label">Mật khẩu</label>
                    <div class="input-group">
                        <input type="passowrd" class="form-control" id="password" name="password">
                        <span class="input-group-text cursor-pointer" id="icon-password">
                            <i class="ti ti-eye"></i>
                        </span>
                    </div>
                    <span class="password-error"></span>
                </div>

                <div class="form-group mb-3">
                    .
                </div>
            </div>
        </div>
    </div>
@endsection
