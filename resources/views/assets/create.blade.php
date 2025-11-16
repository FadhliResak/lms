@extends('layouts.app')

@section('content')
<h5 class="mb-3">Tambah Sarpras</h5>
<form method="POST" action="{{ route('assets.store') }}" class="card p-3">
    @csrf
    <div class="row g-3">
        <div class="col-md-6">
            <label class="form-label">Nama</label>
            <input type="text" name="name" value="{{ old('name') }}" class="form-control" required>
        </div>
        <div class="col-md-6">
            <label class="form-label">Kategori</label>
            <input type="text" name="category" value="{{ old('category') }}" class="form-control" required>
        </div>
        <div class="col-md-4">
            <label class="form-label">Jumlah</label>
            <input type="number" name="quantity" value="{{ old('quantity') }}" class="form-control" required>
        </div>
        <div class="col-md-4">
            <label class="form-label">Kondisi</label>
            <input type="text" name="condition" value="{{ old('condition') }}" class="form-control" required>
        </div>
        <div class="col-md-4">
            <label class="form-label">Lokasi</label>
            <input type="text" name="location" value="{{ old('location') }}" class="form-control">
        </div>
    </div>
    <div class="mt-3">
        <button class="btn btn-primary" type="submit">Simpan</button>
        <a href="{{ route('assets.index') }}" class="btn btn-secondary">Batal</a>
    </div>
</form>
@endsection