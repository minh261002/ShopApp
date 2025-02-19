@extends('client.layouts.master')

@section('title', $product->meta_title ?? $product->name)

@section('content')
    @php
        $gallery = json_decode($product->gallery);
    @endphp
    <div class="py-5">
        <form class="container" action="{{ route('cart.store') }}" method="post">
            @csrf

            <nav class="mb-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a class="text-black fs-18px" href="{{ route('home') }}">Trang chủ</a></li>

                    @foreach ($product->categories as $category)
                        <li class="breadcrumb-item">
                            <a class=" text-black fs-18px" href="">{{ $category->name }}</a>
                        </li>
                    @endforeach

                    <li class="breadcrumb-item active text-black fs-18px" aria-current="page">
                        {{ $product->name }}
                    </li>

                </ol>
            </nav>

            <div class="row">
                <div class="col-md-6 pe-4">
                    @include('client.product.components.box-image')
                </div>

                <div class="col-md-6 ps-4">
                    @include('client.product.components.box-info')
                </div>
            </div>
        </form>

        <div class="mt-5">
            @include('client.product.components.box-desc')
        </div>

        <div class="mt-5">
            @include('client.product.components.box-related')
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $('.owl-carousel').owlCarousel({
            loop: true,
            margin: 10,
            nav: false,
            dots: false,
            autoplay: true,
            autoplayTimeout: 3000,
            autoplayHoverPause: true,
            responsive: {
                0: {
                    items: 2
                },
                600: {
                    items: 3
                },
                1000: {
                    items: 5
                }
            }
        })
    </script>
    <script>
        $('.product-gallery-preview-item').first().addClass('border border-danger')

        $('.product-gallery-preview-item').on('click', function() {
            let src = $(this).find('img').attr('src')
            $('.product-gallery-preview img').attr('src', src)
            //thêm viền đỏ cho ảnh nào được preview
            $('.product-gallery-preview-item').removeClass('border border-danger')
            $(this).addClass('border border-danger')
            //hiệu ứng carousel
            $('.owl-carousel').trigger('to.owl.carousel', [$(this).index(), 300])

        })
    </script>

    <script>
        $(document).ready(function() {

        })
    </script>
@endpush
