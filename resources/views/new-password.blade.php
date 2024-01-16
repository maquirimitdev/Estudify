@extends('layout')
@section('title', 'Reset Password')
@section('content')

  <link rel="stylesheet" href="{{ asset('assets/resetpassword.css') }}">
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
    <form action="{{route('reset.password.post')}}" method="POST" id="resetPasswordForm" class="reset-password-form">
        @csrf
        <input type="text"name="token" hidden value="{{$token}}">
        <h2>Reset Password</h2>
      <div class="input-group">
        <label for="resetEmail">Email</label>
        <input type="email" name="email" id="resetEmail" required>
      </div>
      <div class="input-group">
        <label for="newPassword">New Password</label>
        <input type="password" name="password" id="newPassword" required>
      </div>
      <div class="input-group">
        <label for="confirmNewPassword">Confirm New Password</label>
        <input type="password" name="password_confirmation" id="confirmNewPassword" required>
      </div>
      <button type="submit">Reset Password</button>
    </form>
  </div>
  </main>

  @endsection
