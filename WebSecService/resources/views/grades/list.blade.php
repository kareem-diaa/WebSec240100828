@extends('layouts.master')
@section('title', 'Grades')
@section('content')

<div class="card m-4 shadow-sm">
    <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
        <h4 class="mb-0">📚 Grades Transcript</h4>
        <a href="{{ route('grades_edit') }}" class="btn btn-success btn-sm">
            ➕ Add New Grade
        </a>
    </div>

    <div class="card-body">

        {{-- Search / Filter --}}
        <form method="GET" action="{{ route('grades_list') }}" class="mb-4">
            <div class="row g-2">
                <div class="col-sm-5">
                    <input type="text"
                           name="keywords"
                           class="form-control"
                           placeholder="🔍 Search by student name or course..."
                           value="{{ request()->keywords }}">
                </div>
                <div class="col-sm-3">
                    <select name="term" class="form-select">
                        <option value="">All Terms</option>
                        @foreach($terms as $t)
                            <option value="{{ $t }}"
                                {{ request()->term == $t ? 'selected' : '' }}>
                                {{ $t }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-2">
                    <button type="submit" class="btn btn-primary w-100">Filter</button>
                </div>
                <div class="col-sm-2">
                    <a href="{{ route('grades_list') }}" class="btn btn-secondary w-100">Reset</a>
                </div>
            </div>
        </form>

        {{-- Grades grouped by term --}}
        @if($grouped->isEmpty())
            <div class="alert alert-warning text-center">No grades found.</div>
        @else

            @foreach($grouped as $term => $termGrades)
            <h5 class="mt-4 text-primary border-bottom pb-1">
                📅 {{ $term }}
                <small class="text-muted fs-6">
                    — GPA: {{ $termStats[$term]['gpa'] }}
                    | CH: {{ $termStats[$term]['ch'] }}
                </small>
            </h5>

            <table class="table table-bordered table-hover table-striped text-center mb-2">
                <thead class="table-dark">
                    <tr>
                        <th>Course Code</th>
                        <th>Course Title</th>
                        <th>Credit Hours</th>
                        <th>Grade</th>
                        <th>Grade Points</th>
                        <th>Weighted</th>
                        <th>Student</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($termGrades as $grade)
                    @php
                        $pts = $grade->getPoints();
                        $weighted = $pts * $grade->credit_hours;
                        $badgeColor = $pts >= 3.5 ? 'success' :
                                     ($pts >= 2.5 ? 'warning'  :
                                     ($pts >= 1.0 ? 'secondary': 'danger'));
                    @endphp
                    <tr>
                        <td>{{ $grade->course_code }}</td>
                        <td class="text-start">{{ $grade->course_title }}</td>
                        <td>{{ $grade->credit_hours }}</td>
                        <td>
                            <span class="badge bg-{{ $badgeColor }}">
                                {{ $grade->grade }}
                            </span>
                        </td>
                        <td>{{ number_format($pts, 1) }}</td>
                        <td>{{ number_format($weighted, 2) }}</td>
                        <td>{{ $grade->student_name }}</td>
                        <td>
                            <a href="{{ route('grades_edit', $grade->id) }}"
                               class="btn btn-sm btn-warning">✏️</a>
                            <a href="{{ route('grades_delete', $grade->id) }}"
                               class="btn btn-sm btn-danger"
                               onclick="return confirm('Delete this grade record?')">🗑️</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr class="table-info fw-bold">
                        <td colspan="2" class="text-end">Term Total:</td>
                        <td>{{ $termStats[$term]['ch'] }} CH</td>
                        <td colspan="3">
                            GPA: {{ $termStats[$term]['gpa'] }}
                        </td>
                        <td colspan="2"></td>
                    </tr>
                </tfoot>
            </table>
            @endforeach

            {{-- Cumulative Summary --}}
            <div class="alert mt-4 fw-bold fs-5 text-center
                {{ $cgpa >= 3.5 ? 'alert-success' :
                  ($cgpa >= 2.5 ? 'alert-warning' : 'alert-danger') }}">
                📊 Cumulative Credit Hours (CCH): {{ $totalCH }}
                &nbsp;|&nbsp;
                Cumulative GPA (CGPA):
                {{ $cgpa }}
                &nbsp;|&nbsp;
                Standing:
                @if($cgpa >= 3.5) 🌟 Excellent
                @elseif($cgpa >= 3.0) 👍 Very Good
                @elseif($cgpa >= 2.5) ✅ Good
                @elseif($cgpa >= 2.0) ⚠️ Pass
                @else ❌ Fail
                @endif
            </div>

        @endif
    </div>
</div>

@endsection