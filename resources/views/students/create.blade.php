@extends('layout')
@section('title', 'Add New Student')
@section('content')

<link rel="stylesheet" href="{{ asset('assets/add.student.css') }}">

<div class="container">
    <form action="{{route('create.student.post')}}" method="POST" id="signupForm" class="signup-form">
      @csrf
      <h2 class="text">Add New Student</h2>
      <div class="input-group">
        <label for="name">Name</label>
        <input type="text" name="name" id="name" value="{{old('name')}}" autocomplete="off" required>
        @error('name')
        <p class ='text-red-500 text-xs p-1'>
            {{$message}}
        </p>
        @enderror
    </div>
      <div class="input-group">
        <label for="age">Age</label>
        <input type="number" name="age" id="email" value="{{old('age')}}" autocomplete="off" required>
        @error('age')
        <p class ='text-red-500 text-xs p-1'>
            {{$message}}
        </p>
        @enderror
    </div>
      <div class="input-group">
        <label for="adress">Adress</label>
        <input type="text" name="adress" id="password" value="{{old('adress')}}" autocomplete="off" required>
        @error('adress')
        <p class ='text-red-500 text-xs p-1'>
            {{$message}}
        </p>
        @enderror
    </div>
      <div class="input-group">
        <label for="course">Course</label>
        <input type="text" name="course" id="confirmPassword" value="{{old('course')}}" autocomplete="off" required>
        @error('course')
        <p class ='text-red-500 text-xs p-1'>
            {{$message}}
        </p>
        @enderror
    </div>
      <div class="input-group">
        <label for="subject">Subject</label>
        <input type="text" name="subject" id="confirmPassword" value="{{old('subject')}}" autocomplete="off" required>
        @error('subject')
        <p class ='text-red-500 text-xs p-1'>
            {{$message}}
        </p>
        @enderror
    </div>
      <button type="submit">Add New Student</button>
    </form>
  </div>


@endsection()