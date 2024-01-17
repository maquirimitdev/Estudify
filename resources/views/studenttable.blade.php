@extends('layout')
@section('title', 'Student Table')
@section('content')

<link rel="stylesheet" href="{{ asset('assets/students.table.css') }}">
<br>

<div class="table-container">
<table class="table table-dark table-striped">
  <thead>
    <tr>
      <th scope="col">Name</th>
      <th scope="col">Age</th>
      <th scope="col">Adress</th>
      <th scope="col">Course</th>
      <th scope="col">Subject</th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
    @foreach ($students as $student)
    <tr class="table-dark">
      <td class="py-2 px-6">
        {{$student->name}}
      </td>
      <td class="py-2 px-6">
      {{$student->age}}
      </td>
      <td class="py-2 px-6">
      {{$student->adress}}
      </td>
      <td class="py-2 px-6">
      {{$student->course}}
      </td>
      <td class="py-2 px-6">
      {{$student->subject}}
      </td>
      <td class="py-2 px-6">
      <a href="{{ route('show.student', ['id' => $student->id]) }}" class="view">View</a>
         <td class="py-2 px-6">
      </td>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
</div>
@endsection

