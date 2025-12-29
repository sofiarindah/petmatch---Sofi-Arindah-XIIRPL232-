@extends('admin.layouts.app')

@section('content')
<div class="container">

    <h2 class="mb-4 fw-bold" style="color:#6e4c2e;">Kelola Permintaan Adopsi</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm p-4" style="border-radius: 15px;">
        <table class="table table-striped">
            <thead style="background: #f4d9bd;">
                <tr>
                    <th>No</th>
                    <th>Nama User</th>
                    <th>Nama Hewan</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($permintaan as $p)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $p->user->nama }}</td>
                    <td>{{ $p->hewan->nama }}</td>
                    <td>
                        <span class="badge 
                            @if($p->status == 'pending') bg-warning
                            @elseif($p->status == 'diterima') bg-success
                            @elseif($p->status == 'ditolak') bg-danger
                            @endif">
                            {{ ucfirst($p->status) }}
                        </span>
                    </td>
                    <td>{{ $p->created_at->format('d M Y') }}</td>
                    <td>
                        <a href="{{ route('admin.permintaan.show', $p->id) }}" class="btn btn-sm btn-primary">
                            Detail
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center">Tidak ada permintaan</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection
