@extends('client.layouts.master')

@section('title', 'Pengu - Hệ thống cửa hàng thời trang toàn quốc')

@section('content')
    @include('client.home.components.carousel')
    @include('client.home.components.category')
    @include('client.home.components.discount')
    @include('client.home.components.hot')
    @include('client.home.components.new')
    @include('client.home.components.viewed')
@endsection
