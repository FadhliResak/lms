@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h5>Data Siswa</h5>
    <div class="d-flex gap-2">
        <form method="GET" action="{{ route('students.index') }}" class="d-flex gap-2">
            <input type="text" name="q" value="{{ $q }}" class="form-control" placeholder="Cari nama/NISN/kelas">
            <select name="program" class="form-select">
                <option value="">Semua Program</option>
                @foreach($programs as $p)
                    <option value="{{ $p }}" @if($program === $p) selected @endif>{{ $p }}</option>
                @endforeach
            </select>
            <button class="btn btn-secondary" type="submit">Filter</button>
        </form>
        <a href="{{ route('students.create') }}" class="btn btn-primary">Tambah</a>
        <a href="{{ route('students.export') }}" class="btn btn-outline-primary">Export CSV</a>
        <form method="POST" action="{{ route('students.import') }}" enctype="multipart/form-data">
            @csrf
            <input type="file" name="file" class="form-control" required>
            <button class="btn btn-outline-secondary" type="submit">Import CSV</button>
        </form>
    </div>
    </div>
<div class="card">
    <div class="card-body p-0">
        <table class="table mb-0">
            <thead>
                <tr>
                    <th>NISN</th>
                    <th>Nama</th>
                    <th>Program</th>
                    <th>Kelas</th>
                    <th>Masuk</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($students as $s)
                <tr>
                    <td>{{ $s->nisn }}</td>
                    <td>{{ $s->name }}</td>
                    <td>{{ $s->program }}</td>
                    <td>{{ $s->class }}</td>
                    <td>{{ $s->year_of_entry }}</td>
                    <td class="text-nowrap">
                        <a href="{{ route('students.edit', $s) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('students.destroy', $s) }}" method="POST" class="d-inline">
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
<div class="mt-3">{{ $students->links() }}</div>
@endsection