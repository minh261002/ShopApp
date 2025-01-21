@extends('admin.layout.master')
@section('title', 'Chỉnh sửa thông tin')

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@section('content')
    <div class="container-fluid">
        <div class="page-header d-print-none">
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h3 class="card-title">
                        Quản lý khách hàng
                    </h3>

                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin.dashboard') }}">
                                    Dashboard
                                </a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin.user.index') }}">
                                    Quản lý khách hàng
                                </a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Chỉnh sửa thông tin
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <!-- Page body -->
        <div class="page-body">
            <form action="{{ route('admin.user.update') }}" method="POST">
                @csrf
                @method('PUT')

                <input type="hidden" name="id" value="{{ $user->id }}">

                <div class="row">
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    Thông tin khách hàng
                                </h3>
                            </div>

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 form-group mb-3">
                                        <label for="name" class="form-label">
                                            Họ và tên
                                        </label>

                                        <input type="text" class="form-control" name="name" id="name"
                                            value="{{ old('name', $user->name ?? '') }}">
                                    </div>

                                    <div class="col-md-6 form-group mb-3">
                                        <label for="email" class="form-label">
                                            Email
                                        </label>

                                        <input type="text" class="form-control" name="email" id="email"
                                            value="{{ old('email', $user->email ?? '') }}">
                                    </div>

                                    <div class="col-md-6 form-group mb-3">
                                        <label for="phone" class="form-label">
                                            Số điện thoại
                                        </label>

                                        <input type="text" class="form-control" name="phone" id="phone"
                                            value="{{ old('phone', $user->phone ?? '') }}">

                                    </div>

                                    <div class="col-md-6 form-group mb-3">
                                        <label for="birthday" class="form-label">
                                            Ngày sinh
                                        </label>

                                        <div class="input-icon mb-2">
                                            <input class="form-control " placeholder="Chọn ngày" id="datepicker-icon"
                                                value="{{ old('birthday', $user->birthday ?? '') }}" name="birthday"
                                                autocomplete="off">
                                            <span class="input-icon-addon">
                                                <i class="ti ti-calendar fs-1"></i>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <label for="desc" class="form-label">Mô tả</label>
                                        <textarea name="description" cols="3" class="form-control">{{ old('description', $user->description ?? '') }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card mt-3">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="password" class="form-label">Mật khẩu</label>
                                        <input type="password" class="form-control" id="password" name="password">
                                        @error('password')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label for="password_confirmation" class="form-label">Nhập lại mật khẩu</label>
                                        <input type="password" class="form-control" id="password_confirmation"
                                            name="password_confirmation">
                                        @error('password_confirmation')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card mt-3">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label for="province_id" class="form-label">Chọn Tỉnh / Thành Phố</label>
                                        <select name="province_id" class="form-control select2 province location"
                                            data-target="districts">
                                            <option value="0">[Chọn Tỉnh / Thành Phố]</option>
                                            @if (isset($provinces))
                                                @foreach ($provinces as $province)
                                                    <option @if (old('province_id') == $province->code) selected @endif
                                                        value="{{ $province->code }}">{{ $province->name_with_type }}
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label for="" class="form-label">Chọn Quận / Huyện </label>
                                        <select name="district_id" class="form-control districts select2 location"
                                            data-target="wards">
                                            <option value="0">[Chọn Quận / Huyện]</option>
                                        </select>
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label for="" class="form-label">Chọn Phường / Xã </label>
                                        <select name="ward_id" class="form-control select2 wards">
                                            <option value="0">[Chọn Phường / Xã]</option>
                                        </select>
                                    </div>

                                    <div class="col-12 mb-3">
                                        <label for="address" class="form-label">Địa chỉ</label>
                                        <input type="text" class="form-control" id="address" name="address"
                                            value="{{ old('address', $user->address ?? '') }}">
                                        @error('address')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-header d-flex align-items-center justify-content-between">
                                <h2 class="card-title mb-0">Trạng thái</h2>
                            </div>
                            <div class="card-body">
                                <select name="status" id="status" class="form-control select2">
                                    @foreach ($status as $key => $value)
                                        <option @if (old('status', $user->status->value ?? '') == $key) selected @endif
                                            value="{{ $key }}">
                                            {{ $value }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="card mt-3">
                            <div class="card-header d-flex align-items-center justify-content-between">
                                <h2 class="card-title mb-0">Ảnh đại diện</h2>
                            </div>
                            <div class="card-body">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <span class="image img-cover image-target"><img class="w-100"
                                                src="{{ old('image', $user->image ?? '') ? old('image', $user->image ?? '') : asset('admin/images/not-found.jpg') }}"
                                                alt=""></span>
                                        <input type="hidden" name="image"
                                            value="{{ old('image', $user->image ?? '') }}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card mt-3">
                            <div class="card-header">
                                <h3 class="card-title">
                                    Thao tác
                                </h3>
                            </div>

                            <div class="card-body d-flex align-items-center justify-content-between gap-4">
                                <a href="{{ route('admin.user.index') }}" class="btn btn-secondary w-100">
                                    Quay lại
                                </a>

                                <button type="submit" class="btn btn-primary w-100">
                                    Lưu thay đổi
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        var province_id = '{{ isset($user->province_id) ? $user->province_id : old('province_id') }}'
        var district_id = '{{ isset($user->district_id) ? $user->district_id : old('district_id') }}'
        var ward_id = '{{ isset($user->ward_id) ? $user->ward_id : old('ward_id') }}'
    </script>
@endsection

@push('scripts')
    <script src="{{ asset('admin/js/finder.js') }}"></script>
    <script src="{{ asset('admin/libs/litepicker/dist/litepicker.js?1692870487') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $('.select2').select2({
            theme: 'bootstrap-5'
        });
    </script>
    @php
        $timestamp = time();
    @endphp
    <script src="{{ asset('admin/js/location.js') }}?v={{ $timestamp }}"></script>

    <script>
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
