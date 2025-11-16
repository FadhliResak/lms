<?php

namespace App\Http\Controllers;

use App\Models\AcademicRecord;
use App\Models\Alumni;
use App\Models\Asset;
use App\Models\Book;
use App\Models\Course;
use App\Models\Internship;
use App\Models\Letter;
use App\Models\Loan;
use App\Models\Partnership;
use App\Models\Staff;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $stats = [
            'students' => Student::count(),
            'staff' => Staff::count(),
            'assets' => Asset::count(),
            'courses' => Course::count(),
            'records' => AcademicRecord::count(),
            'internships' => Internship::count(),
            'partnerships' => Partnership::count(),
            'letters' => Letter::count(),
            'alumni' => Alumni::count(),
            'books' => Book::count(),
            'loans' => Loan::count(),
        ];

        return view('dashboard.index', compact('user', 'stats'));
    }
}
