@extends('layout')
@section('content')

<link rel="stylesheet" href="{{ asset('assets/login.css') }}">


<main>
    <div class="container">
        <div class="mt-5">
        <!-- @if($errors->any())
        <div class ="col-12">
            @foreach($errors->all() as $error)
            <div class= "alert alert-danger"> {{$error}}</div>
            @endforeach
        </div>
        @endif -->
        
        @if(session()->has('error'))
        <div class="alert alert-danger">{{session('error')}}</div>
        @endif

        @if(session()->has('success'))
        <div class="alert alert-success">{{session('success')}}</div>
        @endif

        </div>
    
        <form action="{{route('forget.password.post')}}" method="POST" id="loginForm" class="login-form">
            @csrf
            <h2>Forgot Password</h2>
            <p>We will send a link to your email, use that link to reset password.</p>
            <div class="input-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" value="{{old('email')}}" required>
            </div>
            <button type="submit">send password reset link</button>
        </form>
    </div>
</main>
@endsection