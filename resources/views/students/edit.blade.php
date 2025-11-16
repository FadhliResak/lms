@extends('layouts.app')

@section('content')
<h5 class="mb-3">Edit Siswa</h5>
<form method="POST" action="{{ route('students.update', $student) }}" class="card p-3">
    @csrf
    @method('PUT')
    <div class="row g-3">
        <div class="col-md-4">
            <label class="form-label">NISN</label>
            <input type="text" name="nisn" value="{{ old('nisn', $student->nisn) }}" class="form-control" required>
        </div>
        <div class="col-md-8">
            <label class="form-label">Nama</label>
            <input type="text" name="name" value="{{ old('name', $student->name) }}" class="form-control" required>
        </div>
        <div class="col-md-6">
            <label class="form-label">Program</label>
            <input type="text" name="program" value="{{ old('program', $student->program) }}" class="form-control" required>
        </div>
        <div class="col-md-3">
            <label class="form-label">Kelas</label>
            <input type="text" name="class" value="{{ old('class', $student->class) }}" class="form-control" required>
        </div>
        <div class="col-md-3">
            <label class="form-label">Tahun Masuk</label>
            <input type="number" name="year_of_entry" value="{{ old('year_of_entry', $student->year_of_entry) }}" class="form-control" required>
        </div>
        <div class="col-md-6">
            <label class="form-label">Nama Orang Tua</label>
            <input type="text" name="parent_name" value="{{ old('parent_name', $student->parent_name) }}" class="form-control">
        </div>
        <div class="col-md-6">
            <label class="form-label">No. HP Orang Tua</label>
            <input type="text" name="parent_phone" value="{{ old('parent_phone', $student->parent_phone) }}" class="form-control">
        </div>
    </div>
    <div class="mt-3">
        <button class="btn btn-primary" type="submit">Simpan</button>
        <a href="{{ route('students.index') }}" class="btn btn-secondary">Batal</a>
    </div>
</form>
@endsection