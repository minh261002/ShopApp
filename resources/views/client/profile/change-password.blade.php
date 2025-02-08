@extends('client.layouts.master')

@section('title', 'Thông tin cá nhân')

@section('content')
    <div class="card">
        <div class="row g-0">
            <div class="col-12 col-md-3 border-end">
                <div class="card-body">
                    <h4 class="subheader">Cài đặt tài khoản</h4>
                    @include('client.profile.components.sidenav')
                </div>
            </div>
            <div class="col-12 col-md-9 d-flex flex-column">
                <form class="card-body" method="POST" action="{{ route('profile.update.password') }}">
                    @csrf
                    <h2 class="mb-4">Đổi mật khẩu</h2>

                    <div class="row mt-4 gx-4">
                        <div class="col-12 mb-3">
                            <label for="current_password" class="form-label">Mật khẩu hiện tại</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="current_password" name="current_password">
                                <span class="input-group-text cursor-pointer" id="icon-current-password">
                                    <i class="ti ti-eye fs-20px"></i>
                                </span>
                            </div>
                        </div>

                        <div class="col-12 mb-3">
                            <label for="password" class="form-label">Mật khẩu mới</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="password" name="password">
                                <span class="input-group-text cursor-pointer" id="icon-password">
                                    <i class="ti ti-eye fs-20px"></i>
                                </span>
                            </div>
                        </div>

                        <div class="col-12 mb-3">
                            <label for="password_confirmation" class="form-label">Nhập lại mật khẩu mới</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="password_confirmation"
                                    name="password_confirmation">
                                <span class="input-group-text cursor-pointer" id="icon-password-confirmation">
                                    <i class="ti ti-eye fs-20px"></i>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="btn-list justify-content-end">
                        <button type="submit" class="btn btn-red btn-2" id="updatePasswordButton">
                            Lưu thay đổi
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection


@push('scripts')
    <script>
        $(document).ready(function() {
            $('#updatePasswordButton').click(function() {
                $(this).html(
                    '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>'
                );
            });

            $('#icon-current-password').click(function() {
                var input = $('#current_password');
                var icon = $('#icon-current-password i');

                if (input.attr('type') == 'password') {
                    input.attr('type', 'text');
                    icon.removeClass('ti-eye');
                    icon.addClass('ti-eye-off');
                } else {
                    input.attr('type', 'password');
                    icon.removeClass('ti-eye-off');
                    icon.addClass('ti-eye');
                }
            });

            $('#icon-password').click(function() {
                var input = $('#password');
                var icon = $('#icon-password i');

                if (input.attr('type') == 'password') {
                    input.attr('type', 'text');
                    icon.removeClass('ti-eye');
                    icon.addClass('ti-eye-off');
                } else {
                    input.attr('type', 'password');
                    icon.removeClass('ti-eye-off');
                    icon.addClass('ti-eye');
                }
            });

            $('#icon-password-confirmation').click(function() {
                var input = $('#password_confirmation');
                var icon = $('#icon-password-confirmation i');

                if (input.attr('type') == 'password') {
                    input.attr('type', 'text');
                    icon.removeClass('ti-eye');
                    icon.addClass('ti-eye-off');
                } else {
                    input.attr('type', 'password');
                    icon.removeClass('ti-eye-off');
                    icon.addClass('ti-eye');
                }
            });
        })
    </script>
@endpush
