@extends('layouts.app')

@section('content')
<h5 class="mb-3">Edit Peminjaman</h5>
<form method="POST" action="{{ route('loans.update', $loan) }}" class="card p-3">
    @csrf
    @method('PUT')
    <div class="row g-3">
        <div class="col-md-6">
            <label class="form-label">Buku</label>
            <select name="book_id" class="form-select" required>
                @foreach($books as $b)
                    <option value="{{ $b->id }}" @if($loan->book_id == $b->id) selected @endif>{{ $b->title }} ({{ $b->isbn }})</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-6">
            <label class="form-label">Peminjam (Siswa)</label>
            <select name="borrower_id" class="form-select" required>
                @foreach($students as $s)
                    <option value="{{ $s->id }}" @if($loan->borrower_id == $s->id) selected @endif>{{ $s->name }} ({{ $s->class }})</option>
                @endforeach
            </select>
            <input type="hidden" name="borrower_type" value="student">
        </div>
        <div class="col-md-4">
            <label class="form-label">Tgl Pinjam</label>
            <input type="date" name="borrowed_at" value="{{ old('borrowed_at', $loan->borrowed_at) }}" class="form-control" required>
        </div>
        <div class="col-md-4">
            <label class="form-label">Jatuh Tempo</label>
            <input type="date" name="due_at" value="{{ old('due_at', $loan->due_at) }}" class="form-control" required>
        </div>
        <div class="col-md-4">
            <label class="form-label">Tgl Kembali</label>
            <input type="date" name="returned_at" value="{{ old('returned_at', $loan->returned_at) }}" class="form-control">
        </div>
    </div>
    <div class="mt-3">
        <button class="btn btn-primary" type="submit">Simpan</button>
        <a href="{{ route('loans.index') }}" class="btn btn-secondary">Batal</a>
    </div>
</form>
@endsection