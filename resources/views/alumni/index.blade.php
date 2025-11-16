@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h5>Kelulusan & Alumni</h5>
    <a href="{{ route('alumni.create') }}" class="btn btn-primary">Tambah Alumni</a>
</div>
<div class="card">
    <div class="card-body p-0">
        <table class="table mb-0">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Program</th>
                    <th>Tahun Lulus</th>
                    <th>Kontak</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($alumni as $a)
                <tr>
                    <td>{{ $a->name }}</td>
                    <td>{{ $a->program }}</td>
                    <td>{{ $a->graduation_year }}</td>
                    <td>{{ $a->contact }}</td>
                    <td>{{ $a->employment_status }}</td>
                    <td class="text-nowrap">
                        <a href="{{ route('alumni.edit', $a) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('alumni.destroy', $a) }}" method="POST" class="d-inline">
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
<div class="mt-3">{{ $alumni->links() }}</div>
@endsection