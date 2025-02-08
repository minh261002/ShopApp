@extends('client.layouts.master')

@section('title', 'Đơn hàng')

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
                <div class="card-body">
                    <h2 class="mb-4">Đơn hàng</h2>
                    <div class="card">
                        <div class="card-header">
                            <ul class="nav nav-tabs card-header-tabs" data-bs-toggle="tabs" role="tablist">
                                <li class="nav-item {{ !request()->get('status') ? 'show' : '' }}">
                                    <a href="{{ route('profile.order') }}" class="nav-link">Tất cả</a>
                                </li>
                                @foreach ($statusDescriptions as $key => $status)
                                    <li class="nav-item {{ request()->get('status') == $key ? 'show' : '' }}">
                                        <a
                                            href="{{ route('profile.order', ['status' => $key]) }}"class="nav-link">{{ $status }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="card-body">
                            <table class="table table-transparent table-responsive">
                                <thead>
                                    <tr>
                                        <th>Mã đơn hàng</th>
                                        <th class="text-center">Người nhận hàng</th>
                                        <th class="text-center">Số điện thoại</th>
                                        <th class="text-center">Tổng tiền</th>
                                        <th class="text-center">Trạng thái</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($orders as $order)
                                        <tr>
                                            <td>
                                                <a href="{{ route('profile.order.detail', $order->id) }}"
                                                    class="text-decoration-none">
                                                    {{ $order->order_number }}
                                                </a>
                                            </td>
                                            <td class="text-center">{{ $order->name }}</td>
                                            <td class="text-center">{{ $order->phone }}</td>
                                            <td class="text-center">{{ format_price($order->transaction->grand_total) }}
                                            </td>
                                            <td class="text-center">
                                                <span
                                                    @class([
                                                        'badge',
                                                        App\Enums\Order\OrderStatus::from($order->status)->badge(),
                                                    ])>{{ \App\Enums\Order\OrderStatus::getDescription($order->status) }}</span>

                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center">Không có đơn hàng nào</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <div class="d-flex align-items-center justify-content-center">
                                {{ $orders->links('client.layouts.partials.pagination') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
@endpush
