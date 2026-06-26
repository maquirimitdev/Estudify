<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class SuperCreateUserController extends Controller
{
    protected function validRoles(): array
    {
        return [
            User::SUPERADMIN,
            User::ADMIN,
            User::TEACHER,
            User::STUDENT,
            User::PARENT,
        ];
    }

    protected function roleLabel(string $role): string
    {
        return match ($role) {
            User::SUPERADMIN => 'Superadmin',
            User::ADMIN => 'Administrator',
            User::TEACHER => 'Teacher',
            User::STUDENT => 'Student',
            User::PARENT => 'Parent',
            default => 'User',
        };
    }

    protected function generateUniqueUsername(string $name): string
    {
        // Split name into parts
        $nameParts = explode(' ', trim($name));
        
        // Create base username with dot separator
        $baseUsername = strtolower(implode('.', $nameParts));
        $baseUsername = preg_replace('/[^a-z0-9.]/', '', $baseUsername);

        $username = $baseUsername;
        $counter = 1;

        // Check if username already exists, append number if it does
        while (User::where('username', $username)->exists()) {
            $username = $baseUsername . $counter;
            $counter++;
        }

        return $username;
    }

    public function createUser(string $role)
    {
        abort_if(!in_array($role, $this->validRoles()), 404);

        return view('superadmin.create_user', [
            'role' => $role,
            'roleLabel' => $this->roleLabel($role),
        ]);
    }

    public function storeUser(Request $request, string $role)
    {
        abort_if(!in_array($role, $this->validRoles()), 404);

        $request->validate([
            'name' => 'required|string|min:3|max:50',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|confirmed|min:8',
        ]);

        $username = $this->generateUniqueUsername($request->input('name'));

        User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'username' => $username,
            'password' => bcrypt($request->input('password')),
            'user_type' => $role,
            'is_active' => true,
        ]);

        return redirect()->route('superadmin.role_table', ['role' => $role])
            ->with('success', $this->roleLabel($role) . ' account created successfully (username: ' . $username . ').');
    }

    public function editUser(User $user)
    {
        abort_if(!in_array($user->user_type, $this->validRoles()), 404);

        return view('superadmin.edit_user', [
            'user' => $user,
            'role' => $user->user_type,
            'roleLabel' => $this->roleLabel($user->user_type),
        ]);
    }

    public function updateUser(Request $request, User $user)
    {
        abort_if(!in_array($user->user_type, $this->validRoles()), 404);

        $request->validate([
            'name' => 'required|string|min:3|max:50',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'username' => 'required|string|min:4|max:255|unique:users,username,' . $user->id,
            'password' => 'nullable|string|confirmed|min:8',
            'is_active' => 'nullable|boolean',
        ]);

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->username = $request->input('username');
        if ($request->filled('password')) {
            $user->password = bcrypt($request->input('password'));
        }
        $user->is_active = $request->boolean('is_active');
        $user->save();

        return redirect()->route('superadmin.role_table', ['role' => $user->user_type])
            ->with('success', $this->roleLabel($user->user_type) . ' account updated successfully.');
    }

    public function deleteUser(User $user)
    {
        abort_if(!in_array($user->user_type, $this->validRoles()), 404);

        $role = $user->user_type;
        $user->delete();

        return redirect()->route('superadmin.role_table', ['role' => $role])
            ->with('success', $this->roleLabel($role) . ' account deleted successfully.');
    }

    public function roleTable($role)
    {
        $validRoles = $this->validRoles();

        abort_if(!in_array($role, $validRoles), 404);

        $users = User::where('user_type', $role)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('superadmin.role_table', [
            'users' => $users,
            'role' => $role,
            'roleLabel' => $this->roleLabel($role),
            'totalUsers' => $users->count(),
            'activeUsers' => $users->where('is_active', true)->count(),
            'inactiveUsers' => $users->where('is_active', false)->count(),
        ]);
    }
}
