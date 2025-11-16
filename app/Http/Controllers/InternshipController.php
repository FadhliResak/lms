<?php

namespace App\Http\Controllers;

use App\Models\Internship;
use Illuminate\Http\Request;

class InternshipController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $internships = Internship::with('student')->orderBy('start_date', 'desc')->paginate(10);

        return view('internships.index', compact('internships'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $students = \App\Models\Student::orderBy('name')->get();

        return view('internships.create', compact('students'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'student_id' => ['required', 'exists:students,id'],
            'company' => ['required', 'string', 'max:255'],
            'supervisor' => ['nullable', 'string', 'max:255'],
            'start_date' => ['required', 'date'],
            'end_date' => ['nullable', 'date'],
            'status' => ['required', 'string', 'max:50'],
            'score' => ['nullable', 'integer'],
        ]);
        Internship::create($data);

        return redirect()->route('internships.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Internship $internship)
    {
        return view('internships.show', compact('internship'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Internship $internship)
    {
        $students = \App\Models\Student::orderBy('name')->get();

        return view('internships.edit', compact('internship', 'students'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Internship $internship)
    {
        $data = $request->validate([
            'student_id' => ['required', 'exists:students,id'],
            'company' => ['required', 'string', 'max:255'],
            'supervisor' => ['nullable', 'string', 'max:255'],
            'start_date' => ['required', 'date'],
            'end_date' => ['nullable', 'date'],
            'status' => ['required', 'string', 'max:50'],
            'score' => ['nullable', 'integer'],
        ]);
        $internship->update($data);

        return redirect()->route('internships.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Internship $internship)
    {
        $internship->delete();

        return redirect()->route('internships.index');
    }
}
