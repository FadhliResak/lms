@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h5>Peminjaman Buku</h5>
    <a href="{{ route('loans.create') }}" class="btn btn-primary">Tambah Peminjaman</a>
</div>
<div class="card">
    <div class="card-body p-0">
        <table class="table mb-0">
            <thead>
                <tr>
                    <th>Judul Buku</th>
                    <th>Peminjam</th>
                    <th>Tgl Pinjam</th>
                    <th>Jatuh Tempo</th>
                    <th>Tgl Kembali</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($loans as $l)
                <tr>
                    <td>{{ $l->book->title ?? '-' }}</td>
                    <td>{{ $l->borrower_type }} #{{ $l->borrower_id }}</td>
                    <td>{{ $l->borrowed_at }}</td>
                    <td>{{ $l->due_at }}</td>
                    <td>{{ $l->returned_at }}</td>
                    <td class="text-nowrap">
                        <a href="{{ route('loans.edit', $l) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('loans.destroy', $l) }}" method="POST" class="d-inline">
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
<div class="mt-3">{{ $loans->links() }}</div>
@endsection