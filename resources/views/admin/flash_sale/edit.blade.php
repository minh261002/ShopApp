@extends('admin.layout.master')
@section('title', 'Chỉnh sửa thông tin')

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@section('content')
    <div class="container-fluid">
        <div class="page-header d-print-none">
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h3 class="card-title">
                        Quản lý chương trình khuyến mãi
                    </h3>

                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin.dashboard') }}">
                                    Dashboard
                                </a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin.flash_sale.index') }}">
                                    Quản lý chương trình khuyến mãi
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
            <form action="{{ route('admin.flash_sale.update') }}" method="POST">
                @csrf
                @method('PUT')

                <input type="hidden" name="sale[id]" value="{{ $flashSale->id }}">

                <div class="row">
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    Thông tin chương trình khuyến mãi
                                </h3>
                            </div>

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 mb-3">
                                        <label class="form-label" for="sale[title]" class="form-label">Tiêu đề</label>
                                        <input type="text" class="form-control" id="sale[title]" name="sale[title]"
                                            value="{{ $flashSale->title }}">
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label" for="sale[start_date]" class="form-label">Ngày bắt
                                            đầu</label>
                                        <input type="text" class="form-control start-picker active" readonly="readonly"
                                            name="sale[start_date]" value="{{ $flashSale->start_date }}">
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label" for="sale[end_date]" class="form-label">Ngày kết
                                            thúc</label>
                                        <input type="text" class="form-control end-picker active" readonly="readonly"
                                            name="sale[end_date]" value="{{ $flashSale->end_date }}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card mt-5">
                            <div class="card-header d-flex align-items-center justify-content-between">
                                <h3 class="card-title">
                                    Thông tin sản phẩm khuyến mãi
                                </h3>
                            </div>

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Giảm giá (%)</label>
                                        <input type="number" class="form-control" name="item[discount]"
                                            value="{{ $flashSale->items->first()->discount }}">
                                    </div>
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Tên sản phẩm</th>
                                                <th scope="col">Giá</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($products as $product)
                                                <tr>
                                                    <th scope="row">
                                                        <input type="checkbox" name="item[product_id][]"
                                                            class="form-check-input" value="{{ $product->id }}"
                                                            {{ in_array($product->id, $flashSale->items->pluck('product_id')->toArray()) ? 'checked' : '' }}>
                                                    </th>
                                                    <td>{{ $product->name }}</td>
                                                    <td>
                                                        @if ($product->variations->first()->sale_price && $product->variations->first()->sale_price > 0)
                                                            {{ format_price($product->variations->first()->sale_price) }}
                                                            <span
                                                                class="text-decoration-line-through">{{ format_price($product->variations->first()->price) }}</span>
                                                        @else
                                                            {{ format_price($product->variations->first()->price) }}
                                                        @endif
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="4" class="text-center">Không có dữ liệu</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    Trạng thái
                                </h3>
                            </div>

                            <div class="card-body">
                                <div class="form-group">
                                    <select class="form-select" name="sale[status]" id="status">
                                        @foreach ($status as $key => $value)
                                            <option value="{{ $key }}"
                                                {{ $key == $flashSale->status->value ? 'selected' : '' }}>
                                                {{ $value }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="card mt-3">
                            <div class="card-header">
                                <h3 class="card-title">
                                    Ảnh
                                </h3>
                            </div>

                            <div class="card-body">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <span class="image img-cover image-target"><img class="w-100"
                                                src="{{ old('sale[image]', $flashSale->image ?? '') ? old('sale[image]', $flashSale->image ?? '') : asset('admin/images/not-found.jpg') }}"
                                                alt=""></span>
                                        <input type="hidden" name="sale[image]"
                                            value="{{ old('sale[image]', $flashSale->image ?? '') }}">
                                    </div>
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
                                <a href="{{ route('admin.flash_sale.index') }}" class="btn btn-secondary w-100">
                                    Quay lại
                                </a>

                                <button type="submit" class="btn btn-primary w-100">
                                    Thêm mới
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
    <script src="{{ asset('admin/libs/litepicker/dist/litepicker.js?1692870487') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        const picker = new Litepicker({
            element: document.querySelector('.start-picker'),
            format: 'YYYY-MM-DD',
            showDropdowns: true,
            showWeekNumbers: false,
            singleMode: true,
            autoApply: true,
            autoRefresh: true,
            lang: 'vi-VN',
            mobileFriendly: true,
            resetButton: true,
            autoRefresh: true,
            dropdowns: {
                minYear: null,
                maxYear: null,
                months: true,
                years: true
            },
            setup: (picker) => {
                picker.on('selected', (date1, date2) => {
                    console.log(date1, date2);
                });
            }
        });

        const picker2 = new Litepicker({
            element: document.querySelector('.end-picker'),
            format: 'YYYY-MM-DD',
            showDropdowns: true,
            showWeekNumbers: false,
            singleMode: true,
            autoApply: true,
            autoRefresh: true,
            lang: 'vi-VN',
            mobileFriendly: true,
            resetButton: true,
            autoRefresh: true,
            dropdowns: {
                minYear: null,
                maxYear: null,
                months: true,
                years: true
            },
            setup: (picker) => {
                picker.on('selected', (date1, date2) => {
                    console.log(date1, date2);
                });
            }
        });
    </script>
@endpush
