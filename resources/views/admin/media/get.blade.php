@extends('admin.layout.master')


@section('title', 'Thư mục: ' . basename($folder))
@section('content')

    <div class="container-fluid">
        <div class="page-header d-print-none">
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h3 class="card-title">
                        Quản lý tệp tin
                    </h3>

                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin.dashboard') }}">
                                    <i class="bi bi-house"></i>
                                    Dashboard
                                </a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Quản lý tệp tin
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
                        Thư mục: {{ basename($folder) }}
                    </h3>
                    <div class="card-actions">

                    </div>
                </div>

                <div class="card-body">
                    <div class="d-flex mb-3">
                        <div>
                            <button type="button" class="btn btn-outline-primary" id="check-all">
                                Chọn tất cả
                            </button>
                            <button type="button" class="btn btn-outline-primary" id="uncheck-all">
                                Bỏ chọn tất cả
                            </button>
                        </div>

                        <div class="ms-auto ">
                            <button type="button" class="btn btn-danger d-none" id="delete-selected">
                                Xóa
                            </button>
                        </div>
                    </div>
                    <div class="row row-cols-3 row-cols-md-4 row-cols-lg-6 g-3">
                        @foreach ($files as $file)
                            <div class="col">
                                <label class="form-imagecheck mb-2">
                                    <input name="form-imagecheck" type="checkbox" value="1"
                                        class="form-imagecheck-input">
                                    <span class="form-imagecheck-figure">
                                        <img src="{{ asset("uploads/images/$folder/" . $file->getFilename()) }}"
                                            alt="image" class="form-imagecheck-image">
                                    </span>
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('.form-imagecheck-input').change(function() {
                if ($('.form-imagecheck-input:checked').length > 0) {
                    $('#delete-selected').removeClass('d-none');
                } else {
                    $('#delete-selected').addClass('d-none');
                }
            });

            $('#check-all').click(function() {
                $('.form-imagecheck-input').prop('checked', true);
                $('#delete-selected').removeClass('d-none');
            });

            $('#uncheck-all').click(function() {
                $('.form-imagecheck-input').prop('checked', false);
                $('#delete-selected').addClass('d-none');
            });

            $('#delete-selected').click(function() {
                //thay chữ xoá bằng loading
                $(this).html(
                    '<div class="spinner-border spinner-border-sm" role="status"><span class="visually-hidden">Loading...</span></div>'
                );

                var files = [];

                $('.form-imagecheck-input:checked').each(function() {
                    files.push($(this).parent().parent().find('img').attr('src'));
                });

                if (files.length > 0) {
                    $.ajax({
                        url: '{{ route('admin.media.delete') }}',
                        type: 'POST',
                        data: {
                            files: files,
                            folder: '{{ $folder }}',
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            location.reload();
                        }
                    });
                }
            });
        });
    </script>
@endpush
