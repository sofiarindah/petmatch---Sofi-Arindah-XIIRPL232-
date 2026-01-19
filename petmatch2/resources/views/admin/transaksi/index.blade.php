@extends('admin.layouts.app')

@section('content')
<h4>Data Transaksi</h4>

<table border="1" width="100%">
    <tr>
        <th>User</th>
        <th>Kode</th>
        <th>Total</th>
        <th>Status</th>
        <th>Aksi</th>
    </tr>
    @foreach($transactions as $trx)
    <tr>
        <td>{{ $trx->user->name }}</td>
        <td>{{ $trx->kode_transaksi }}</td>
        <td>Rp {{ number_format($trx->total) }}</td>
        <td>{{ $trx->status }}</td>
        <td>
            @if($trx->status == 'diajukan')
            <form method="POST" action="{{ route('admin.transaksi.terima', $trx->id) }}" style="display:inline">
                @csrf
                <button>Terima</button>
            </form>
            <form method="POST" action="{{ route('admin.transaksi.tolak', $trx->id) }}" style="display:inline">
                @csrf
                <button>Tolak</button>
            </form>
            @endif
        </td>
    </tr>
    @endforeach
</table>
@endsection
