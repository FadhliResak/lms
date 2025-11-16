@extends('layouts.app')

@section('content')
<h5 class="mb-3">Tambah Peminjaman</h5>
<form method="POST" action="{{ route('loans.store') }}" class="card p-3">
    @csrf
    <div class="row g-3">
        <div class="col-md-6">
            <label class="form-label">Buku</label>
            <select name="book_id" class="form-select" required>
                <option value="">Pilih buku</option>
                @foreach($books as $b)
                    <option value="{{ $b->id }}">{{ $b->title }} ({{ $b->isbn }})</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-6">
            <label class="form-label">Peminjam (Siswa)</label>
            <select name="borrower_id" class="form-select" required>
                <option value="">Pilih siswa</option>
                @foreach($students as $s)
                    <option value="{{ $s->id }}">{{ $s->name }} ({{ $s->class }})</option>
                @endforeach
            </select>
            <input type="hidden" name="borrower_type" value="student">
        </div>
        <div class="col-md-4">
            <label class="form-label">Tgl Pinjam</label>
            <input type="date" name="borrowed_at" value="{{ old('borrowed_at') }}" class="form-control" required>
        </div>
        <div class="col-md-4">
            <label class="form-label">Jatuh Tempo</label>
            <input type="date" name="due_at" value="{{ old('due_at') }}" class="form-control" required>
        </div>
        <div class="col-md-4">
            <label class="form-label">Tgl Kembali</label>
            <input type="date" name="returned_at" value="{{ old('returned_at') }}" class="form-control">
        </div>
    </div>
    <div class="mt-3">
        <button class="btn btn-primary" type="submit">Simpan</button>
        <a href="{{ route('loans.index') }}" class="btn btn-secondary">Batal</a>
    </div>
</form>
@endsection