@extends('admin.layout.master')
@section('title', 'Đơn hàng ' . $order->order_number)

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@section('content')
    <div class="container-fluid">
        <div class="page-header d-print-none">
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h3 class="card-title">
                        Quản lý đơn hàng
                    </h3>

                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin.dashboard') }}">
                                    Dashboard
                                </a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin.order.index') }}">
                                    Quản lý đơn hàng
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
            <form action="{{ route('admin.order.update') }}" method="POST">
                @csrf
                @method('PUT')

                <input type="hidden" name="id" value="{{ $order->id }}">

                <div class="row">
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    Thông tin đơn hàng
                                </h3>
                            </div>

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Mã đơn hàng</label>
                                        <input type="text" class="form-control" value="{{ $order->order_number }}"
                                            disabled>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Người nhận</label>
                                        <input type="text" class="form-control" value="{{ $order->name }}" disabled>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Email</label>
                                        <input type="text" class="form-control" value="{{ $order->email }}" disabled>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Số điện thoại</label>
                                        <input type="text" class="form-control" value="{{ $order->phone }}" disabled>
                                    </div>

                                    <div class="col-12 mb-3">
                                        <label class="form-label">Địa chỉ</label>
                                        <input type="text" class="form-control" value="{{ $order->address }}" disabled>
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label">Ghi chú</label>
                                        <textarea class="form-control" rows="3" disabled>{{ $order->note }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card mt-5">
                            <div class="card-header">
                                <h3 class="card-title">
                                    Giỏ hàng
                                </h3>
                            </div>

                            <div class="card-body">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th style="width: 100px">Ảnh</th>
                                            <th>Tên sản phẩm</th>
                                            <th>Giá</th>
                                            <th>Số lượng</th>
                                            <th>Thành tiền</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($order->items as $key => $item)
                                            <tr>
                                                <td>
                                                    <img src="{{ $item->productVariation->product->image }}"
                                                        class="img-fluid" style="width: 100px"
                                                        alt="{{ $item->productVariation->product->name }}">
                                                </td>
                                                <td>
                                                    <span class="fw-bold">
                                                        {{ $item->productVariation->product->name }}
                                                    </span>
                                                    <br>
                                                    @foreach ($item->productVariation->variationAttributes as $attribute)
                                                        {{ $attribute->name }}: {{ $attribute->pivot->value }}<br>
                                                    @endforeach
                                                </td>
                                                <td>{{ number_format($item->price) }}đ</td>
                                                <td>{{ $item->quantity }}</td>
                                                <td>{{ number_format($item->price * $item->quantity) }}đ</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="card mt-5">
                            <div class="card-header">
                                <h3 class="card-title">
                                    Mã giảm giá
                                </h3>
                            </div>

                            <div class="card-body">
                                @if ($order->discounts)
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Mã giảm giá</th>
                                                <th>Giảm giá</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach ($order->discounts as $discount)
                                                <tr>
                                                    <td>{{ $discount->code }}
                                                        {{ $discount->description ? ' - ' . $discount->description : '' }}
                                                    </td>
                                                    <td>
                                                        @if ($discount->type->value == \App\Enums\Discount\DiscountType::Percentage->value)
                                                            {{ $discount->percent_value }}%
                                                        @else
                                                            {{ format_price($discount->discount_value) }}
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                @else
                                    <div class="alert alert-info">
                                        Đơn hàng này không áp dụng mã giảm giá
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    Thông tin thanh toán
                                </h3>
                            </div>

                            <div class="card-body">
                                <a href="{{ route('admin.transaction.edit', $order->transaction->id) }}"
                                    class="nav-link text-primary">
                                    Xem thông tin thanh toán
                                </a>
                            </div>
                        </div>

                        <div class="card mt-5">
                            <div class="card-header">
                                <h3 class="card-title">
                                    Thông tin vận chuyển
                                </h3>
                            </div>

                            <div class="card-body">
                                <div class="form-group">
                                    <select class="form-select" name="shipping_method">
                                        @foreach ($shippingMethod as $key => $value)
                                            <option value="{{ $key }}"
                                                {{ $order->shipping_method == $key ? 'selected' : '' }}>
                                                {{ $value }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="card mt-5">
                            <div class="card-header">
                                <h3 class="card-title">
                                    Trạng thái đơn hàng
                                </h3>
                            </div>

                            <div class="card-body">
                                <div class="form-group mb-3">
                                    <select class="form-select" name="status">
                                        @foreach ($status as $key => $value)
                                            @if (array_search($order->status->last()->status, array_keys($status)) <= array_search($key, array_keys($status)))
                                                <option value="{{ $key }}"
                                                    {{ $order->status->last()->status == $key ? 'selected' : '' }}>
                                                    {{ $value }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group" id="cancel_reason" hidden>
                                    <label class="form-label">Lý do huỷ đơn hàng</label>
                                    <textarea class="form-control" name="cancel_reason" rows="3">{{ $order->cancel_reason }}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="card mt-5">
                            <div class="card-header">
                                <h3 class="card-title">
                                    Thao tác
                                </h3>
                            </div>

                            <div class="card-body d-flex align-items-center justify-content-between gap-4">
                                <a href="{{ route('admin.order.index') }}" class="btn btn-secondary w-100">
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
@endsection


@push('scripts')
    <script>
        $(document).ready(function() {
            let cancelStatus = {{ $order->status->last()->status == 'cancelled' ? 'true' : 'false' }};

            if (cancelStatus) {
                $('#cancel_reason').removeAttr('hidden');
            }

            $('select[name="status"]').change(function() {
                if ($(this).val() == 'cancelled') {
                    $('#cancel_reason').removeAttr('hidden');
                } else {
                    $('#cancel_reason').attr('hidden', true);
                }
            });
        });
    </script>
@endpush
