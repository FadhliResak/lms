@extends('layouts.app')

@section('content')
<h5 class="mb-3">Edit Kerjasama</h5>
<form method="POST" action="{{ route('partnerships.update', $partnership) }}" class="card p-3">
    @csrf
    @method('PUT')
    <div class="row g-3">
        <div class="col-md-6">
            <label class="form-label">Nama Mitra</label>
            <input type="text" name="partner_name" value="{{ old('partner_name', $partnership->partner_name) }}" class="form-control" required>
        </div>
        <div class="col-md-6">
            <label class="form-label">Judul Perjanjian</label>
            <input type="text" name="agreement_title" value="{{ old('agreement_title', $partnership->agreement_title) }}" class="form-control" required>
        </div>
        <div class="col-md-3">
            <label class="form-label">Mulai</label>
            <input type="date" name="start_date" value="{{ old('start_date', $partnership->start_date) }}" class="form-control">
        </div>
        <div class="col-md-3">
            <label class="form-label">Selesai</label>
            <input type="date" name="end_date" value="{{ old('end_date', $partnership->end_date) }}" class="form-control">
        </div>
        <div class="col-12">
            <label class="form-label">Catatan</label>
            <textarea name="notes" class="form-control" rows="4">{{ old('notes', $partnership->notes) }}</textarea>
        </div>
    </div>
    <div class="mt-3">
        <button class="btn btn-primary" type="submit">Simpan</button>
        <a href="{{ route('partnerships.index') }}" class="btn btn-secondary">Batal</a>
    </div>
</form>
@endsection