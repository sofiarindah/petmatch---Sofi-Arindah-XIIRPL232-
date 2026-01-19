@extends('user.layouts.side')

@section('content')
<h4>Transaksi Saya</h4>

<form method="POST" action="{{ route('user.transaksi.store') }}">
    @csrf
    <input type="number" name="total" placeholder="Total pembayaran" required>
    <button type="submit">Bayar</button>
</form>

<hr>

<table border="1" width="100%">
    <tr>
        <th>Kode</th>
        <th>Total</th>
        <th>Status</th>
        <th>Nota</th>
    </tr>
    @forelse($transactions as $trx)
    <tr>
        <td>{{ $trx->kode_transaksi }}</td>
        <td>Rp {{ number_format($trx->total) }}</td>
        <td>{{ ucfirst($trx->status) }}</td>
        <td>
            <a href="{{ route('user.transaksi.nota', $trx->id) }}">
                Lihat Nota
            </a>
        </td>
    </tr>
    @empty
    <tr>
        <td colspan="4" align="center">Belum ada transaksi</td>
    </tr>
    @endforelse
</table>
@endsection
