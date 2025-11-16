@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h5>Sarana & Prasarana</h5>
    <a href="{{ route('assets.create') }}" class="btn btn-primary">Tambah</a>
</div>
<div class="card">
    <div class="card-body p-0">
        <table class="table mb-0">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Kategori</th>
                    <th>Jumlah</th>
                    <th>Kondisi</th>
                    <th>Lokasi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($assets as $a)
                <tr>
                    <td>{{ $a->name }}</td>
                    <td>{{ $a->category }}</td>
                    <td>{{ $a->quantity }}</td>
                    <td>{{ $a->condition }}</td>
                    <td>{{ $a->location }}</td>
                    <td class="text-nowrap">
                        <a href="{{ route('assets.edit', $a) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('assets.destroy', $a) }}" method="POST" class="d-inline">
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
<div class="mt-3">{{ $assets->links() }}</div>
@endsection