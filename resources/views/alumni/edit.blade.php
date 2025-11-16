@extends('layouts.app')

@section('content')
<h5 class="mb-3">Edit Alumni</h5>
<form method="POST" action="{{ route('alumni.update', $alumni) }}" class="card p-3">
    @csrf
    @method('PUT')
    <div class="row g-3">
        <div class="col-md-6">
            <label class="form-label">Nama</label>
            <input type="text" name="name" value="{{ old('name', $alumni->name) }}" class="form-control" required>
        </div>
        <div class="col-md-6">
            <label class="form-label">Program</label>
            <input type="text" name="program" value="{{ old('program', $alumni->program) }}" class="form-control" required>
        </div>
        <div class="col-md-3">
            <label class="form-label">Tahun Lulus</label>
            <input type="number" name="graduation_year" value="{{ old('graduation_year', $alumni->graduation_year) }}" class="form-control" required>
        </div>
        <div class="col-md-4">
            <label class="form-label">Kontak</label>
            <input type="text" name="contact" value="{{ old('contact', $alumni->contact) }}" class="form-control">
        </div>
        <div class="col-md-5">
            <label class="form-label">Status Pekerjaan</label>
            <input type="text" name="employment_status" value="{{ old('employment_status', $alumni->employment_status) }}" class="form-control">
        </div>
    </div>
    <div class="mt-3">
        <button class="btn btn-primary" type="submit">Simpan</button>
        <a href="{{ route('alumni.index') }}" class="btn btn-secondary">Batal</a>
    </div>
</form>
@endsection