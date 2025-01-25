@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@php
    $user = auth()->guard('web')->user();
@endphp
<h1 class="text-left fw-bold mb-4">Khách hàng</h1>

<div class="card mb-5">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="name" class="form-label">Họ và tên</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $user->name ?? '' }}">
            </div>

            <div class="col-md-6 mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email"
                    value="{{ $user->email ?? '' }}">
            </div>

            <div class="col-md-6 mb-3">
                <label for="phone" class="form-label">Số điện thoại</label>
                <input type="text" class="form-control" id="phone" name="phone"
                    value="{{ $user->phone ?? '' }}">
            </div>

            <div class="col-md-6 mb-3">
                <label for="address" class="form-label">Địa chỉ</label>
                <input type="text" class="form-control" id="address"
                    name="address"value="{{ $user->address ?? '' }}">
            </div>

            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="province_id" class="form-label">Chọn Tỉnh / Thành Phố</label>
                    <select name="province_id" class="form-control select2 province location" data-target="districts">
                        <option value="0">[Chọn Tỉnh / Thành Phố]</option>
                        @if (isset($provinces))
                            @foreach ($provinces as $province)
                                <option @if (old('province_id') == $province->code) selected @endif value="{{ $province->code }}">
                                    {{ $province->name_with_type }}
                                </option>
                            @endforeach
                        @endif
                    </select>
                </div>

                <div class="col-md-4 mb-3">
                    <label for="" class="form-label">Chọn Quận / Huyện </label>
                    <select name="district_id" class="form-control districts select2 location" data-target="wards">
                        <option value="0">[Chọn Quận / Huyện]</option>
                    </select>
                </div>

                <div class="col-md-4 mb-3">
                    <label for="" class="form-label">Chọn Phường / Xã </label>
                    <select name="ward_id" class="form-control select2 wards">
                        <option value="0">[Chọn Phường / Xã]</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <script>
        var province_id = '{{ isset($user->province_id) ? $user->province_id : old('province_id') }}'
        var district_id = '{{ isset($user->district_id) ? $user->district_id : old('district_id') }}'
        var ward_id = '{{ isset($user->ward_id) ? $user->ward_id : old('ward_id') }}'
    </script>
</div>

@push('scripts')
    <script src="{{ asset('admin/js/location.js') }}"></script>
    <script src="{{ asset('admin/js/finder.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $('.select2').select2({
            theme: 'bootstrap-5'
        });
    </script>
@endpush
