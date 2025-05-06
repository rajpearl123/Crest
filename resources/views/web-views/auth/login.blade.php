@extends('web-views.layouts.app')
@php $websiteSetting = App\Models\WebsiteSetting::first(); @endphp
@section('title', $websiteSetting->name)
@section('content')

<div class="about-us-area pad-head bg-about">
    <section class="user_registration">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="inner-content">
                        <div class="section-title">
                            <div class="title-text register-text-heading">
                                <h2>Welcome Back</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="_main_register">
                        <form action="{{route('login-store')}}" method="POST" class="registration-form">
                            @csrf
                            <h2>Login</h2>
                            <div class="input-group">
                                <label for="email">Email</label>
                                <input type="email" id="email" name="email" placeholder="Email" required>
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <label for="password" class="form-label">Password</label>
                                    <a href="{{route('forgotPassword')}}" class="text-decoration-none text-primary">Forgot Password?</a>
                                </div>
                                <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
                                @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="text-center d-flex justify-content-center">
                                <button type="submit" class="submit-btn">Login</button>
                            </div>
                            <div class="divider"><span>Or</span></div>
                            <a href="{{ url('auth/google') }}" class="login_google_button"> <img src="https://cdn-icons-png.flaticon.com/128/300/300221.png" alt="">
                                <span class="css-vseokx e1wnkr790">Continue with Google</span>
                            </a>
                            <p class="my-3 text-center"> Don't have an account yet ? <a href="{{route('register')}}"> Sign Up</a></p>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </section>
</div>


@endsection

@push('script')

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{ asset('assets/web-assets/js/register.js') }}"></script>
@endpush