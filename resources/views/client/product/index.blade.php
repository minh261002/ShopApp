@extends('client.layouts.master')

@section('title', 'Danh sách sản phẩm')

@section('content')
    <div class="py-5">
        <div class="row">
            <div class="col-md-3">
                @include('client.product.components.box-filter')
            </div>

            <div class="col-md-9">
                <div class="row">
                    @foreach ($products as $product)
                        <div class="col-md-4 mb-4">
                            <img src="{{ $product->image }}" alt="">
                        </div>
                    @endforeach
                </div>

                <div class="d-flex justify-content-center">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
