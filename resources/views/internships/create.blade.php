@extends('layouts.app')

@section('content')
<h5 class="mb-3">Tambah PKL</h5>
<form method="POST" action="{{ route('internships.store') }}" class="card p-3">
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
            <label class="form-label">Perusahaan</label>
            <input type="text" name="company" value="{{ old('company') }}" class="form-control" required>
        </div>
        <div class="col-md-6">
            <label class="form-label">Pembimbing</label>
            <input type="text" name="supervisor" value="{{ old('supervisor') }}" class="form-control">
        </div>
        <div class="col-md-3">
            <label class="form-label">Mulai</label>
            <input type="date" name="start_date" value="{{ old('start_date') }}" class="form-control" required>
        </div>
        <div class="col-md-3">
            <label class="form-label">Selesai</label>
            <input type="date" name="end_date" value="{{ old('end_date') }}" class="form-control">
        </div>
        <div class="col-md-4">
            <label class="form-label">Status</label>
            <input type="text" name="status" value="{{ old('status', 'proses') }}" class="form-control" required>
        </div>
        <div class="col-md-4">
            <label class="form-label">Nilai</label>
            <input type="number" name="score" value="{{ old('score') }}" class="form-control">
        </div>
    </div>
    <div class="mt-3">
        <button class="btn btn-primary" type="submit">Simpan</button>
        <a href="{{ route('internships.index') }}" class="btn btn-secondary">Batal</a>
    </div>
</form>
@endsection