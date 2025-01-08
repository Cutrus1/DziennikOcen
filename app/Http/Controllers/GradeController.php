<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\User;
use App\Models\Subject;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    // Widok ocen dla ucznia, nauczyciela lub administratora
    public function index()
    {
        if (auth()->user()->role === 'teacher') {
            $grades = Grade::where('teacher_id', auth()->id())->get();
        } elseif (auth()->user()->role === 'student') {
            $grades = Grade::where('student_id', auth()->id())->get();
        } elseif (auth()->user()->role === 'admin') {
            $grades = Grade::all();
        } else {
            abort(403, 'Nieautoryzowany dostęp.');
        }

        return view('grades.index', compact('grades'));
    }

    // Formularz dodawania oceny (dla nauczyciela)
    public function create()
    {
        $students = User::where('role', 'student')->get();
        $subjects = Subject::all();
        return view('grades.create', compact('students', 'subjects'));
    }

    // Zapisanie nowej oceny
    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:users,id',
            'subject' => 'required|string',
            'grade' => 'required|string|in:1,2,3,4,5,6',
        ]);

        Grade::create([
            'student_id' => $request->student_id,
            'teacher_id' => auth()->id(),
            'subject' => $request->subject,
            'grade' => $request->grade,
        ]);

        return redirect()->route('grades.create')->with('success', 'Ocena została pomyślnie dodana.');
    }

    // Formularz edycji oceny
    public function edit(Grade $grade)
    {
        return view('grades.edit', compact('grade'));
    }

    // Aktualizacja oceny
    public function update(Request $request, Grade $grade)
    {
        $request->validate([
            'subject' => 'required|string',
            'grade' => 'required|string|in:1,2,3,4,5,6',
        ]);

        $grade->update([
            'subject' => $request->subject,
            'grade' => $request->grade,
        ]);

        return redirect()->route('grades.index')->with('success', 'Ocena została zaktualizowana.');
    }

    // Usunięcie oceny
    public function destroy(Grade $grade)
    {
        $grade->delete();
        return redirect()->route('grades.index')->with('success', 'Ocena została usunięta.');
    }

    // Widok dla ucznia
    public function studentView()
    {
        $studentId = auth()->id();
        $grades = Grade::where('student_id', $studentId)->get();
        $subjects = Subject::all();

        $subjectGrades = [];
        foreach ($subjects as $subject) {
            $subjectGrades[$subject->name] = $grades->where('subject', $subject->name);
        }

        $overallAverage = $grades->avg('grade');

        return view('grades.student_view', compact('subjectGrades', 'overallAverage'));
    }

    // Widok dla nauczyciela/administratora
    public function teacherAdminView()
    {
        $grades = Grade::all();
        $students = User::where('role', 'student')->get();
        $subjects = Subject::all();

        return view('grades.teacher_admin_view', compact('grades', 'students', 'subjects'));
    }
}
