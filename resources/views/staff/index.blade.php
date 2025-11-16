@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h5>Data Kepegawaian</h5>
    <a href="{{ route('staff.create') }}" class="btn btn-primary">Tambah</a>
</div>
<div class="card">
    <div class="card-body p-0">
        <table class="table mb-0">
            <thead>
                <tr>
                    <th>NIP</th>
                    <th>Nama</th>
                    <th>Jabatan</th>
                    <th>Jenis</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($staff as $p)
                <tr>
                    <td>{{ $p->nip }}</td>
                    <td>{{ $p->name }}</td>
                    <td>{{ $p->position }}</td>
                    <td>{{ $p->type }}</td>
                    <td class="text-nowrap">
                        <a href="{{ route('staff.edit', $p) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('staff.destroy', $p) }}" method="POST" class="d-inline">
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
<div class="mt-3">{{ $staff->links() }}</div>
@endsection