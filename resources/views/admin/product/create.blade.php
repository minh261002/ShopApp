@extends('admin.layout.master')
@section('title', 'Thêm sản phẩm mới')

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@section('content')
    <div class="container-fluid">
        <div class="page-header d-print-none">
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h3 class="card-title">
                        Quản lý sản phẩm
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
                            <li class="breadcrumb-item active" aria-current="page">
                                Thêm sản phẩm mới
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <!-- Page body -->
        <div class="page-body">
            <form action="{{ route('admin.product.store') }}" method="POST">
                @csrf

                <div class="row">
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    Thông tin sản phẩm
                                </h3>
                            </div>

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 mb-3">
                                        <label for="product[name]" class="form-label">Tên sản phẩm</label>
                                        <input type="text" class="form-control" id="product[name]" name="product[name]"
                                            value="{{ old('product[name]') }}">
                                        @error('product[name]')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-12 mb-3">
                                        <label for="product[short_desc]" class="form-label">Mô tả ngắn</label>
                                        <textarea name="product[short_desc]" class="form-control" id="product[short_desc]">{{ old('product[short_desc]') }}</textarea>
                                        @error('product[short_desc]')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-12 mb-3">
                                        <label for="product[desc]" class="form-label">Mô tả</label>
                                        <textarea name="product[desc]" class="form-control ck-editor" id="product[desc]">{{ old('product[desc]') }}</textarea>
                                        @error('product[desc]')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card mt-3">
                            <div class="card-header d-flex align-items-center justify-content-between">
                                <h2 class="card-title mb-0">Bộ sưu tập ảnh</h2>
                                <div class="upload-album"><a href="" class="upload-picture">Tải lên</a></div>
                            </div>

                            <div class="card-body">
                                <div class="col-lg-12">
                                    @if (!isset($gallery) || count($gallery) == 0)
                                        <div class="click-to-upload">
                                            <div class="icon">
                                                <a href="" class="upload-picture">
                                                    <svg style="width:80px;height:80px;fill: #d3dbe2;margin-bottom: 10px;"
                                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 80 80">
                                                        <path
                                                            d="M80 57.6l-4-18.7v-23.9c0-1.1-.9-2-2-2h-3.5l-1.1-5.4c-.3-1.1-1.4-1.8-2.4-1.6l-32.6 7h-27.4c-1.1 0-2 .9-2 2v4.3l-3.4.7c-1.1.2-1.8 1.3-1.5 2.4l5 23.4v20.2c0 1.1.9 2 2 2h2.7l.9 4.4c.2.9 1 1.6 2 1.6h.4l27.9-6h33c1.1 0 2-.9 2-2v-5.5l2.4-.5c1.1-.2 1.8-1.3 1.6-2.4zm-75-21.5l-3-14.1 3-.6v14.7zm62.4-28.1l1.1 5h-24.5l23.4-5zm-54.8 64l-.8-4h19.6l-18.8 4zm37.7-6h-43.3v-51h67v51h-23.7zm25.7-7.5v-9.9l2 9.4-2 .5zm-52-21.5c-2.8 0-5-2.2-5-5s2.2-5 5-5 5 2.2 5 5-2.2 5-5 5zm0-8c-1.7 0-3 1.3-3 3s1.3 3 3 3 3-1.3 3-3-1.3-3-3-3zm-13-10v43h59v-43h-59zm57 2v24.1l-12.8-12.8c-3-3-7.9-3-11 0l-13.3 13.2-.1-.1c-1.1-1.1-2.5-1.7-4.1-1.7-1.5 0-3 .6-4.1 1.7l-9.6 9.8v-34.2h55zm-55 39v-2l11.1-11.2c1.4-1.4 3.9-1.4 5.3 0l9.7 9.7c-5.2 1.3-9 2.4-9.4 2.5l-3.7 1h-13zm55 0h-34.2c7.1-2 23.2-5.9 33-5.9l1.2-.1v6zm-1.3-7.9c-7.2 0-17.4 2-25.3 3.9l-9.1-9.1 13.3-13.3c2.2-2.2 5.9-2.2 8.1 0l14.3 14.3v4.1l-1.3.1z">
                                                        </path>
                                                    </svg>
                                                </a>
                                            </div>
                                            <div class="small-text">
                                                <p>Click vào nút "Tải lên" để thêm ảnh</p>
                                            </div>
                                        </div>
                                    @endif
                                    @php
                                        $gallery = old('product.gallery') ?? ($product->gallery ?? []);
                                    @endphp
                                    <div class="upload-list {{ isset($gallery) && count($gallery) ? '' : 'hidden' }}">
                                        <ul id="sortable" class="clearfix data-album sortui ui-sortable">
                                            @if (isset($gallery) && count($gallery))
                                                @foreach ($gallery as $key => $val)
                                                    <li class="ui-state-default">
                                                        <div class="thumb">
                                                            <span class="span image img-scaledown">
                                                                <img src="{{ $val }}" alt="{{ $val }}">
                                                                <input type="hidden" name="product[gallery][]"
                                                                    value="{{ $val }}">
                                                            </span>
                                                            <button class="delete-image">
                                                                <i class="fa-solid fa-trash"></i>
                                                            </button>
                                                        </div>
                                                    </li>
                                                @endforeach
                                            @endif
                                        </ul>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="card mt-3">
                            <div class="card-header d-flex align-items-center justify-content-between">
                                <h2 class="card-title">Chi tiết sản phẩm</h2>
                            </div>

                            <div class="card-body">

                            </div>
                        </div>

                        <div class="card mt-3">
                            <div class="card-header d-flex align-items-center justify-content-between">
                                <h2 class="card-title">SEO</h2>
                            </div>

                            <div class="card-body">
                                <div class="form-group mb-3">
                                    <label for="meta_title" class="form-label">Tiêu đề SEO</label>
                                    <input type="text" class="form-control" id="meta_title" name="meta_title"
                                        value="{{ old('meta_title') }}">
                                    <span class="error-title text-danger"></span>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="meta_description" class="form-label">Mô tả SEO</label>
                                    <textarea name="meta_description" class="form-control" id="meta_description">{{ old('meta_description') }}</textarea>
                                    <span class="error-desc text-danger"></span>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="meta_keywords" class="form-label">Từ khóa SEO
                                        (Phân cách bằng dấu phẩy)
                                    </label>
                                    <input type="text" class="form-control" id="meta_keywords" name="meta_keywords"
                                        value="{{ old('meta_keywords') }}">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-header d-flex align-items-center justify-content-between">
                                <h2 class="card-title">Danh mục</h2>
                            </div>

                            <div class="card-body">
                                <div class="form-group mb-3" id="categories_result">
                                </div>

                                <div class="text-center mt-3">
                                    <p id="loadMoreCategory" style="cursor:pointer">Xem thêm</p>
                                    <p id="hideCategory" class="hidden" style="cursor:pointer">Ẩn bớt</p>
                                </div>
                            </div>
                        </div>

                        <div class="card mt-3">
                            <div class="card-header">
                                <h3 class="card-title">
                                    Trạng thái
                                </h3>
                            </div>

                            <div class="card-body">
                                <div class="form-group mb-3">
                                    <select class="form-select" name="status" id="status">
                                        @foreach ($status as $key => $value)
                                            <option value="{{ $key }}">{{ $value }}</option>
                                        @endforeach
                                    </select>

                                    @error('status')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
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
                                                src="{{ old('image') ? old('image') : asset('admin/images/not-found.jpg') }}"
                                                alt=""></span>
                                        <input type="hidden" name="image" value="{{ old('image') }}">
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
                                <a href="{{ route('admin.post.index') }}" class="btn btn-secondary w-100">
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
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $('.select2').select2({
            theme: 'bootstrap-5'
        });

        // Load more category
        $(document).ready(function() {
            let offset = 0;
            let totalCategories = 0;
            const limit = 10;
            let keyword = '';

            function getCategories(hidePrevious = false) {
                let url = "{{ route('admin.category.get') }}";
                $.ajax({
                    url: url,
                    type: 'GET',
                    data: {
                        offset: offset,
                        search: keyword
                    },
                    beforeSend: function() {
                        $('#categories_result').append(
                            '<div class="d-flex align-items-center justify-content-center"><div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div></div>'
                        );
                    },
                    success: function(response) {
                        let categories = response.categories;
                        totalcategories = response.total;
                        let html = '';

                        categories.forEach(category => {
                            html += `
                                <div class="form-check" style="margin-left: ${category.depth * 20}px;">
                                    <input
                                        class="form-check-input"
                                        type="checkbox"
                                        value="${category.id}"
                                        name="product[category_id][]"
                                        data-lft="${category._lft}"
                                        data-rgt="${category._rgt}"
                                        id="category_id-${category.id}"
                                        >
                                    <label class="form-check-label" for="category_id-${category.id}">
                                        ${category.name}
                                    </label>
                                </div>
                            `;
                        });

                        if (hidePrevious) {
                            $('#categories_result').html(html);
                        } else {
                            $('#categories_result').append(html);
                        }

                        if (offset + categories.length >= totalcategories) {
                            $('#loadMoreCategory').hide();
                        } else {
                            $('#loadMoreCategory').show();
                        }

                        if (offset > 0) {
                            $('#hideCategory').show();
                        } else {
                            $('#hideCategory').hide();
                        }
                    },
                    complete: function() {
                        $('#categories_result').find('.spinner-border').remove();
                    }
                });
            }

            $('#loadMoreCategory').click(function() {
                offset += limit;
                getCategories();
            });

            $('#hideCategory').click(function() {
                offset = 0;
                getCategories(true);
            });

            $('#search_category').on('input', function() {
                clearTimeout($.data(this, 'timer'));
                let search = $(this).val();
                $(this).data('timer', setTimeout(function() {
                    keyword = search;
                    offset = 0;
                    getCategories(true);
                }, 500));
            });

            getCategories();
        })

        $(document).on('change', 'input[type="checkbox"]', function() {
            let lft = $(this).data('lft');
            let rgt = $(this).data('rgt');
            let checked = $(this).prop('checked');

            if (checked) {
                $('input[type="checkbox"]').each(function() {
                    let parentLft = $(this).data('lft');
                    let parentRgt = $(this).data('rgt');

                    if (parentLft < lft && parentRgt > rgt) {
                        $(this).prop('checked', true);
                    }
                });
            } else {
                $('input[type="checkbox"]').each(function() {
                    let parentLft = $(this).data('lft');
                    let parentRgt = $(this).data('rgt');

                    if (parentLft < lft && parentRgt > rgt) {
                        $(this).prop('checked', false);
                    }
                });
            }
        });
    </script>
@endpush
