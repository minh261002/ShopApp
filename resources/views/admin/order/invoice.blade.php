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
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Thông tin hoá đơn</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p class="h3">Người đặt hàng</p>
                            <address>
                                ID: <strong>{{ $order->user->id }}</strong><br>
                                Họ và tên: <strong>{{ $order->user->name }}</strong><br>
                                Email: <strong>
                                    <a href="mailto: {{ $order->user->email }}" class="">
                                        {{ $order->user->email }}
                                    </a>
                                </strong>
                            </address>
                        </div>
                        <div class="col-md-6 text-end">
                            <p class="h3">Người nhận hàng</p>
                            <address>
                                Họ và tên: <strong>
                                    {{ $order->name }}
                                </strong><br>
                                Địa chỉ: <strong>
                                    {{ $order->address }}
                                </strong><br>
                                Số điện thoại: <strong>
                                    <a href="tel: {{ $order->phone }}" class="">
                                        {{ $order->phone }}
                                    </a>
                                </strong><br>
                                Email: <strong>
                                    <a href="mailto: {{ $order->email }}" class="">
                                        {{ $order->email }}
                                    </a>
                                </strong>
                            </address>
                        </div>

                        <div class="col-12 my-5">
                            <h1>Đơn hàng {{ $order->order_number }}</h1>
                        </div>
                    </div>
                    <table class="table table-transparent table-responsive">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 1%"></th>
                                <th>Sản phẩm</th>
                                <th class="text-center" style="width: 1%">Số lượng</th>
                                <th class="text-end" style="width: 10%">Tạm tính</th>
                                <th class="text-end" style="width: 10%">Thành tiền</th>
                            </tr>
                        </thead>
                        @foreach ($order->items as $item)
                            <tr>
                                <td class="text-center">
                                    {{ $loop->iteration }}
                                </td>
                                <td>
                                    <a href="{{ route('admin.product.edit', $item->productVariation->product->id) }}"
                                        class="strong mb-1">
                                        {{ $item->productVariation->product->name }}
                                    </a>
                                    <div class="text-secondary">
                                        @foreach ($item->productVariation->variationAttributes as $attribute)
                                            {{ $attribute->name }}: {{ $attribute->pivot->value }}<br>
                                        @endforeach
                                    </div>
                                </td>
                                <td class="text-center">
                                    {{ $item->quantity }}
                                </td>
                                <td class="text-end">
                                    {{ format_price($item->quantity * $item->price) }}
                                </td>
                                <td class="text-end">
                                    {{ format_price($item->quantity * $item->price) }}
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="4" class="strong text-end">
                                Tạm tính
                            </td>
                            <td class="text-end">
                                {{ format_price($order->transaction->sub_total) }}
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4" class="strong text-end">Giảm giá</td>
                            <td class="text-end">
                                {{ format_price($order->transaction->discount_amount) }}
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4" class="strong text-end">Vận chuyển</td>
                            <td class="text-end">
                                {{ format_price($order->transaction->shipping_fee) }}
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4" class="font-weight-bold text-uppercase text-end">Tổng tiền</td>
                            <td class="font-weight-bold text-end">
                                {{ format_price($order->transaction->grand_total) }}
                            </td>
                        </tr>
                    </table>

                    <div class="d-flex justify-content-end">
                        <a href="" class="btn btn-primary">
                            <i class="ti ti-file-type-xls fs-2 me-2"></i> Excel
                        </a>
                        <a href="" class="btn btn-danger ms-2">
                            <i class="ti ti-file-type-pdf fs-2 me-2"></i> PDF
                        </a>
                    </div>
                </div>
            </div>
        @endsection

        @push('scripts')
            <script src="{{ asset('admin/libs/litepicker/dist/litepicker.js?1692870487') }}"></script>
            <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        @endpush
