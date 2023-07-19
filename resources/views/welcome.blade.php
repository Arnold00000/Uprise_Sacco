@extends('layouts.app')

@section('content')
    <div class="header py-7 py-lg-8" style="background-image: url('/images/greebac.jpg'); background-size: cover; background-position: center;">
        <div class="container">
            <div class="header-body text-left mb-7">
                <div class="row">
                    <div class="col-lg-5 col-md-6 rounded-lg p-4 bg-light-green">
                        <h1 class="text-black" style="font-size: 40px;"><strong>{{ __('Welcome To The') }}</strong></h1>
                        <p class="text-lead text-dark-green" style="font-size: 36px;">
                        <strong>{{ __('UPRISE SACCO MANAGEMENT SYSTEM') }}</strong>
                        </p>
                        <div class="d-flex justify-content-end mt-4">
                            <a href="{{ route('login') }}" class="btn btn-primary">{{ __('Login') }}</a>
                            <a href="{{ route('register') }}" class="btn btn-success ml-3">{{ __('Register') }}</a>
                        </div>
                    </div>
                    <div class="col-lg-7 col-md-6">
                    <img src="/images/LOGO.png" alt="Company Logo" class="rounded-circle img-fluid" style="max-width: 240px;">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <style>
        body {
            background-color: rgba(255, 255, 255, 0.9); /* Use your desired background color with opacity */
        }
        
        .bg-light-green {
            background-color: #c7ffd8; /* Use your desired light green color code */
        }
        
        .text-black {
            color: #000000; /* Black color */
        }
        
        .text-dark-green {
            color: #005500; /* Dark green color */
        }
        
        .rounded-lg {
            border-radius: 20px; /* Adjust the value as needed */
        }
    </style>
@endsection
