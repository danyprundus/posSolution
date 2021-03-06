@extends('frontend.master')

@section('headerMenu')
    @include('frontend.partial.headerMenu')
@endsection
@section('headerSearch')
    @include('frontend.partial.productSearch')
@endsection
@section('categories')
    @include('frontend.partial.categories')
@endsection
@section('operationOne')
    @include('frontend.partial.operationOne')
@endsection
@section('buyList')
    @include('frontend.partial.buyList')
@endsection
@section('operationTwo')
    @include('frontend.partial.operationTwo')
@endsection
@section('footerScripts')
    @parent
    <script type="text/javascript" src="{{ asset('assets/js/frontend.js') }}"></script>
@endsection
