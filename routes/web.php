<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Modul landing redirects
    Route::get('/akademik', function () {
        return redirect()->route('courses.index');
    });
    Route::get('/kesiswaan', function () {
        return redirect()->route('students.index');
    });
    Route::get('/kepegawaian', function () {
        return redirect()->route('staff.index');
    });
    Route::get('/sarpras', function () {
        return redirect()->route('assets.index');
    });
    Route::get('/pkl', function () {
        return redirect()->route('internships.index');
    });
    Route::get('/humas', function () {
        return redirect()->route('partnerships.index');
    });
    Route::get('/alumni', function () {
        return redirect()->route('alumni.index');
    });
    Route::get('/perpustakaan', function () {
        return redirect()->route('books.index');
    });

    // Resources dengan role-based
    Route::resource('courses', App\Http\Controllers\CourseController::class)->middleware('role:wakil_kurikulum,tenaga_administrasi');
    Route::resource('records', App\Http\Controllers\AcademicRecordController::class)->middleware('role:wakil_kurikulum,tenaga_administrasi');

    Route::resource('students', App\Http\Controllers\StudentController::class)->middleware('role:wakil_kesiswaan,tenaga_administrasi');
    Route::resource('staff', App\Http\Controllers\StaffController::class)->middleware('role:tenaga_administrasi,kepala_sekolah,wakil_kurikulum,wakil_kesiswaan,wakil_sarpras,wakil_humas');
    Route::resource('assets', App\Http\Controllers\AssetController::class)->middleware('role:wakil_sarpras,tenaga_administrasi');

    Route::resource('internships', App\Http\Controllers\InternshipController::class)->middleware('role:guru_pembimbing_pkl,tenaga_administrasi,wakil_humas');
    Route::resource('partnerships', App\Http\Controllers\PartnershipController::class)->middleware('role:wakil_humas,tenaga_administrasi');
    Route::resource('letters', App\Http\Controllers\LetterController::class)->middleware('role:wakil_humas,tenaga_administrasi');

    Route::resource('alumni', App\Http\Controllers\AlumniController::class)->middleware('role:wakil_kesiswaan,tenaga_administrasi');
    Route::resource('books', App\Http\Controllers\BookController::class)->middleware('role:tenaga_administrasi');
    Route::resource('loans', App\Http\Controllers\LoanController::class)->middleware('role:tenaga_administrasi');

    // Export/Import
    Route::get('/students-export', [App\Http\Controllers\StudentController::class, 'export'])->name('students.export');
    Route::post('/students-import', [App\Http\Controllers\StudentController::class, 'import'])->name('students.import');

    // Messenger Internal
    Route::resource('messages', App\Http\Controllers\MessageController::class)->only(['index', 'create', 'store', 'show', 'destroy']);
});
