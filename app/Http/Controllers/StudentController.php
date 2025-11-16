<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $q = request('q');
        $program = request('program');
        $students = Student::query()
            ->when($q, function ($query) use ($q) {
                $query->where(function ($sub) use ($q) {
                    $sub->where('name', 'like', "%$q%")
                        ->orWhere('nisn', 'like', "%$q%")
                        ->orWhere('class', 'like', "%$q%")
                        ->orWhere('program', 'like', "%$q%");
                });
            })
            ->when($program, fn ($query) => $query->where('program', $program))
            ->orderBy('name')
            ->paginate(10)
            ->appends(['q' => $q, 'program' => $program]);
        $programs = Student::select('program')->distinct()->pluck('program');

        return view('students.index', compact('students', 'q', 'program', 'programs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('students.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nisn' => ['required', 'string', 'max:20', 'unique:students,nisn'],
            'name' => ['required', 'string', 'max:255'],
            'program' => ['required', 'string', 'max:255'],
            'class' => ['required', 'string', 'max:100'],
            'year_of_entry' => ['required', 'integer'],
            'parent_name' => ['nullable', 'string', 'max:255'],
            'parent_phone' => ['nullable', 'string', 'max:30'],
        ]);
        Student::create($data);

        return redirect()->route('students.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        return view('students.show', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        return view('students.edit', compact('student'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {
        $data = $request->validate([
            'nisn' => ['required', 'string', 'max:20', 'unique:students,nisn,'.$student->id],
            'name' => ['required', 'string', 'max:255'],
            'program' => ['required', 'string', 'max:255'],
            'class' => ['required', 'string', 'max:100'],
            'year_of_entry' => ['required', 'integer'],
            'parent_name' => ['nullable', 'string', 'max:255'],
            'parent_phone' => ['nullable', 'string', 'max:30'],
        ]);
        $student->update($data);

        return redirect()->route('students.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        $student->delete();

        return redirect()->route('students.index');
    }

    public function export()
    {
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="students.csv"',
        ];
        $callback = function () {
            $out = fopen('php://output', 'w');
            fputcsv($out, ['nisn', 'name', 'program', 'class', 'year_of_entry', 'parent_name', 'parent_phone']);
            Student::orderBy('name')->chunk(100, function ($chunk) use ($out) {
                foreach ($chunk as $s) {
                    fputcsv($out, [$s->nisn, $s->name, $s->program, $s->class, $s->year_of_entry, $s->parent_name, $s->parent_phone]);
                }
            });
            fclose($out);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => ['required', 'file'],
        ]);
        $path = $request->file('file')->getRealPath();
        $handle = fopen($path, 'r');
        $header = fgetcsv($handle);
        while (($row = fgetcsv($handle)) !== false) {
            [$nisn, $name, $program, $class, $year_of_entry, $parent_name, $parent_phone] = $row;
            Student::updateOrCreate(
                ['nisn' => $nisn],
                compact('name', 'program', 'class', 'year_of_entry', 'parent_name', 'parent_phone')
            );
        }
        fclose($handle);

        return redirect()->route('students.index');
    }
}
