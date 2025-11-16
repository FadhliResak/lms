@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between">
        <div>
            <div class="fw-bold">{{ $message->subject }}</div>
            <div class="text-muted">Dari: {{ $message->from->name ?? '-' }} • Kepada: {{ $message->to->name ?? '-' }}</div>
        </div>
        <form method="POST" action="{{ route('messages.destroy', $message) }}">
            @csrf
            @method('DELETE')
            <button class="btn btn-sm btn-danger">Hapus</button>
        </form>
    </div>
    <div class="card-body">
        {!! nl2br(e($message->body)) !!}
    </div>
</div>
@endsection