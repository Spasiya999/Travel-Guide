@extends('layouts.app')

@section('content')
    @include('web.home.components.header')

    @include('web.home.components.categories')

    @include('web.home.components.packages')

    @include('web.home.components.about_us')

    @include('web.home.components.destination')

    @include('web.home.components.testimonial')

    @include('web.home.components.gallery')
@endsection
