<?php

namespace App\Providers;

use App\Models\AcademicRecord;
use App\Models\Alumni;
use App\Models\Asset;
use App\Models\Book;
use App\Models\Course;
use App\Models\Internship;
use App\Models\Letter;
use App\Models\Loan;
use App\Models\Message;
use App\Models\Partnership;
use App\Models\Staff;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('layouts.app', function ($view) {
            $user = Auth::user();
            if (! $user) {
                return;
            }
            $role = $user->role;
            $keys = [];
            if (in_array($role, ['wakil_kurikulum', 'tenaga_administrasi'], true)) {
                $keys = array_merge($keys, ['courses', 'records']);
            }
            if (in_array($role, ['wakil_kesiswaan', 'tenaga_administrasi'], true)) {
                $keys = array_merge($keys, ['students', 'alumni']);
            }
            if (in_array($role, ['tenaga_administrasi', 'kepala_sekolah', 'wakil_kurikulum', 'wakil_kesiswaan', 'wakil_sarpras', 'wakil_humas'], true)) {
                $keys[] = 'staff';
            }
            if (in_array($role, ['wakil_sarpras', 'tenaga_administrasi'], true)) {
                $keys[] = 'assets';
            }
            if (in_array($role, ['guru_pembimbing_pkl', 'tenaga_administrasi', 'wakil_humas'], true)) {
                $keys[] = 'internships';
            }
            if (in_array($role, ['wakil_humas', 'tenaga_administrasi'], true)) {
                $keys = array_merge($keys, ['partnerships', 'letters']);
            }
            if (in_array($role, ['tenaga_administrasi'], true)) {
                $keys = array_merge($keys, ['books', 'loans']);
            }
            $keys = array_values(array_unique($keys));
            $counts = [];
            $ttlMap = [
                'courses' => 60,
                'records' => 30,
                'students' => 120,
                'staff' => 120,
                'assets' => 300,
                'internships' => 30,
                'partnerships' => 60,
                'letters' => 30,
                'alumni' => 120,
                'books' => 60,
                'loans' => 15,
            ];
            foreach ($keys as $key) {
                $ttl = $ttlMap[$key] ?? 60;
                $counts[$key] = Cache::remember('nav_count_'.$key, $ttl, function () use ($key) {
                    return match ($key) {
                        'courses' => Course::count(),
                        'records' => AcademicRecord::count(),
                        'students' => Student::count(),
                        'staff' => Staff::count(),
                        'assets' => Asset::count(),
                        'internships' => Internship::count(),
                        'partnerships' => Partnership::count(),
                        'letters' => Letter::count(),
                        'alumni' => Alumni::count(),
                        'books' => Book::count(),
                        'loans' => Loan::count(),
                        default => 0,
                    };
                });
            }
            $counts['messages_unread'] = Message::where('to_id', $user->id)->whereNull('read_at')->count();
            $view->with('navCounts', $counts);
        });

        Course::saved(function () {
            Cache::forget('nav_count_courses');
        });
        Course::deleted(function () {
            Cache::forget('nav_count_courses');
        });

        AcademicRecord::saved(function () {
            Cache::forget('nav_count_records');
        });
        AcademicRecord::deleted(function () {
            Cache::forget('nav_count_records');
        });

        Student::saved(function () {
            Cache::forget('nav_count_students');
            Cache::forget('nav_count_alumni');
        });
        Student::deleted(function () {
            Cache::forget('nav_count_students');
            Cache::forget('nav_count_alumni');
        });

        Staff::saved(function () {
            Cache::forget('nav_count_staff');
        });
        Staff::deleted(function () {
            Cache::forget('nav_count_staff');
        });

        Asset::saved(function () {
            Cache::forget('nav_count_assets');
        });
        Asset::deleted(function () {
            Cache::forget('nav_count_assets');
        });

        Internship::saved(function () {
            Cache::forget('nav_count_internships');
        });
        Internship::deleted(function () {
            Cache::forget('nav_count_internships');
        });

        Partnership::saved(function () {
            Cache::forget('nav_count_partnerships');
        });
        Partnership::deleted(function () {
            Cache::forget('nav_count_partnerships');
        });

        Letter::saved(function () {
            Cache::forget('nav_count_letters');
        });
        Letter::deleted(function () {
            Cache::forget('nav_count_letters');
        });

        Alumni::saved(function () {
            Cache::forget('nav_count_alumni');
        });
        Alumni::deleted(function () {
            Cache::forget('nav_count_alumni');
        });

        Book::saved(function () {
            Cache::forget('nav_count_books');
        });
        Book::deleted(function () {
            Cache::forget('nav_count_books');
        });

        Loan::saved(function () {
            Cache::forget('nav_count_loans');
        });
        Loan::deleted(function () {
            Cache::forget('nav_count_loans');
        });
    }
}
