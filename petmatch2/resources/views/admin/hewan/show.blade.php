@extends('admin.layouts.app')

@section('content')
<div class="card">
    <div class="card-body">
        <h5 class="card-title fw-semibold mb-4">Detail Hewan</h5>

        <div class="text-center mb-3">
            @if ($item->foto)
                <img src="{{ asset('storage/'.$item->foto) }}"
                     style="max-width:260px;border-radius:8px;">
            @else
                <span class="text-muted">Tidak ada foto</span>
            @endif
        </div>

        <dl class="row">
            <dt class="col-4">Nama</dt>
            <dd class="col-8">{{ $item->nama }}</dd>

            <dt class="col-4">Jenis</dt>
            <dd class="col-8">{{ $item->jenis }}</dd>

            <dt class="col-4">Umur</dt>
            <dd class="col-8">{{ $item->umur }} tahun</dd>

            <dt class="col-4">Kondisi</dt>
            <dd class="col-8">{{ $item->kondisi }}</dd>

            <dt class="col-4">Status</dt>
            <dd class="col-8">{{ $item->status }}</dd>

            <dt class="col-4">Deskripsi</dt>
            <dd class="col-8">{{ $item->deskripsi }}</dd>
        </dl>

        <a href="{{ route('admin.hewan.index') }}" class="btn btn-primary">
            Kembali
        </a>
    </div>
</div>
@endsection
