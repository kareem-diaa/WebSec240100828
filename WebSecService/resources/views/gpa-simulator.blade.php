@extends('layouts.master')
@section('title', 'GPA Simulator')
@section('content')

<div class="card m-4 shadow">
    <div class="card-header bg-warning text-dark">
        <h4 class="mb-0">📊 GPA Simulator</h4>
    </div>
    <div class="card-body">

        <table class="table table-bordered text-center" id="gpa-table">
            <thead class="table-dark">
                <tr>
                    <th>Code</th>
                    <th>Course Title</th>
                    <th>Credit Hours</th>
                    <th>Grade</th>
                    <th>Grade Points</th>
                    <th>Weighted Points</th>
                </tr>
            </thead>
            <tbody>
                @foreach($courses as $index => $course)
                <tr>
                    <td>{{ $course->code }}</td>
                    <td class="text-start">{{ $course->title }}</td>
                    <td class="credits" data-credits="{{ $course->credits }}">
                        {{ $course->credits }}
                    </td>
                    <td>
                        <select class="form-select form-select-sm grade-select"
                                onchange="calculateGPA()">
                            <option value="">-- Select --</option>
                            <option value="4.0">A</option>
                            <option value="3.7">A-</option>
                            <option value="3.3">B+</option>
                            <option value="3.0">B</option>
                            <option value="2.7">B-</option>
                            <option value="2.3">C+</option>
                            <option value="2.0">C</option>
                            <option value="1.7">C-</option>
                            <option value="1.0">D</option>
                            <option value="0.0">F</option>
                        </select>
                    </td>
                    <td class="grade-points">—</td>
                    <td class="weighted-points">—</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="alert alert-info mt-3 text-center fs-5" id="gpa-result">
            🎯 Select grades to calculate your GPA
        </div>

    </div>
</div>

<script>
    function calculateGPA() {
        const rows = document.querySelectorAll('#gpa-table tbody tr');
        let totalCredits = 0;
        let totalWeighted = 0;
        let allSelected = true;

        rows.forEach(row => {
            const credits  = parseFloat(row.querySelector('.credits').dataset.credits);
            const select   = row.querySelector('.grade-select');
            const gpCell   = row.querySelector('.grade-points');
            const wpCell   = row.querySelector('.weighted-points');
            const gp       = parseFloat(select.value);

            if (!select.value) {
                gpCell.textContent = '—';
                wpCell.textContent = '—';
                allSelected = false;
                return;
            }

            const weighted = gp * credits;
            gpCell.textContent  = gp.toFixed(1);
            wpCell.textContent  = weighted.toFixed(2);
            totalCredits  += credits;
            totalWeighted += weighted;
        });

        const resultBox = document.getElementById('gpa-result');
        if (totalCredits === 0) {
            resultBox.className = 'alert alert-info mt-3 text-center fs-5';
            resultBox.textContent = '🎯 Select grades to calculate your GPA';
            return;
        }

        const gpa = totalWeighted / totalCredits;
        let badgeClass = gpa >= 3.5 ? 'alert-success' :
                         gpa >= 2.5 ? 'alert-warning' : 'alert-danger';

        let standing = gpa >= 3.5 ? "Excellent 🌟" :
                       gpa >= 3.0 ? "Very Good 👍" :
                       gpa >= 2.5 ? "Good ✅"      :
                       gpa >= 2.0 ? "Pass ⚠️"      : "Fail ❌";

        resultBox.className = `alert ${badgeClass} mt-3 text-center fs-5 fw-bold`;
        resultBox.innerHTML =
            `Total Credits: ${totalCredits} CH &nbsp;|&nbsp;
             GPA: ${gpa.toFixed(2)} &nbsp;|&nbsp;
             Standing: ${standing}`;
    }
</script>

@endsection