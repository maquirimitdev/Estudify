@extends('layout')
@section('title', 'Signup Page')
@section('content')

<link rel="stylesheet" href="{{ asset('assets/signup.css') }}">

<div class="container">
  <div class="mt-0">
    @if($errors->any())
    <div class ="col-10">
      @foreach($errors->all() as $error)
      <div class= "alert alert-danger"> {{$error}}</div>
      @endforeach
    </div>
    @endif
    
    @if(session()->has('error'))
    <div class="alert alert-danger">{{session('error')}}</div>
    @endif

    @if(session()->has('success'))
    <div class="alert alert-success">{{session('success')}}</div>
    @endif

  </div>
    <form action="{{route('register.post')}}" method="POST" id="signupForm" class="signup-form">
      @csrf
      <h2>Sign Up</h2>
      <div class="input-group">
        <label for="name">Name</label>
        <input type="text" name="name" id="name" value="{{old('name')}}"required>
      </div>
      <div class="input-group">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" value="{{old('email')}}" required>
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