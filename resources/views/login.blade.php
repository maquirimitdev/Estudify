@extends('layout')
@section('title', 'Login Page')
@section('content')

<link rel="stylesheet" href="{{ asset('assets/login.css') }}">

<div class="container">
    <form action="{{route('login.post')}}" method="POST" id="loginForm" class="login-form">
      @csrf
      <h2>Login</h2>
      <div class="input-group">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" required>
      </div>
      <div class="input-group">
        <label for="password">Password</label>
        <input type="password" name="password" id="password" required>
      </div>
      <button type="submit">Login</button>
      <a href="r" class="forgot-password">Forgot Password?</a>
      <p class="signup-text">Don't have an account?<a href="/register" class="signup-form">Sign Up</a></p>
    </form>

</div>


@endsection()