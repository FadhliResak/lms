@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h5>Administrasi Akademik - Mata Pelajaran</h5>
    <a href="{{ route('courses.create') }}" class="btn btn-primary">Tambah</a>
</div>
<div class="card">
    <div class="card-body p-0">
        <table class="table mb-0">
            <thead>
                <tr>
                    <th>Kode</th>
                    <th>Nama</th>
                    <th>Program</th>
                    <th>Kelas</th>
                    <th>Semester</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($courses as $c)
                <tr>
                    <td>{{ $c->code }}</td>
                    <td>{{ $c->name }}</td>
                    <td>{{ $c->program }}</td>
                    <td>{{ $c->grade_level }}</td>
                    <td>{{ $c->semester }}</td>
                    <td class="text-nowrap">
                        <a href="{{ route('courses.edit', $c) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('courses.destroy', $c) }}" method="POST" class="d-inline">
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
<div class="mt-3">{{ $courses->links() }}</div>
@endsection