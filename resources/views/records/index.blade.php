@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h5>Rekap Nilai & Absensi</h5>
    <a href="{{ route('records.create') }}" class="btn btn-primary">Tambah</a>
</div>
<div class="card">
    <div class="card-body p-0">
        <table class="table mb-0">
            <thead>
                <tr>
                    <th>Siswa</th>
                    <th>Mata Pelajaran</th>
                    <th>Semester</th>
                    <th>Nilai</th>
                    <th>Absensi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($records as $r)
                <tr>
                    <td>{{ $r->student->name ?? '-' }}</td>
                    <td>{{ $r->course->name ?? '-' }}</td>
                    <td>{{ $r->semester }}</td>
                    <td>{{ $r->score }}</td>
                    <td>{{ $r->attendance }}</td>
                    <td class="text-nowrap">
                        <a href="{{ route('records.edit', $r) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('records.destroy', $r) }}" method="POST" class="d-inline">
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
<div class="mt-3">{{ $records->links() }}</div>
@endsection