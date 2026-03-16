@extends('layouts.master')
@section('title', 'Student Transcript')
@section('content')

<div class="card m-4">
    <div class="card-header bg-primary text-white">
        <h4 class="mb-0">🎓 Student Transcript</h4>
    </div>
    <div class="card-body">

        {{-- Student Info --}}
        <div class="mb-4 p-3 bg-light rounded">
            <strong>Student Name:</strong> {{ $student->name }} &nbsp;|&nbsp;
            <strong>Student ID:</strong> {{ $student->id }}
        </div>

        @php $totalCredits = 0; $totalPoints = 0; @endphp

        @foreach($terms as $term)
            @php $termCredits = 0; $termPoints = 0; @endphp

            <h5 class="mt-4 text-primary">📅 {{ $term->name }}</h5>
            <table class="table table-bordered table-hover text-center">
                <thead class="table-dark">
                    <tr>
                        <th>Code</th><th>Course Title</th>
                        <th>Credit Hours</th><th>Grade</th><th>Points</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($term->courses as $course)
                        @php
                            $points = $gradePoints[$course->grade] ?? 0;
                            $termCredits += $course->credits;
                            $termPoints  += $points * $course->credits;
                        @endphp
                        <tr>
                            <td>{{ $course->code }}</td>
                            <td class="text-start">{{ $course->title }}</td>
                            <td>{{ $course->credits }}</td>
                            <td><span class="badge bg-success">{{ $course->grade }}</span></td>
                            <td>{{ number_format($points, 1) }}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr class="table-info fw-bold">
                        <td colspan="2" class="text-end">Term Summary:</td>
                        <td>{{ $termCredits }} CH</td>
                        <td colspan="2">
                            GPA: {{ $termCredits > 0 ? number_format($termPoints/$termCredits,2) : '0.00' }}
                        </td>
                    </tr>
                </tfoot>
            </table>

            @php $totalCredits += $termCredits; $totalPoints += $termPoints; @endphp
        @endforeach

        {{-- Cumulative --}}
        <div class="alert alert-success mt-4 fw-bold fs-5 text-center">
            📊 Cumulative Credit Hours: {{ $totalCredits }} &nbsp;|&nbsp;
            CGPA: {{ $totalCredits > 0 ? number_format($totalPoints/$totalCredits,2) : '0.00' }}
        </div>
    </div>
</div>

@endsection