<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = Course::orderBy('code')->paginate(10);

        return view('courses.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('courses.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'code' => ['required', 'string', 'max:20', 'unique:courses,code'],
            'name' => ['required', 'string', 'max:255'],
            'program' => ['required', 'string', 'max:255'],
            'grade_level' => ['required', 'string', 'max:10'],
            'semester' => ['required', 'string', 'max:20'],
        ]);
        Course::create($data);

        return redirect()->route('courses.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        return view('courses.show', compact('course'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
        return view('courses.edit', compact('course'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Course $course)
    {
        $data = $request->validate([
            'code' => ['required', 'string', 'max:20', 'unique:courses,code,'.$course->id],
            'name' => ['required', 'string', 'max:255'],
            'program' => ['required', 'string', 'max:255'],
            'grade_level' => ['required', 'string', 'max:10'],
            'semester' => ['required', 'string', 'max:20'],
        ]);
        $course->update($data);

        return redirect()->route('courses.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        $course->delete();

        return redirect()->route('courses.index');
    }
}
