<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use Illuminate\Http\Request;

class AssetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $assets = Asset::orderBy('name')->paginate(10);

        return view('assets.index', compact('assets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('assets.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string', 'max:100'],
            'quantity' => ['required', 'integer', 'min:0'],
            'condition' => ['required', 'string', 'max:100'],
            'location' => ['nullable', 'string', 'max:255'],
        ]);
        Asset::create($data);

        return redirect()->route('assets.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Asset $asset)
    {
        return view('assets.show', compact('asset'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Asset $asset)
    {
        return view('assets.edit', compact('asset'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Asset $asset)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string', 'max:100'],
            'quantity' => ['required', 'integer', 'min:0'],
            'condition' => ['required', 'string', 'max:100'],
            'location' => ['nullable', 'string', 'max:255'],
        ]);
        $asset->update($data);

        return redirect()->route('assets.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Asset $asset)
    {
        $asset->delete();

        return redirect()->route('assets.index');
    }
}
