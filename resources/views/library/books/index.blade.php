@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h5>Perpustakaan - Koleksi Buku</h5>
    <a href="{{ route('books.create') }}" class="btn btn-primary">Tambah Buku</a>
</div>
<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table mb-0">
            <thead>
                <tr>
                    <th>ISBN</th>
                    <th>Judul</th>
                    <th>Penulis</th>
                    <th>Kategori</th>
                    <th>Stok</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($books as $b)
                <tr>
                    <td>{{ $b->isbn }}</td>
                    <td>{{ $b->title }}</td>
                    <td>{{ $b->author }}</td>
                    <td>{{ $b->category }}</td>
                    <td>{{ $b->stock }}</td>
                    <td class="text-nowrap">
                        <a href="{{ route('books.edit', $b) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('books.destroy', $b) }}" method="POST" class="d-inline">
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
</div>
<div class="mt-3">{{ $books->links() }}</div>
@endsection