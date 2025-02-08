@extends('admin.layout.master')


@section('title', 'Quản lý tệp tin')
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
                        Danh sách tệp tin
                    </h3>
                    <div class="card-actions">

                    </div>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="card-body">
                            <div class="row">
                                @foreach ($directories as $folder)
                                    <div class="col-xl-4 col-sm-6 py-2">
                                        <div class="card shadow-none border">
                                            <div class="card-body p-3">
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar align-self-center me-3">
                                                        <div
                                                            class="avatar-title rounded bg-soft-primary text-primary font-size-24">
                                                            <i class="ti ti-folder"></i>
                                                        </div>
                                                    </div>

                                                    <div class="flex-1">
                                                        <h5 class="font-size-15 mb-1">
                                                            {{ basename($folder) }}
                                                        </h5>
                                                        <a href="{{ route('admin.media.get', ['folder' => basename($folder)]) }}"
                                                            class="font-size-13 text-muted">
                                                            <u>
                                                                Xem thư mục
                                                            </u>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
