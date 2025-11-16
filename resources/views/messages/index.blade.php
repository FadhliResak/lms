@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h5>Pesan Internal</h5>
    <a href="{{ route('messages.create') }}" class="btn btn-primary">Tulis Pesan</a>
</div>

<div class="row g-3">
    <div class="col-12 col-md-6">
        <div class="card">
            <div class="card-header">Kotak Masuk</div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table mb-0">
                    <thead>
                        <tr>
                            <th>Dari</th>
                            <th>Subjek</th>
                            <th>Diterima</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($inbox as $m)
                        <tr>
                            <td>{{ $m->from->name ?? '-' }}</td>
                            <td>{{ $m->subject }}</td>
                            <td>{{ $m->created_at }}</td>
                            <td><a href="{{ route('messages.show', $m) }}" class="btn btn-sm btn-outline-primary">Buka</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
            </div>
        </div>
        <div class="mt-2">{{ $inbox->links() }}</div>
    </div>
    <div class="col-12 col-md-6">
        <div class="card">
            <div class="card-header">Terkirim</div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table mb-0">
                    <thead>
                        <tr>
                            <th>Kepada</th>
                            <th>Subjek</th>
                            <th>Dikirim</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($sent as $m)
                        <tr>
                            <td>{{ $m->to->name ?? '-' }}</td>
                            <td>{{ $m->subject }}</td>
                            <td>{{ $m->created_at }}</td>
                            <td><a href="{{ route('messages.show', $m) }}" class="btn btn-sm btn-outline-primary">Buka</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
            </div>
        </div>
        <div class="mt-2">{{ $sent->links() }}</div>
    </div>
</div>
@endsection