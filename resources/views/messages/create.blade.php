@extends('layouts.app')

@section('content')
<h5 class="mb-3">Tulis Pesan</h5>
<form method="POST" action="{{ route('messages.store') }}" class="card p-3">
    @csrf
    <div class="row g-3">
        <div class="col-md-6">
            <label class="form-label">Kepada</label>
            <select name="to_id" class="form-select" required>
                <option value="">Pilih pengguna</option>
                @foreach($users as $u)
                    <option value="{{ $u->id }}">{{ $u->name }} ({{ $u->role }})</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-6">
            <label class="form-label">Subjek</label>
            <input type="text" name="subject" value="{{ old('subject') }}" class="form-control" required>
        </div>
        <div class="col-12">
            <label class="form-label">Isi Pesan</label>
            <textarea name="body" class="form-control" rows="6" required>{{ old('body') }}</textarea>
        </div>
    </div>
    <div class="mt-3">
        <button class="btn btn-primary" type="submit">Kirim</button>
        <a href="{{ route('messages.index') }}" class="btn btn-secondary">Batal</a>
    </div>
</form>
@endsection