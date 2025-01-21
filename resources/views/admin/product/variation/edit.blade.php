@extends('admin.layout.master')
@section('title', 'Chỉnh sửa thông tin')

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@php
    $randomSKU = 'SP' . rand(100000000, 999999000);
    $product = \App\Models\Product::find($variation->product_id);
@endphp

@section('content')
    <div class="container-fluid">
        <div class="page-header d-print-none">
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h3 class="card-title">
                        {{ $product->name }}
                    </h3>

                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin.dashboard') }}">
                                    Dashboard
                                </a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin.product.index') }}">
                                    Quản lý sản phẩm
                                </a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin.product.variation.index', $product->id) }}">
                                    {{ $product->name }}
                                </a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Thêm biến thể sản phẩm mới
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <!-- Page body -->
        <div class="page-body">
            <form action="{{ route('admin.product.variation.update') }}" method="POST">
                @csrf
                @method('PUT')

                <input type="hidden" name="product_id" value="{{ $product->id }}" />
                <input type="hidden" name="id" value="{{ $variation->id }}" />

                <div class="row">
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    Thông tin biến thể sản phẩm
                                </h3>
                            </div>

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="sku" class="form-label">
                                            SKU
                                        </label>

                                        <input type="text" name="sku" id="sku" class="form-control"
                                            value="{{ $variation->sku ?? $randomSKU }}" />
                                    </div>

                                    @foreach ($variationAttributes as $attribute)
                                        <div class="col-md-6 mb-3">
                                            <label for="attribute_{{ $attribute->id }}" class="form-label">
                                                {{ $attribute->name }}
                                            </label>

                                            <input type="text" name="attributes[{{ $attribute->id }}]"
                                                id="attribute_{{ $attribute->id }}" class="form-control"
                                                value="{{ $variationValues[$attribute->id] }}" />
                                        </div>
                                    @endforeach


                                    <div class="col-md-6 mb-3">
                                        <label for="price" class="form-label">
                                            Giá bán
                                        </label>

                                        <input type="number" name="price" id="price" class="form-control"
                                            value="{{ $variation->price }}" />
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="sale_price" class="form-label">
                                            Giá khuyến mãi
                                        </label>

                                        <input type="number" name="sale_price" id="sale_price" class="form-control"
                                            value="{{ $variation->sale_price }}" />
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="stock" class="form-label">
                                            Số lượng tồn kho
                                        </label>

                                        <input type="number" name="stock" id="stock" class="form-control"
                                            value="{{ $variation->stock }}" />
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    Thao tác
                                </h3>
                            </div>

                            <div class="card-body d-flex align-items-center justify-content-between gap-4">
                                <a href="{{ route('admin.product.variation.index', $product->id) }}"
                                    class="btn btn-secondary w-100">
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
    <script src="{{ asset('admin/js/finder.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $('.select2').select2({
            theme: 'bootstrap-5'
        });
    </script>
@endpush
