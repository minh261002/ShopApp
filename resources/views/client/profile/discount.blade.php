@extends('client.layouts.master')

@section('title', 'Mã giảm giá')

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
                    <h2 class="mb-4">Mã giảm giá</h2>

                    <div class="row row-cols-1 row-cols-md-2 gap-4">
                        @forelse($discounts as $discount)
                            <div class="col-12 col-md-6">
                                <div class="bg-red-lt w-100 rounded-xl d-flex">

                                    <div class="d-flex flex-column  p-4 gap-2 w-100">
                                        <h1 class="mb-0 fs-18px fw-bold text-danger">
                                            {{ $discount->code }}
                                        </h1>
                                        <p class="mb-0 fs-12px text-secondary">
                                            {{ $discount->description }}
                                        </p>
                                        <p class="mb-0 fs-12px text-secondary">Hết hạn:
                                            {{ formatDate($discount->date_end) }}</p>
                                    </div>

                                    <div class="d-flex flex-column justify-content-center position-relative w-50 border-start border-2 border-dashed border-gray align-items-center"
                                        style="width:45%; max-width:40%;">

                                        <div class="position-absolute bg-white rounded-circle"
                                            style="width:45px; height:45px; top:-15%; left:-20%;"></div>

                                        {{-- <a class="btn bg-red text-white btn-icon" style="width:45px; height:45px;">
                                            <i class="ti ti-copy fs-18px"></i>
                                        </a> --}}
                                        @if ($discount->orders->count() > 0)
                                            <a class="btn bg-success-lt text-white btn-icon"
                                                style="width:45px; height:45px;">
                                                <i class="ti ti-check fs-18px"></i>
                                            </a>
                                        @else
                                            <a class="btn bg-red text-white btn-icon" style="width:45px; height:45px;">
                                                <i class="ti ti-copy fs-18px"></i>
                                            </a>
                                        @endif

                                        <div class="position-absolute bg-white rounded-circle"
                                            style="width:45px; height:45px; bottom:-15%; left:-20%;"></div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="w-100 alert alert-danger" role="alert">
                                Không có mã giảm giá nào
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
@endpush
