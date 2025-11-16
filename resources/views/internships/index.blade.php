@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h5>Administrasi PKL</h5>
    <a href="{{ route('internships.create') }}" class="btn btn-primary">Tambah</a>
</div>
<div class="card">
    <div class="card-body p-0">
        <table class="table mb-0">
            <thead>
                <tr>
                    <th>Siswa</th>
                    <th>Perusahaan</th>
                    <th>Pembimbing</th>
                    <th>Mulai</th>
                    <th>Status</th>
                    <th>Nilai</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($internships as $i)
                <tr>
                    <td>{{ $i->student->name ?? '-' }}</td>
                    <td>{{ $i->company }}</td>
                    <td>{{ $i->supervisor }}</td>
                    <td>{{ $i->start_date }}</td>
                    <td>{{ $i->status }}</td>
                    <td>{{ $i->score }}</td>
                    <td class="text-nowrap">
                        <a href="{{ route('internships.edit', $i) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('internships.destroy', $i) }}" method="POST" class="d-inline">
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
<div class="mt-3">{{ $internships->links() }}</div>
@endsection