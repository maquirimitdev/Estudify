@extends('layout')
@section('title', 'Teachers Table')
@section('content')

<div class="table-controls">
    <div class="table-search">
        <input type="text" placeholder="Search teachers...">
    </div>
    <a href="#" class="btn-add">+ Add Teacher</a>
</div>

<div class="table-container">
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>Name</th>
                <th>Age</th>
                <th>Address</th>
                <th>Department</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($teachers as $teacher)
            <tr>
                <td>{{ $teacher->name }}</td>
                <td>{{ $teacher->age }}</td>
                <td>{{ $teacher->adress }}</td>
                <td><span class="badge badge-info">{{ $teacher->department }}</span></td>
                <td>
                    <div class="table-actions">
                        <a href="#" class="btn-view">View</a>
                        <a href="#" class="btn-edit">Edit</a>
                        <button class="btn-delete">Delete</button>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
