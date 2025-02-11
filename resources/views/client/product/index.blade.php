@extends('client.layouts.master')

@section('title', 'Danh sách sản phẩm')

@section('content')
    <div class="py-5">
        <div class="row">
            <div class="col-md-3">
                @include('client.product.components.box-filter')
            </div>

            <div class="col-md-9">
                @if (request()->q)
                    <p class="fw-semibold fs-18px mb-2">
                        Tìm thấy {{ $products->total() }} sản phẩm với từ khóa "{{ request()->q }}"
                    </p>
                @endif
                <div class="row">
                    @forelse ($products as $item)
                        <div class="col-md-3">
                            <div class="card border-0">
                                <div class="card-body p-0 border-gray rounded-2">
                                    <div class="img-wrapper" style="height: 340px; object-fit: cover;">
                                        <a href="{{ route('product.detail', $item->slug) }}">
                                            <img src="{{ $item->image }}" alt="{{ $item->name }}"
                                                class="w-100 h-100 rounded-2">
                                        </a>
                                    </div>

                                    <div class="d-flex flex-column mt-3 px-3">
                                        <div class="d-flex mb-1">
                                            @for ($i = 0; $i < 5; $i++)
                                                <i class="ti ti-star text-yellow"></i>
                                            @endfor
                                        </div>

                                        <a href="{{ route('product.detail', $item->slug) }}"
                                            class="text-dark fs-14px fw-normal text-decoration-none">
                                            {{ limit_text($item->name, 30) }}
                                        </a>

                                        <div class="d-flex align-items-center justify-content-between">
                                            @if ($item->variations->first()->sale_price)
                                                <p class="mb-0 text-danger fs-18px fw-semibold">
                                                    {{ format_price($item->variations->first()->sale_price) }}
                                                </p>
                                                <p class="mb-0 text-muted fs-14px text-decoration-line-through">
                                                    {{ format_price($item->variations->first()->price) }}
                                                </p>
                                            @else
                                                <p class="mb-0 text-danger fs-18px fw-semibold">
                                                    {{ format_price($item->variations->first()->price) }}
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="alert alert-danger" role="alert">
                            <p class="text-center">Không tìm thấy sản phẩm nào</p>
                        </div>
                    @endforelse
                </div>

                <div class="d-flex justify-content-center mt-3">
                    {{ $products->links('client.layouts.partials.pagination') }}
                </div>
            </div>
        </div>
    </div>
@endsection
