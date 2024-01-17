@extends('layout')
@section('title', 'Edit Page')
@section('content')

<link rel="stylesheet" href="{{ asset('assets/add.student.css') }}">

<div class="container">
    <form action="/teacher/{{$teacher->id}}" method="POST" id="signupForm" class="signup-form">
      @method('PUT')
    @csrf
      <h2>Add New teacher</h2>
      <div class="input-group">
        <label for="name">Name</label>
        <input type="text" name="name" id="name" value="{{$teacher->name}}}" autocomplete="off" required>
        @error('name')
        <p class ='text-red-500 text-xs p-1'>
            {{$message}}
        </p>
        @enderror
      </div>
      <div class="input-group">
        <label for="age">Age</label>
        <input type="number" name="age" id="email" value="{{$teacher->age}}" autocomplete="off" required>
        @error('age')
        <p class ='text-red-500 text-xs p-1'>
            {{$message}}
        </p>
        @enderror
    </div>
      <div class="input-group">
        <label for="adress">Adress</label>
        <input type="text" name="adress" id="password" value="{{$teacher->adress}}" autocomplete="off" required>
        @error('adress')
        <p class ='text-red-500 text-xs p-1'>
            {{$message}}
        </p>
        @enderror
    </div>
      <div class="input-group">
        <label for="department">Department</label>
        <input type="text" name="department" id="confirmPassword" value="{{$teacher->department}}" autocomplete="off" required>
        @error('department')
        <p class ='text-red-500 text-xs p-1'>
            {{$message}}
        </p>
        @enderror
    </div>
      <button type="submit">Update</button>
    </form>
    <form action="/teacher/{{$teacher->id}}" method="POST">
    @method('delete')
    @csrf
    <button type="submit" class="delete-button">Delete</button>
    </form>
  </div>


@endsection()