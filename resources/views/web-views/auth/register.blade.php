@extends('web-views.layouts.app')
@php $websiteSetting = App\Models\WebsiteSetting::first(); @endphp
@section('title', $websiteSetting->name)
@section('content')

<div class="about-us-area pad-head bg-about">
    <section class="user_registration">
        <div class="container">
            <div class="row">
                <div class="col-md-6 m-auto">
                    <div class="_main_register">
                        <img src="{{ $websiteSetting->header_logo ? asset('assets/images/logo/' . $websiteSetting->header_logo) : asset('assets/images/logo/logo.jpg') }}" alt="" class="register_logo">
                        <form action="{{route('register-store')}}" method="POST" class="registration-form">
                            @csrf
                            <h2>Ready to take the next step?</h2>
                            <p>Create an account or sign in.</p>
                            <div class="input-group">
                                <label for="username">Full Name</label>
                                <input type="text" id="name" name="name" placeholder="Full Name" required>
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="input-group">
                                <label for="email">Email</label>
                                <input type="email" id="email" name="email" placeholder="Email" required>
                                @error('email')
                                    <span class="text-white">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="input-group">
                                <label for="Phone">Phone</label>
                                <input type="text" id="phone" name="phone" placeholder="Phone" required>
                                @error('phone')
                                    <span class="text-white">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="input-group">
                                <label for="password">Password</label>
                                <input type="password" id="password" name="password" placeholder="Password" required>
                                @error('password')
                                    <span class="text-white">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="input-group">
                                <label for="confirm-password">Confirm Password</label>
                                <input type="password" id="confirm-password" name="confirm_password" placeholder="Confirm Password" required>
                                @error('confirm_password')
                                    <span class="text-white">{{ $message }}</span>
                                @enderror
                            </div>
                            <span id="confirm-password-message"></span>
                            <div class="divider"><span>Or</span></div>
                            <a href="{{ url('auth/google') }}" class="login_google_button"> <img src="https://cdn-icons-png.flaticon.com/128/300/300221.png" alt="">
                                <span class="css-vseokx e1wnkr790">Continue with Google</span>
                            </a>
                            <div class="text-center d-flex justify-content-center mt-3">
                                <button type="submit" class="submit-btn">Register</button>
                            </div>
                            <p class="my-3 text-center"> Already have an account ? <a href="{{route('login')}}"><strong>Login</strong></a></p>
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