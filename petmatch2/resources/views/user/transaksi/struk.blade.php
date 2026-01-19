@extends('user.layouts.side')

@section('content')
<div class="max-w-md mx-auto mt-10 bg-white text-gray-800 rounded-lg shadow-lg p-6">

    {{-- HEADER --}}
    <div class="text-center border-b pb-4 mb-4">
        <h1 class="text-xl font-bold uppercase">Struk Transaksi</h1>
        <p class="text-sm text-gray-500">Bukti Pembayaran Resmi</p>
    </div>

    {{-- INFO APLIKASI --}}
    <div class="text-sm space-y-1 mb-4 text-center">
        <p class="font-semibold text-lg">
            Sistem Pembayaran
        </p>
        <p class="text-gray-500">
            Transaksi User
        </p>
    </div>

    <hr class="my-4">

    {{-- DETAIL TRANSAKSI --}}
    <div class="text-sm space-y-2 font-mono">

        <div class="grid grid-cols-[90px_10px_1fr]">
            <span>Nama</span>
            <span>:</span>
            <span>{{ auth()->user()->name }}</span>
        </div>

        <div class="grid grid-cols-[90px_10px_1fr]">
            <span>Kode</span>
            <span>:</span>
            <span>{{ $transaction->kode_transaksi }}</span>
        </div>

        <div class="grid grid-cols-[90px_10px_1fr]">
            <span>Tanggal</span>
            <span>:</span>
            <span>{{ $transaction->created_at->format('d-m-Y H:i') }}</span>
        </div>

        <div class="grid grid-cols-[90px_10px_1fr]">
            <span>Status</span>
            <span>:</span>
            <span class="
                font-semibold
                @if($transaction->status == 'diterima') text-green-600
                @elseif($transaction->status == 'pending') text-yellow-600
                @else text-red-600
                @endif
            ">
                {{ strtoupper($transaction->status) }}
            </span>
        </div>

    </div>

    <hr class="my-4">

    {{-- TOTAL --}}
    <div class="grid grid-cols-[1fr_auto] text-lg font-bold">
        <span>Total Bayar</span>
        <span class="text-green-600">
            Rp {{ number_format($transaction->total, 0, ',', '.') }}
        </span>
    </div>

    {{-- FOOTER --}}
    <div class="text-center text-xs text-gray-500 mt-6">
        <p>Terima kasih telah melakukan pembayaran</p>
        <p>Harap simpan struk ini sebagai bukti</p>
    </div>

    {{-- BUTTON --}}
    <div class="mt-6 flex gap-2 no-print">
        <a href="{{ route('user.transaksi.index') }}"
           class="w-full text-center bg-gray-200 hover:bg-gray-300 text-gray-800 py-2 rounded font-semibold">
            Kembali
        </a>

        <button onclick="window.print()"
           class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 rounded font-semibold">
            Cetak
        </button>
    </div>

</div>
@endsection
