@extends('layouts.app')

@section('content')
<h5 class="mb-3">Tambah Rekap</h5>
<form method="POST" action="{{ route('records.store') }}" class="card p-3">
    @csrf
    <div class="row g-3">
        <div class="col-md-6">
            <label class="form-label">Siswa</label>
            <select name="student_id" class="form-select" required>
                <option value="">Pilih siswa</option>
                @foreach($students as $s)
                    <option value="{{ $s->id }}">{{ $s->name }} ({{ $s->class }})</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-6">
            <label class="form-label">Mata Pelajaran</label>
            <select name="course_id" class="form-select" required>
                <option value="">Pilih mapel</option>
                @foreach($courses as $c)
                    <option value="{{ $c->id }}">{{ $c->name }} ({{ $c->semester }})</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4">
            <label class="form-label">Semester</label>
            <input type="text" name="semester" value="{{ old('semester') }}" class="form-control" required>
        </div>
        <div class="col-md-4">
            <label class="form-label">Nilai</label>
            <input type="number" name="score" value="{{ old('score') }}" class="form-control" required>
        </div>
        <div class="col-md-4">
            <label class="form-label">Absensi</label>
            <input type="text" name="attendance" value="{{ old('attendance') }}" class="form-control">
        </div>
    </div>
    <div class="mt-3">
        <button class="btn btn-primary" type="submit">Simpan</button>
        <a href="{{ route('records.index') }}" class="btn btn-secondary">Batal</a>
    </div>
</form>
@endsection