@extends('layout')
@section('title', 'Login Page')
@section('content')

<link rel="stylesheet" href="{{ asset('assets/login.css') }}">

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
    <form action="{{route('login.post')}}" method="POST" id="loginForm" class="login-form">
      @csrf
      <h2>Login</h2>
      <div class="input-group">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" autocomplete="off" required>
      </div>
      <div class="input-group">
        <label for="password">Password</label>
        <input type="password" name="password" id="password" required>
      </div>
      <button type="submit">Login</button>
      <a href="{{route('forget.password')}}" class="forgot-password">Forgot Password?</a>
      <p class="signup-text">Don't have an account?<a href="{{route('register')}}" class="signup-form">Sign Up</a></p>
    </form>

</div>


@endsection()