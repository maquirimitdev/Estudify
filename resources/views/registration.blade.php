@extends('layout')
@section('title', 'Signup Page')
@section('content')

<link rel="stylesheet" href="{{ asset('assets/signup.css') }}">

<div class="container">
    <form action="{{route('register.post')}}" method="POST" id="signupForm" class="signup-form">
      @csrf
      <h2>Sign Up</h2>
      <div class="input-group">
        <label for="name">Name</label>
        <input type="text" name="name" id="name" required>
      </div>
      <div class="input-group">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" required>
      </div>
      <div class="input-group">
        <label for="password">Password</label>
        <input type="password" name="password" id="password" required>
      </div>
      <div class="input-group">
        <label for="password_confirmation">Confirm Password</label>
        <input type="password" name="password_confirmation" id="confirmPassword" required>
      </div>
      <button type="submit">Sign Up</button>
      <a href="login" class="login-form">Already have an account? Log in</a>
    </form>

  </div>


@endsection()