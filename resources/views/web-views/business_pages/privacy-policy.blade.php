@extends('web-views.layouts.app')
@section('title', 'Privacy Policy')
@section('content')
 <!--About Us Area Start Here-->
 <div class="about-us-area pad-head bg-about">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="about-content">
                    <div class="section-title text-center">
                        <h2>Privacy Policy</h2>
                    </div>
                    <ol class="breadcrumb">
                        <li><a href="{{route('home')}}">Home</a></li>
                        <li>|</li>
                        <li>Privacy Policy</li>
                    </ol>
                </div>
            </div>
            <!-- /col-->
        </div>
        <!-- /row-->
    </div>
    <!--/ container-->
</div>
<!--About Us Area End Here-->

<!--Conference Synopsis Area Start Here-->
<div class="conference-synopsis-area about pad100">
    <div class="container">
        <div class="row">
            <div class="col-lg-5 xs-mb40">
                <img class="img-fluid" src="{{asset('assets/web-assets/img/others/element.png')}}" alt="">
            </div>
            <div class="col-lg-7">
                <div class="inner-content">
                    <div class="section-title">
                        <div class="title-text pl">
                            <h2>Privacy Policy</h2>
                        </div>
                    </div>
                    <p>{!!$privacy_policy->content!!}</p>
                </div>
            </div>
            <!-- /col end-->
        </div>
        <!-- /row end-->
    </div>
    <!-- /container end-->
</div>
<!--Conference Synopsis Area End Here-->




@endsection