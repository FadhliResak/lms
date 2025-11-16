@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h5>Humas & Kemitraan</h5>
    <a href="{{ route('partnerships.create') }}" class="btn btn-primary">Tambah Kerjasama</a>
</div>
<div class="card">
    <div class="card-body p-0">
        <table class="table mb-0">
            <thead>
                <tr>
                    <th>Mitra</th>
                    <th>Judul</th>
                    <th>Mulai</th>
                    <th>Selesai</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($partnerships as $p)
                <tr>
                    <td>{{ $p->partner_name }}</td>
                    <td>{{ $p->agreement_title }}</td>
                    <td>{{ $p->start_date }}</td>
                    <td>{{ $p->end_date }}</td>
                    <td class="text-nowrap">
                        <a href="{{ route('partnerships.edit', $p) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('partnerships.destroy', $p) }}" method="POST" class="d-inline">
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
<div class="mt-3">{{ $partnerships->links() }}</div>
@endsection