@extends('user.layouts.side')

@section('content')
<div class="container mt-5">
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if($detail)
        <div class="card p-4">
            <h2>{{ $detail->nama ?? 'Nama Hewan Tidak Tersedia' }}</h2>
            
            {{-- Gambar hewan --}}
            <img src="{{ $detail->foto ? asset('photos/'.$detail->foto) : asset('images/default.jpg') }}" 
                 alt="{{ $detail->nama ?? 'Foto Hewan' }}" 
                 class="img-fluid mb-3">

            <p><strong>Jenis:</strong> {{ $detail->jenis ?? '-' }}</p>
            <p><strong>Umur:</strong> {{ $detail->umur ?? '-' }}</p>
            <p><strong>Deskripsi:</strong> {{ $detail->deskripsi ?? '-' }}</p>
        </div>
    @else
        <p>Detail hewan tidak tersedia.</p>
    @endif
</div>
@endsection
