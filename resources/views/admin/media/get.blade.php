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
                    <div class="row row-cols-3 row-cols-md-4 row-cols-lg-6 g-3">
                        @foreach ($files as $file)
                            <div class="col">
                                <a data-fslightbox="gallery"
                                    href="{{ asset("uploads/images/$folder/" . $file->getFilename()) }}">
                                    <div class="img-responsive img-responsive-1x1 rounded border"
                                        style="background-image: url('{{ asset("uploads/images/$folder/" . $file->getFilename()) }}')">
                                    </div>
                                </a>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
