@extends('layouts.app')

@section('content')
<h5 class="mb-3">Tambah Surat</h5>
<form method="POST" action="{{ route('letters.store') }}" class="card p-3">
    @csrf
    <div class="row g-3">
        <div class="col-md-4">
            <label class="form-label">Nomor</label>
            <input type="text" name="number" value="{{ old('number') }}" class="form-control" required>
        </div>
        <div class="col-md-8">
            <label class="form-label">Perihal</label>
            <input type="text" name="subject" value="{{ old('subject') }}" class="form-control" required>
        </div>
        <div class="col-md-4">
            <label class="form-label">Tanggal</label>
            <input type="date" name="date" value="{{ old('date') }}" class="form-control" required>
        </div>
        <div class="col-md-4">
            <label class="form-label">Jenis</label>
            <input type="text" name="type" value="{{ old('type', 'outgoing') }}" class="form-control" required>
        </div>
        <div class="col-md-4">
            <label class="form-label">Mitra</label>
            <input type="text" name="partner_name" value="{{ old('partner_name') }}" class="form-control">
        </div>
        <div class="col-12">
            <label class="form-label">Catatan</label>
            <textarea name="notes" class="form-control" rows="4">{{ old('notes') }}</textarea>
        </div>
    </div>
    <div class="mt-3">
        <button class="btn btn-primary" type="submit">Simpan</button>
        <a href="{{ route('letters.index') }}" class="btn btn-secondary">Batal</a>
    </div>
</form>
@endsection