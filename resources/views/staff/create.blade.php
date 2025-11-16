@extends('layouts.app')

@section('content')
<h5 class="mb-3">Tambah Pegawai</h5>
<form method="POST" action="{{ route('staff.store') }}" class="card p-3">
    @csrf
    <div class="row g-3">
        <div class="col-md-4">
            <label class="form-label">NIP</label>
            <input type="text" name="nip" value="{{ old('nip') }}" class="form-control">
        </div>
        <div class="col-md-8">
            <label class="form-label">Nama</label>
            <input type="text" name="name" value="{{ old('name') }}" class="form-control" required>
        </div>
        <div class="col-md-6">
            <label class="form-label">Jabatan</label>
            <input type="text" name="position" value="{{ old('position') }}" class="form-control" required>
        </div>
        <div class="col-md-6">
            <label class="form-label">Jenis</label>
            <input type="text" name="type" value="{{ old('type') }}" class="form-control" required>
        </div>
        <div class="col-md-6">
            <label class="form-label">No. HP</label>
            <input type="text" name="phone" value="{{ old('phone') }}" class="form-control">
        </div>
        <div class="col-md-6">
            <label class="form-label">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" class="form-control">
        </div>
    </div>
    <div class="mt-3">
        <button class="btn btn-primary" type="submit">Simpan</button>
        <a href="{{ route('staff.index') }}" class="btn btn-secondary">Batal</a>
    </div>
</form>
@endsection