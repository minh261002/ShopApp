@extends('client.layouts.master')

@section('title', 'Mã giảm giá')

@section('content')
    <div class="card">
        <div class="row g-0">
            <div class="col-12 col-md-3 border-end">
                <div class="card-body">
                    <h4 class="subheader">Cài đặt tài khoản</h4>
                    @include('client.profile.components.sidenav')
                </div>
            </div>
            <div class="col-12 col-md-9 d-flex flex-column">
                <div class="card-body">
                    <h2 class="mb-4">Mã giảm giá</h2>

                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
@endpush
