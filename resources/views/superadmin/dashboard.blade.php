@extends('layouts.dashboard')
@section('title', 'Superadmin Dashboard')

@section('content')
<div class="dashboard-header">
    <h1>📊 System Overview</h1>
</div>

<div class="row">
    <!-- Total Users Card -->
    <div class="col-md-3">
        <div class="card stat-card">
            <div class="card-body">
                <h6 class="card-title">Total Users</h6>
                <h3 class="stat-number">{{ $total_users }}</h3>
            </div>
        </div>
    </div>
    
    <!-- Teachers Card -->
    <div class="col-md-3">
        <div class="card stat-card">
            <div class="card-body">
                <h6 class="card-title">Teachers</h6>
                <h3 class="stat-number">{{ $total_teachers }}</h3>
            </div>
        </div>
    </div>
    
    <!-- Students Card -->
    <div class="col-md-3">
        <div class="card stat-card">
            <div class="card-body">
                <h6 class="card-title">Students</h6>
                <h3 class="stat-number">{{ $total_students }}</h3>
            </div>
        </div>
    </div>
    
    <!-- Admins Card -->
    <div class="col-md-3">
        <div class="card stat-card">
            <div class="card-body">
                <h6 class="card-title">Admins</h6>
                <h3 class="stat-number">{{ $total_admins }}</h3>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <!-- Recent Users -->
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5>Recent Users</h5>
            </div>
            <div class="card-body">
                <table class="table">
                    <tbody>
                        @foreach($recent_users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td><span class="badge">{{ $user->getRoleName() }}</span></td>
                            <td>{{ $user->created_at->diffForHumans() }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection