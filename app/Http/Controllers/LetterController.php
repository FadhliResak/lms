<?php

namespace App\Http\Controllers;

use App\Models\Letter;
use Illuminate\Http\Request;

class LetterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $letters = Letter::orderBy('date', 'desc')->paginate(10);

        return view('humas.letters.index', compact('letters'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('humas.letters.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'number' => ['required', 'string', 'max:100'],
            'subject' => ['required', 'string', 'max:255'],
            'date' => ['required', 'date'],
            'type' => ['required', 'string', 'max:50'],
            'partner_name' => ['nullable', 'string', 'max:255'],
            'notes' => ['nullable', 'string'],
        ]);
        Letter::create($data);

        return redirect()->route('letters.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Letter $letter)
    {
        return view('humas.letters.show', compact('letter'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Letter $letter)
    {
        return view('humas.letters.edit', compact('letter'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Letter $letter)
    {
        $data = $request->validate([
            'number' => ['required', 'string', 'max:100'],
            'subject' => ['required', 'string', 'max:255'],
            'date' => ['required', 'date'],
            'type' => ['required', 'string', 'max:50'],
            'partner_name' => ['nullable', 'string', 'max:255'],
            'notes' => ['nullable', 'string'],
        ]);
        $letter->update($data);

        return redirect()->route('letters.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Letter $letter)
    {
        $letter->delete();

        return redirect()->route('letters.index');
    }
}
