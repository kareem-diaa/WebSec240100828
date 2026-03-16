@extends('layouts.master')
@section('title', $grade->id ? 'Edit Grade' : 'Add Grade')
@section('content')

<div class="card m-4 shadow-sm" style="max-width:650px; margin:auto!important;">
    <div class="card-header bg-primary text-white">
        <h4 class="mb-0">
            {{ $grade->id ? '✏️ Edit Grade Record' : '➕ Add New Grade' }}
        </h4>
    </div>
    <div class="card-body">

        <form action="{{ route('grades_save', $grade->id ?: '') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label fw-bold">Student Name</label>
                <input type="text" name="student_name"
                       class="form-control"
                       placeholder="e.g. Ahmed Mohamed"
                       value="{{ $grade->student_name }}" required>
            </div>

            <div class="row mb-3">
                <div class="col">
                    <label class="form-label fw-bold">Course Code</label>
                    <input type="text" name="course_code"
                           class="form-control"
                           placeholder="e.g. CS101"
                           value="{{ $grade->course_code }}" required>
                </div>
                <div class="col">
                    <label class="form-label fw-bold">Credit Hours</label>
                    <input type="number" name="credit_hours"
                           class="form-control"
                           placeholder="e.g. 3"
                           min="1" max="6"
                           value="{{ $grade->credit_hours }}" required>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Course Title</label>
                <input type="text" name="course_title"
                       class="form-control"
                       placeholder="e.g. Introduction to Computer Science"
                       value="{{ $grade->course_title }}" required>
            </div>

            <div class="row mb-3">
                <div class="col">
                    <label class="form-label fw-bold">Term</label>
                    <input type="text" name="term"
                           class="form-control"
                           placeholder="e.g. Fall 2023"
                           value="{{ $grade->term }}" required>
                </div>
                <div class="col">
                    <label class="form-label fw-bold">Grade</label>
                    <select name="grade" class="form-select" required>
                        <option value="">-- Select Grade --</option>
                        @foreach($gradeOptions as $letter => $points)
                            <option value="{{ $letter }}"
                                {{ $grade->grade == $letter ? 'selected' : '' }}>
                                {{ $letter }} ({{ $points }})
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="d-flex gap-2 mt-4">
                <button type="submit" class="btn btn-success">
                    💾 {{ $grade->id ? 'Update Grade' : 'Save Grade' }}
                </button>
                <a href="{{ route('grades_list') }}" class="btn btn-secondary">
                    ← Cancel
                </a>
            </div>

        </form>
    </div>
</div>

@endsection