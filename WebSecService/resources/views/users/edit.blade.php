@extends('layouts.master')
@section('title', $user->id ? 'Edit User' : 'Add User')
@section('content')

<div class="card m-4 shadow-sm" style="max-width: 600px; margin: auto!important;">
    <div class="card-header bg-primary text-white">
        <h4 class="mb-0">
            {{ $user->id ? '✏️ Edit User: ' . $user->name : '➕ Add New User' }}
        </h4>
    </div>

    <div class="card-body">
        <form action="{{ route('users_save', $user->id ?: '') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label fw-bold">Full Name</label>
                <input type="text"
                       name="name"
                       class="form-control"
                       placeholder="Enter full name"
                       value="{{ $user->name }}"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Username</label>
                <input type="text"
                       name="username"
                       class="form-control"
                       placeholder="Enter username"
                       value="{{ $user->username }}"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Email</label>
                <input type="email"
                       name="email"
                       class="form-control"
                       placeholder="Enter email"
                       value="{{ $user->email }}"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">
                    Password
                    @if($user->id)
                        <small class="text-muted fw-normal">(leave blank to keep current password)</small>
                    @endif
                </label>
                <input type="password"
                       name="password"
                       class="form-control"
                       placeholder="Enter password"
                       {{ $user->id ? '' : 'required' }}>
            </div>

            <div class="d-flex gap-2 mt-4">
                <button type="submit" class="btn btn-success">
                    💾 {{ $user->id ? 'Update User' : 'Create User' }}
                </button>
                <a href="{{ route('users_list') }}" class="btn btn-secondary">
                    ← Cancel
                </a>
            </div>

        </form>
    </div>
</div>

@endsection