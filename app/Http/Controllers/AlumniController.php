<?php

namespace App\Http\Controllers;

use App\Models\Alumni;
use Illuminate\Http\Request;

class AlumniController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $alumni = Alumni::orderBy('graduation_year', 'desc')->paginate(10);

        return view('alumni.index', compact('alumni'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('alumni.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'program' => ['required', 'string', 'max:255'],
            'graduation_year' => ['required', 'integer'],
            'contact' => ['nullable', 'string', 'max:100'],
            'employment_status' => ['nullable', 'string', 'max:100'],
        ]);
        Alumni::create($data);

        return redirect()->route('alumni.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Alumni $alumni)
    {
        return view('alumni.show', compact('alumni'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Alumni $alumni)
    {
        return view('alumni.edit', compact('alumni'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Alumni $alumni)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'program' => ['required', 'string', 'max:255'],
            'graduation_year' => ['required', 'integer'],
            'contact' => ['nullable', 'string', 'max:100'],
            'employment_status' => ['nullable', 'string', 'max:100'],
        ]);
        $alumni->update($data);

        return redirect()->route('alumni.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Alumni $alumni)
    {
        $alumni->delete();

        return redirect()->route('alumni.index');
    }
}
