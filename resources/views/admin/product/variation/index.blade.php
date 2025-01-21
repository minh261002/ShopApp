@php
    $product = \App\Models\Product::find(request()->route('id'));
@endphp

@extends('admin.layout.master')
@section('title', " $product->name ")

@push('styles')
@endpush



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
                                    <i class="bi bi-house"></i>
                                    Dashboard
                                </a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin.product.index') }}">
                                    <i class="bi bi-house"></i>
                                    Quản lý sản phẩm
                                </a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                {{ $product->name }}
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
                    <h3 class="card-title">
                        Danh sách biến thể sản phẩm
                    </h3>
                    <div class="card-actions">
                        <a href="{{ route('admin.product.variation.create', $product->id) }}" class="btn btn-primary">
                            <i class="ti ti-plus fs-4 me-1"></i>
                            Thêm mới
                        </a>
                    </div>
                </div>


                <div class="card-body">
                    <div class="table-responsive">
                        @include('admin.layout.partials.toggle-column')
                        {{ $dataTable->table(['class' => 'table table-bordered table-striped'], true) }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('libs-js')
    <script src="{{ asset('admin/js/buttons.server-side.js') }}"></script>
@endpush

@push('scripts')
    {{ $dataTable->scripts() }}

    @include('admin.layout.partials.scripts', [
        'id_table' => $dataTable->getTableAttribute('id'),
    ])
@endpush
