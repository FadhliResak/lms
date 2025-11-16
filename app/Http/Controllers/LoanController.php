<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $loans = Loan::with('book')->orderBy('borrowed_at', 'desc')->paginate(10);

        return view('library.loans.index', compact('loans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $books = \App\Models\Book::orderBy('title')->get();
        $students = \App\Models\Student::orderBy('name')->get();

        return view('library.loans.create', compact('books', 'students'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'book_id' => ['required', 'exists:books,id'],
            'borrower_type' => ['required', 'in:student'],
            'borrower_id' => ['required', 'exists:students,id'],
            'borrowed_at' => ['required', 'date'],
            'due_at' => ['required', 'date'],
        ]);
        Loan::create($data);

        return redirect()->route('loans.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Loan $loan)
    {
        return view('library.loans.show', compact('loan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Loan $loan)
    {
        $books = \App\Models\Book::orderBy('title')->get();
        $students = \App\Models\Student::orderBy('name')->get();

        return view('library.loans.edit', compact('loan', 'books', 'students'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Loan $loan)
    {
        $data = $request->validate([
            'book_id' => ['required', 'exists:books,id'],
            'borrower_type' => ['required', 'in:student'],
            'borrower_id' => ['required', 'exists:students,id'],
            'borrowed_at' => ['required', 'date'],
            'due_at' => ['required', 'date'],
            'returned_at' => ['nullable', 'date'],
        ]);
        $loan->update($data);

        return redirect()->route('loans.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Loan $loan)
    {
        $loan->delete();

        return redirect()->route('loans.index');
    }
}
