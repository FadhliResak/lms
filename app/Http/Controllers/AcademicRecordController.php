<?php

namespace App\Http\Controllers;

use App\Models\AcademicRecord;
use Illuminate\Http\Request;

class AcademicRecordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $records = AcademicRecord::with(['student', 'course'])->orderBy('id', 'desc')->paginate(10);

        return view('records.index', compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $students = \App\Models\Student::orderBy('name')->get();
        $courses = \App\Models\Course::orderBy('name')->get();

        return view('records.create', compact('students', 'courses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'student_id' => ['required', 'exists:students,id'],
            'course_id' => ['required', 'exists:courses,id'],
            'semester' => ['required', 'string', 'max:20'],
            'score' => ['required', 'integer'],
            'attendance' => ['nullable', 'string', 'max:50'],
        ]);
        AcademicRecord::create($data);

        return redirect()->route('records.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(AcademicRecord $academicRecord)
    {
        return view('records.show', ['record' => $academicRecord]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AcademicRecord $academicRecord)
    {
        $students = \App\Models\Student::orderBy('name')->get();
        $courses = \App\Models\Course::orderBy('name')->get();

        return view('records.edit', ['record' => $academicRecord, 'students' => $students, 'courses' => $courses]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AcademicRecord $academicRecord)
    {
        $data = $request->validate([
            'student_id' => ['required', 'exists:students,id'],
            'course_id' => ['required', 'exists:courses,id'],
            'semester' => ['required', 'string', 'max:20'],
            'score' => ['required', 'integer'],
            'attendance' => ['nullable', 'string', 'max:50'],
        ]);
        $academicRecord->update($data);

        return redirect()->route('records.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AcademicRecord $academicRecord)
    {
        $academicRecord->delete();

        return redirect()->route('records.index');
    }
}
