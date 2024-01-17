@extends('layout')
@section('title', 'Teachers Table')
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
      <th scope="col">Department</th>
      <th scope="col"></th>

    </tr>
  </thead>
  <tbody>
    @foreach ($teachers as $teacher)
    <tr class="table-dark">
      <td class="py-2 px-6">
        {{$teacher->name}}
      </td>
      <td class="py-2 px-6">
      {{$teacher->age}}
      </td>
      <td class="py-2 px-6">
      {{$teacher->adress}}
      </td>
      <td class="py-2 px-6">
      {{$teacher->department}}
      </td>
      <td class="py-2 px-6">
         <a href="{{ route('show.teacher', ['id' => $teacher->id]) }}" class="view">View</a>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
</div>
@endsection

