<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Grade;

class GradesController extends Controller
{
    // ─── LIST: grouped by term, with GPA per term + CGPA ─────────────────
    public function list(Request $request)
    {
        $query = Grade::select('grades.*');

        // Filter by student name
        $query->when($request->keywords,
            fn($q) => $q->where('student_name', 'like', "%$request->keywords%")
                        ->orWhere('course_title', 'like', "%$request->keywords%")
        );

        // Filter by term
        $query->when($request->term,
            fn($q) => $q->where('term', $request->term)
        );

        $grades = $query->orderBy('term')->orderBy('course_code')->get();

        // Get all unique terms for filter dropdown
        $terms = Grade::select('term')->distinct()->orderBy('term')->pluck('term');

        // Group grades by term
        $grouped = $grades->groupBy('term');

        // Calculate GPA per term and cumulative
        $totalCH     = 0;
        $totalPoints = 0;

        $termStats = [];
        foreach ($grouped as $term => $termGrades) {
            $ch     = $termGrades->sum('credit_hours');
            $points = $termGrades->sum(fn($g) => $g->getPoints() * $g->credit_hours);
            $gpa    = $ch > 0 ? round($points / $ch, 2) : 0;

            $termStats[$term] = [
                'ch'     => $ch,
                'points' => $points,
                'gpa'    => $gpa,
            ];

            $totalCH     += $ch;
            $totalPoints += $points;
        }

        $cgpa = $totalCH > 0 ? round($totalPoints / $totalCH, 2) : 0;

        return view('grades.list', compact(
            'grouped', 'terms', 'termStats',
            'totalCH', 'cgpa'
        ));
    }

    // ─── SHOW ADD / EDIT FORM ─────────────────────────────────────────────
    public function edit(Request $request, Grade $grade = null)
    {
        $grade      = $grade ?? new Grade();
        $gradeOptions = Grade::gradePoints();
        return view('grades.edit', compact('grade', 'gradeOptions'));
    }

    // ─── SAVE (create or update) ──────────────────────────────────────────
    public function save(Request $request, Grade $grade = null)
    {
        $grade = $grade ?? new Grade();
        $grade->fill($request->all());
        $grade->save();

        return redirect()->route('grades_list');
    }

    // ─── DELETE ───────────────────────────────────────────────────────────
    public function delete(Request $request, Grade $grade)
    {
        $grade->delete();
        return redirect()->route('grades_list');
    }
}