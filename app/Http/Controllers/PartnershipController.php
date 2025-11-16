<?php

namespace App\Http\Controllers;

use App\Models\Partnership;
use Illuminate\Http\Request;

class PartnershipController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $partnerships = Partnership::orderBy('id', 'desc')->paginate(10);

        return view('humas.partnerships.index', compact('partnerships'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('humas.partnerships.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'partner_name' => ['required', 'string', 'max:255'],
            'agreement_title' => ['required', 'string', 'max:255'],
            'start_date' => ['nullable', 'date'],
            'end_date' => ['nullable', 'date'],
            'notes' => ['nullable', 'string'],
        ]);
        Partnership::create($data);

        return redirect()->route('partnerships.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Partnership $partnership)
    {
        return view('humas.partnerships.show', compact('partnership'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Partnership $partnership)
    {
        return view('humas.partnerships.edit', compact('partnership'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Partnership $partnership)
    {
        $data = $request->validate([
            'partner_name' => ['required', 'string', 'max:255'],
            'agreement_title' => ['required', 'string', 'max:255'],
            'start_date' => ['nullable', 'date'],
            'end_date' => ['nullable', 'date'],
            'notes' => ['nullable', 'string'],
        ]);
        $partnership->update($data);

        return redirect()->route('partnerships.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Partnership $partnership)
    {
        $partnership->delete();

        return redirect()->route('partnerships.index');
    }
}
