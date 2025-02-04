@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@php
    $user = auth()->guard('web')->user();
@endphp

<div class="card mb-5">
    <div class="card-header">
        <h2 class="card-title text-left fw-bold">Thông tin khách hàng</h2>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="name" class="form-label">Họ và tên</label>
                <input type="text" class="form-control" id="name" name="order[name]"
                    value="{{ $user->name ?? '' }}">
            </div>

            <div class="col-md-6 mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="order[email]"
                    value="{{ $user->email ?? '' }}">
            </div>

            <div class="col-md-6 mb-3">
                <label for="phone" class="form-label">Số điện thoại</label>
                <input type="text" class="form-control" id="phone" name="order[phone]"
                    value="{{ $user->phone ?? '' }}">
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

            <div class="col-12 mb-3">
                <label for="note" class="form-label">Ghi chú</label>
                <textarea name="order[note]" id="note" class="form-control" rows="3"></textarea>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script src="{{ asset('admin/js/finder.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $('.select2').select2({
            theme: 'bootstrap-5'
        });
    </script>
@endpush
