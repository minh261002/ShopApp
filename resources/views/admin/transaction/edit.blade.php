@extends('admin.layout.master')
@section('title', 'Thông tin giao dịch')

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@section('content')
    <div class="container-fluid">
        <div class="page-header d-print-none">
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h3 class="card-title">
                        Quản lý giao dịch
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
                                    Quản lý giao dịch
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
            <form action="{{ route('admin.transaction.update', $transaction->id) }}" method="POST">
                @csrf
                @method('PUT')

                <input type="hidden" name="id" value="{{ $transaction->id }}">

                <div class="row">
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Thông tin giao dịch</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="user_id">Người thanh toán</label>
                                        <input type="text" class="form-control" value="{{ $transaction->user->name }}"
                                            disabled>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="order_id">Đơn hàng</label>
                                        <input type="text" class="form-control"
                                            value="{{ $transaction->order->order_number }}" disabled>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="sub_total">Tạm tính</label>
                                        <input type="text" class="form-control"
                                            value="{{ format_price($transaction->sub_total) }}" disabled>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="discount_amount">Giảm giá</label>
                                        <input type="text" class="form-control"
                                            value="{{ format_price($transaction->discount_amount) }}" disabled>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="shipping_fee">Phí vận chuyển</label>
                                        <input type="text" class="form-control"
                                            value="{{ format_price($transaction->shipping_fee) }}" disabled>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="grand_total">Tổng tiền</label>
                                        <input type="text" class="form-control"
                                            value="{{ format_price($transaction->grand_total) }}" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Trạng thái giao dịch</h4>
                            </div>

                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="payment_method" class="form-label">Phương thức thanh toán</label>
                                    <select name="payment_method" id="payment_method" class="form-select">
                                        @foreach ($paymentMethod as $key => $status)
                                            <option value="{{ $key }}"
                                                @if ($transaction->payment_method == $key) selected @endif>
                                                {{ $status }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="payment_status" class="form-label">Trạng thái thanh toán</label>
                                    <select name="payment_status" id="payment_status" class="form-select">
                                        @foreach ($paymentStatus as $key => $status)
                                            <option value="{{ $key }}"
                                                @if ($transaction->payment_status == $key) selected @endif>
                                                {{ $status }}
                                            </option>
                                        @endforeach
                                    </select>
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
                                <a href="{{ route('admin.transaction.index') }}" class="btn btn-secondary w-100">
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
    <script src="{{ asset('admin/libs/litepicker/dist/litepicker.js?1692870487') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endpush
