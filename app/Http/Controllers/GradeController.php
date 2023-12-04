<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\HtmlString;
use Yajra\DataTables\DataTables;
use function Termwind\render;

class GradeController extends Controller
{
    public function create(Request $request)
    {
        $request->validate([
            'score' => 'required|numeric',
            'student_id' => 'required|exists:users,id',
            'subject_id' => 'required|exists:subjects,id',
        ]);

        $grade = new Grade();

        $grade->score = $request->input('score');
        $grade->date = Carbon::now();
        $grade->user_id = $request->input('student_id');
        $grade->subject_id = $request->input('subject_id');

        $grade->save();

        $subjectId = $request->input('subject_id');
        $studentId = $request->input('student_id');

        $gradesWithActions = $this->getGradesWithActions($subjectId, $studentId);

        return response()->json($gradesWithActions);
    }

    public function showTeacherGrades(string $studentId)
    {
        $student = User::findOrFail($studentId);

        $subjects = Subject::all();

        return view('grades.show', compact('student', 'subjects'));
    }

    public function showStudentGrades(string $id)
    {
        $subject = Subject::findOrFail($id);
        $user = Auth::user();
        $grades = Grade::where('subject_id', $subject->id)
            ->where('user_id', $user->id)
            ->get();
        $average = $grades->avg('score');

        return view('grades.show', compact('subject', 'grades', 'user', 'average'));
    }

    public function getGrades(Request $request)
    {
        $subjectId = $request->input('subject_id');
        $subjectName = $request->input('subject_name');
        $studentId = $request->input('student_id');

        $grades = Grade::where('subject_id', $subjectId)
            ->where('user_id', $studentId)
            ->get();

        $gradesWithActions = $grades->map(function ($grade) use ($subjectName, $subjectId, $studentId) {
            return [
                'date' => $grade->date,
                'score' => $grade->score,
                'actions' => view::make('grades.partials.dt-actions', compact('grade'))->render(),
                'subject_name' => $subjectName
            ];
        });

        return response()->json($gradesWithActions);
    }


    public function update(Request $request, string $id)
    {
        $request->validate([
            'score' => 'required|numeric',
        ]);

        $grade = Grade::findOrFail($id);

        $grade->score = $request->input('score');
        $grade->save();

        $subjectId = $grade->subject_id;
        $studentId = $grade->user_id;

        $gradesWithActions = $this->getGradesWithActions($subjectId, $studentId);

        return response()->json($gradesWithActions);
    }

    public function destroy(string $id)
    {
        $grade = Grade::findOrFail($id);

        $subjectId = $grade->subject_id;
        $studentId = $grade->user_id;

        $grade->delete();

        $gradesWithActions = $this->getGradesWithActions($subjectId, $studentId);

        return response()->json($gradesWithActions);
    }

    private function getGradesWithActions($subjectId, $studentId)
    {
        $subjectName = Subject::findOrFail($subjectId)->name;

        $grades = Grade::where('subject_id', $subjectId)
            ->where('user_id', $studentId)
            ->get();

        $gradesWithActions = $grades->map(function ($grade) use ($subjectName, $subjectId, $studentId) {
            return [
                'date' => $grade->date,
                'score' => $grade->score,
                'actions' => view::make('grades.partials.dt-actions', compact('grade'))->render(),
                'subject_name' => $subjectName
            ];
        });

        return $gradesWithActions;
    }
}
