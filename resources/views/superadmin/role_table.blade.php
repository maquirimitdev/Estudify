@extends('layouts.dashboard')

@section('title', 'User Table')

@section('content')
<div class="dashboard-header d-flex flex-column flex-md-row justify-content-between align-items-start gap-3 mb-4">
    <div>
        <h1 class="mb-1">{{ $users->isEmpty() ? 'No users yet' : $roleLabel . 's' }}</h1>
        <p class="text-muted mb-0">Showing all {{ strtolower($roleLabel) }} accounts.</p>
    </div>
    <div class="d-flex flex-column flex-sm-row gap-2">
        <a href="{{ route('superadmin.create_user', ['role' => $role]) }}" class="btn btn-primary">Create {{ $roleLabel }}</a>
        <div class="btn-group">
            <a href="#" class="btn btn-outline-secondary">Filter</a>
            <button type="button" class="btn btn-outline-secondary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
                <span class="visually-hidden">Toggle Dropdown</span>
            </button>
            <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="{{ route('superadmin.role_table', ['role' => 'SUP']) }}">Superadmins</a></li>
                <li><a class="dropdown-item" href="{{ route('superadmin.role_table', ['role' => 'ADM']) }}">Admins</a></li>
                <li><a class="dropdown-item" href="{{ route('superadmin.role_table', ['role' => 'TCH']) }}">Teachers</a></li>
                <li><a class="dropdown-item" href="{{ route('superadmin.role_table', ['role' => 'STU']) }}">Students</a></li>
                <li><a class="dropdown-item" href="{{ route('superadmin.role_table', ['role' => 'PAR']) }}">Parents</a></li>
            </ul>
        </div>
    </div>
</div>

<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="card border-primary shadow-sm h-100">
            <div class="card-body">
                <small class="text-uppercase text-muted">Total {{ strtolower($roleLabel) }}</small>
                <h3 class="mt-2">{{ $totalUsers ?? $users->count() }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-success shadow-sm h-100">
            <div class="card-body">
                <small class="text-uppercase text-muted">Active</small>
                <h3 class="mt-2">{{ $activeUsers ?? $users->where('is_active', true)->count() }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-secondary shadow-sm h-100">
            <div class="card-body">
                <small class="text-uppercase text-muted">Inactive</small>
                <h3 class="mt-2">{{ $inactiveUsers ?? $users->where('is_active', false)->count() }}</h3>
            </div>
        </div>
    </div>
</div>

<div class="card shadow-sm">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Created</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->getRoleName() }}</td>
                        <td>
                            <span class="badge bg-{{ $user->is_active ? 'success' : 'secondary' }}">
                                {{ $user->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td>{{ optional($user->created_at)->format('Y-m-d') }}</td>
                        <td>
                            <a href="{{ route('superadmin.edit_user', ['user' => $user->id]) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                            <form action="{{ route('superadmin.delete_user', ['user' => $user->id]) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')   
                                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure you want to delete this user?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center">No users found for this role.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection