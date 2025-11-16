@extends('layouts.app')

@section('content')
<h5 class="mb-3">Tambah Buku</h5>
<form method="POST" action="{{ route('books.store') }}" class="card p-3">
    @csrf
    <div class="row g-3">
        <div class="col-md-4">
            <label class="form-label">ISBN</label>
            <input type="text" name="isbn" value="{{ old('isbn') }}" class="form-control" required>
        </div>
        <div class="col-md-8">
            <label class="form-label">Judul</label>
            <input type="text" name="title" value="{{ old('title') }}" class="form-control" required>
        </div>
        <div class="col-md-6">
            <label class="form-label">Penulis</label>
            <input type="text" name="author" value="{{ old('author') }}" class="form-control" required>
        </div>
        <div class="col-md-3">
            <label class="form-label">Kategori</label>
            <input type="text" name="category" value="{{ old('category') }}" class="form-control" required>
        </div>
        <div class="col-md-3">
            <label class="form-label">Stok</label>
            <input type="number" name="stock" value="{{ old('stock') }}" class="form-control" required>
        </div>
    </div>
    <div class="mt-3">
        <button class="btn btn-primary" type="submit">Simpan</button>
        <a href="{{ route('books.index') }}" class="btn btn-secondary">Batal</a>
    </div>
</form>
@endsection