@extends('user.layouts.side')

@section('content')
<div class="container">
    <h4 class="mb-3">Pembayaran Saya</h4>
    <a href="{{ route('user-pembayaran.create') }}" class="btn btn-primary mb-3">Tambah Pembayaran</a>

    @if($pembayaran->count())
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Kode</th>
                    <th>Jumlah</th>
                    <th>Bukti</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pembayaran as $p)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $p->kode_pembayaran }}</td>
                    <td>Rp {{ number_format($p->jumlah) }}</td>
                    <td>
                        @if($p->bukti)
                            <img src="{{ asset('storage/' . $p->bukti) }}" width="100" alt="Bukti">
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        @php
                            $color = match($p->status) {
                                'pending' => 'warning',
                                'diterima' => 'success',
                                'ditolak' => 'danger',
                                default => 'secondary',
                            };
                        @endphp
                        <span class="badge bg-{{ $color }}">{{ ucfirst($p->status) }}</span>
                    </td>
                    <td>{{ $p->created_at->format('d M Y') }}</td>
                    <td>
                        {{-- <a href="{{ route('user-pembayaran.edit', $p->id) }}" class="btn btn-sm btn-warning">Edit</a> --}}
                        <form action="{{ route('user-pembayaran.destroy', $p->id) }}" method="POST" style="display:inline-block">
                            @csrf
                            @method('DELETE')
                            
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="alert alert-info">
            Belum ada pembayaran.
        </div>
    @endif
</div>
@endsection
