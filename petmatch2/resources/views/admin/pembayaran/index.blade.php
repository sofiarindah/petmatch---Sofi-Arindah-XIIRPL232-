@extends('admin.layouts.app')

@section('content')
<div class="container py-4">

    
    <h4 class="mb-3">Data Pembayaran</h4>

    <div class="card">
        <div class="card-body">

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>User</th>
                        <th>Kode</th>
                        <th>Jumlah</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($pembayarans as $p)
                    <tr>
                        <td>{{ $p->user->name }}</td>
                        <td>{{ $p->kode_pembayaran }}</td>
                        <td>Rp {{ number_format($p->jumlah) }}</td>
                        <td>
                            <span class="badge bg-{{ 
                                $p->status == 'pending' ? 'warning' :
                                ($p->status == 'diterima' ? 'success' : 'danger')
                            }}">
                                {{ ucfirst($p->status) }}
                            </span>
                        </td>
                        <td>
                            @if($p->status == 'pending')
                                <form method="POST"
                                      action="{{ route('admin.pembayaran.terima', $p->id) }}"
                                      class="d-inline">
                                    @csrf
                                    <button class="btn btn-success btn-sm">Terima</button>
                                </form>

                                <form method="POST"
                                      action="{{ route('admin.pembayaran.tolak', $p->id) }}"
                                      class="d-inline">
                                    @csrf
                                    <button class="btn btn-danger btn-sm">Tolak</button>
                                </form>
                            @else
                                <span class="text-muted">Selesai</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>
    </div>
</div>
@endsection
