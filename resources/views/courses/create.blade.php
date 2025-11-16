@extends('layouts.app')

@section('content')
<h5 class="mb-3">Tambah Mata Pelajaran</h5>
<form method="POST" action="{{ route('courses.store') }}" class="card p-3">
    @csrf
    <div class="row g-3">
        <div class="col-md-4">
            <label class="form-label">Kode</label>
            <input type="text" name="code" value="{{ old('code') }}" class="form-control" required>
        </div>
        <div class="col-md-8">
            <label class="form-label">Nama</label>
            <input type="text" name="name" value="{{ old('name') }}" class="form-control" required>
        </div>
        <div class="col-md-6">
            <label class="form-label">Program</label>
            <input type="text" name="program" value="{{ old('program') }}" class="form-control" required>
        </div>
        <div class="col-md-3">
            <label class="form-label">Kelas</label>
            <input type="text" name="grade_level" value="{{ old('grade_level') }}" class="form-control" required>
        </div>
        <div class="col-md-3">
            <label class="form-label">Semester</label>
            <input type="text" name="semester" value="{{ old('semester') }}" class="form-control" required>
        </div>
    </div>
    <div class="mt-3">
        <button class="btn btn-primary" type="submit">Simpan</button>
        <a href="{{ route('courses.index') }}" class="btn btn-secondary">Batal</a>
    </div>
</form>
@endsection