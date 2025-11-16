@extends('layouts.app')

@section('content')
<h5 class="mb-3">Edit Rekap</h5>
<form method="POST" action="{{ route('records.update', $record) }}" class="card p-3">
    @csrf
    @method('PUT')
    <div class="row g-3">
        <div class="col-md-6">
            <label class="form-label">Siswa</label>
            <select name="student_id" class="form-select" required>
                @foreach($students as $s)
                    <option value="{{ $s->id }}" @if($record->student_id == $s->id) selected @endif>{{ $s->name }} ({{ $s->class }})</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-6">
            <label class="form-label">Mata Pelajaran</label>
            <select name="course_id" class="form-select" required>
                @foreach($courses as $c)
                    <option value="{{ $c->id }}" @if($record->course_id == $c->id) selected @endif>{{ $c->name }} ({{ $c->semester }})</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4">
            <label class="form-label">Semester</label>
            <input type="text" name="semester" value="{{ old('semester', $record->semester) }}" class="form-control" required>
        </div>
        <div class="col-md-4">
            <label class="form-label">Nilai</label>
            <input type="number" name="score" value="{{ old('score', $record->score) }}" class="form-control" required>
        </div>
        <div class="col-md-4">
            <label class="form-label">Absensi</label>
            <input type="text" name="attendance" value="{{ old('attendance', $record->attendance) }}" class="form-control">
        </div>
    </div>
    <div class="mt-3">
        <button class="btn btn-primary" type="submit">Simpan</button>
        <a href="{{ route('records.index') }}" class="btn btn-secondary">Batal</a>
    </div>
</form>
@endsection