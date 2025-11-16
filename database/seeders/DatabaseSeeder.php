<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin',
                'password' => 'password',
                'role' => \App\Models\User::ROLE_TENAGA_ADMINISTRASI,
            ]
        );

        \App\Models\Student::updateOrCreate(
            ['nisn' => '1234567890'],
            [
                'name' => 'Rafi',
                'program' => 'Teknik Komputer dan Jaringan',
                'class' => 'X TKJ 1',
                'year_of_entry' => 2024,
                'parent_name' => 'Budi',
                'parent_phone' => '081234567890',
            ]
        );

        \App\Models\Staff::updateOrCreate(
            ['nip' => '1987654321'],
            [
                'name' => 'Ibu Sari',
                'position' => 'Guru',
                'type' => 'Guru',
                'phone' => '081298765432',
                'email' => 'sari@example.com',
            ]
        );

        \App\Models\Course::updateOrCreate(
            ['code' => 'TKJ101'],
            [
                'name' => 'Jaringan Dasar',
                'program' => 'Teknik Komputer dan Jaringan',
                'grade_level' => 'X',
                'semester' => 'Ganjil',
            ]
        );

        \App\Models\Book::updateOrCreate(
            ['isbn' => '9786020000001'],
            [
                'title' => 'Dasar Jaringan Komputer',
                'author' => 'Andi',
                'category' => 'TKJ',
                'stock' => 10,
            ]
        );
    }
}
