@extends('layouts.master')
@section('title', 'Users')
@section('content')

<div class="card m-4 shadow-sm">
    <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
        <h4 class="mb-0">👥 Users List</h4>
        <a href="{{ route('users_edit') }}" class="btn btn-success btn-sm">
            ➕ Add New User
        </a>
    </div>

    <div class="card-body">

        {{-- Search Filter --}}
        <form method="GET" action="{{ route('users_list') }}" class="mb-4">
            <div class="row g-2">
                <div class="col-sm-8">
                    <input type="text"
                           name="keywords"
                           class="form-control"
                           placeholder="🔍 Search by name, username or email..."
                           value="{{ request()->keywords }}">
                </div>
                <div class="col-sm-2">
                    <button type="submit" class="btn btn-primary w-100">Search</button>
                </div>
                <div class="col-sm-2">
                    <a href="{{ route('users_list') }}" class="btn btn-secondary w-100">Reset</a>
                </div>
            </div>
        </form>

        {{-- Users Table --}}
        @if($users->isEmpty())
            <div class="alert alert-warning text-center">No users found.</div>
        @else
        <table class="table table-bordered table-hover table-striped text-center">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->created_at->format('Y-m-d') }}</td>
                    <td>
                        <a href="{{ route('users_edit', $user->id) }}"
                           class="btn btn-sm btn-warning">✏️ Edit</a>

                        <a href="{{ route('users_delete', $user->id) }}"
                           class="btn btn-sm btn-danger"
                           onclick="return confirm('Are you sure you want to delete {{ $user->name }}?')">
                           🗑️ Delete
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif

    </div>
</div>

@endsection