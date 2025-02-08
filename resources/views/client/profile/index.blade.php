@extends('client.layouts.master')

@section('title', 'Thông tin cá nhân')

@section('content')
    <div class="card mt-5">
        <div class="row g-0">
            <div class="col-12 col-md-3 border-end">
                <div class="card-body">
                    <h4 class="subheader">Cài đặt tài khoản</h4>
                    @include('client.profile.components.sidenav')
                </div>
            </div>
            <div class="col-12 col-md-9 d-flex flex-column">
                <form class="card-body" method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                    @csrf
                    <h2 class="mb-4">Thông tin cá nhân</h2>

                    <div class="row align-items-center">
                        <div class="col-auto">
                            <span class="avatar avatar-xl" id="preview-avatar"
                                style="background-image: url({{ $user->image }})"></span>
                        </div>

                        <div class="col-auto">
                            <label for="upload-image" class="btn btn-1">
                                Thay đổi
                            </label>
                            <input type="file" name="image" class="form-control" id="upload-image" hidden>
                            <input type="hidden" name="old_image" value="{{ $user->image }}">
                        </div>
                        <div class="col-auto">
                            <a href="#" class="btn btn-ghost-danger btn-3" id="removeAvatarButton">
                                Xoá
                            </a>
                        </div>
                    </div>

                    <div class="row mt-4 gx-4">
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">Họ và tên</label>
                            <input type="text" class="form-control" name="name" value="{{ $user->name }}">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" value="{{ $user->email }}">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="phone" class="form-label">Số điện thoại</label>
                            <input type="text" class="form-control" name="phone" value="{{ $user->phone }}">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="birthday" class="form-label">
                                Ngày sinh
                            </label>

                            <div class="input-icon mb-2">
                                <input class="form-control " placeholder="Chọn ngày" id="datepicker-icon"
                                    value="{{ old('birthday', $user->birthday ?? '') }}" name="birthday" autocomplete="off">
                                <span class="input-icon-addon">
                                    <i class="ti ti-calendar fs-1"></i>
                                </span>
                            </div>
                        </div>

                        <div class="col-12 form-group mb-3">
                            @include('admin.components.pick-address', [
                                'label' => 'Địa chỉ cụ thể',
                                'name' => 'address',
                                'value' => old('address', $user->address ?? ''),
                            ])
                            <input type="hidden" name="lat" value="{{ old('lat', $user->lat ?? '') }}">
                            <input type="hidden" name="lng" value="{{ old('lng', $user->lng ?? '') }}">
                        </div>

                        <div class="col-12 form-group mb-3">
                            <label for="description" class="form-label">Mô tả</label>
                            <textarea class="form-control" name="description" rows="3">{{ $user->description }}</textarea>
                        </div>
                    </div>

                    <div class="btn-list justify-content-end">
                        <button type="submit" class="btn btn-red btn-2" id="updateProfileButton">
                            Lưu thay đổi
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    @include('admin.components.modal-pick-address')
    @include('admin.components.google-map-script')
@endsection

@push('scripts')
    <script src="{{ asset('admin/libs/litepicker/dist/litepicker.js?1692870487') }}"></script>

    <script>
        //preview-avatar
        $('#upload-image').change(function() {
            const file = $(this)[0].files[0];
            const reader = new FileReader();
            reader.onload = function(e) {
                $('#preview-avatar').css('background-image', `url(${e.target.result})`);
            };
            reader.readAsDataURL(file);
        });

        //remove avatar
        $('#removeAvatarButton').click(function() {
            $('#preview-avatar').css('background-image', 'url("/admin/images/not-found.jpg")');
            $('#upload-image').val('/admin/images/not-found.jpg');
        });

        $('#updateProfileButton').click(function() {
            $(this).html(
                '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>'
            );
        });

        const picker = new Litepicker({
            element: document.getElementById('datepicker-icon'),
            format: "YYYY-MM-DD",
            showDropdowns: true,
            showWeekNumbers: false,
            singleMode: true,
            autoApply: true,
            autoRefresh: true,
            lang: 'vi-VN',
            mobileFriendly: true,
            resetButton: true,
            autoRefresh: true,
            dropdowns: {
                minYear: null,
                maxYear: null,
                months: true,
                years: true
            },
            setup: (picker) => {
                picker.on('selected', (date1, date2) => {
                    console.log(date1, date2);
                });
            }
        });
    </script>
@endpush
