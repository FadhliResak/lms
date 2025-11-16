@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h5>Surat Menyurat</h5>
    <a href="{{ route('letters.create') }}" class="btn btn-primary">Tambah Surat</a>
</div>
<div class="card">
    <div class="card-body p-0">
        <table class="table mb-0">
            <thead>
                <tr>
                    <th>Nomor</th>
                    <th>Perihal</th>
                    <th>Tanggal</th>
                    <th>Jenis</th>
                    <th>Mitra</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($letters as $l)
                <tr>
                    <td>{{ $l->number }}</td>
                    <td>{{ $l->subject }}</td>
                    <td>{{ $l->date }}</td>
                    <td>{{ $l->type }}</td>
                    <td>{{ $l->partner_name }}</td>
                    <td class="text-nowrap">
                        <a href="{{ route('letters.edit', $l) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('letters.destroy', $l) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<div class="mt-3">{{ $letters->links() }}</div>
@endsection