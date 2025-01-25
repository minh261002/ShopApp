@extends('client.layouts.master')

@section('title', 'Thanh toán đơn hàng')

@section('content')
    <div class="py-5">
        @if (empty($cart))
            <div class="w-100 d-flex align-items-center justify-content-center">
                <div class="d-flex flex-column align-items-center gap-4">
                    <img src="https://res.cloudinary.com/doy3slx9i/image/upload/v1735373251/Pengu/oops_k6dat1.svg"
                        alt="" class="img-fluid"
                        style="width: 100%; height: 300px; object-fit: cover; object-position: center;">

                    <h1 class="mb-0 text-center fw-normal fs-18px">Giỏ hàng của bạn đang trống!</h1>
                    <a href="{{ route('home') }}" class="btn btn-danger">Tiếp tục mua hàng</a>
                </div>
            </div>
        @else
            <div class="row">
                <div class="col-md-9">
                    @include('client.checkout.components.user-info')
                    @include('client.checkout.components.cart-tabler')
                </div>
                <div class="col-md-3">
                    @include('client.checkout.components.cart-summary')
                </div>
            </div>
        @endif
    </div>
@endsection
