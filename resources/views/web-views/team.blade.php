@php  
    $websiteSetting = \App\Models\WebsiteSetting::first();
@endphp
@php
    $banner = getBanner('photo_gallery');
@endphp
@extends('web-views.layouts.app')
@section('title', $websiteSetting->name)
@section('content')

@endsection