@extends('admin.layouts.app')

@section('content')

<div class="container">

    <h2 class="mb-4 fw-bold" style="color:#6e4c2e;">Detail Permintaan</h2>

    <div class="card p-4 shadow-sm" style="border-radius:15px;">

        <h4 class="fw-bold mb-3">{{ $permintaan->user->nama }}</h4>

        <p><strong>Hewan:</strong> {{ $permintaan->hewan->nama }}</p>
        <p><strong>Status:</strong> {{ ucfirst($permintaan->status) }}</p>
        <p><strong>Tanggal:</strong> {{ $permintaan->created_at->format('d M Y') }}</p>

        <div class="mt-4 d-flex gap-2">
            <form action="{{ route('admin.permintaan.setuju', $permintaan->id) }}" method="POST">
                @csrf
                <button class="btn btn-success">Setujui</button>
            </form>

            <form action="{{ route('admin.permintaan.tolak', $permintaan->id) }}" method="POST">
                @csrf
                <button class="btn btn-danger">Tolak</button>
            </form>

            <a href="{{ route('admin.permintaan.index') }}" class="btn btn-secondary">
                Kembali
            </a>
        </div>

    </div>

</div>

@endsection
