@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Welcome Admin</h1>
        <h1>All Users</h1>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <!-- Filter users by Assigned/Non-Assigned -->
        <form method="GET" action="{{ route('auth.user') }}" class="mb-3">
            <div class="form-group">
                <label for="role_filter">Filter Users</label>
                <select name="role" id="role_filter" class="form-control" onchange="this.form.submit()">
                    <option value="">All Users</option>
                    <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Assigned (Admin)</option>
                    <option value="user" {{ request('role') == 'user' ? 'selected' : '' }}>Non-Assigned (User)</option>
                </select>
            </div>
        </form>

        <a href="{{ route('users.create') }}" class="btn btn-primary mb-3">Add User</a>

        <!-- Button to the Blog Page -->
        <a href="{{ route('posts.index') }}" class="btn btn-secondary mb-3">Go to Blog</a>

        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Assigned Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->role }}</td>
                        <td>
                            <!-- Display Assigned or Non-Assigned Status based on Role -->
                            @if($user->role == 'admin')
                                <span class="badge badge-success">Assigned (Admin)</span>
                            @else
                                <span class="badge badge-secondary">Non-Assigned (User)</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this user?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
