<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Permintaan;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PembayaranController extends Controller
{
    // LIST DATA PEMBAYARAN USER
    public function index()
    {
        $pembayaran = Pembayaran::where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('user.pembayaran.index', compact('pembayaran'));
    }

    // FORM TAMBAH PEMBAYARAN
    public function create()
{
    $permintaans = Permintaan::with('hewan')
        ->where('user_id', auth()->id())
        ->where('status', 'diterima') // hanya yang disetujui admin
        ->get();

    return view('user.pembayaran.create', compact('permintaans'));
}

    // SIMPAN PEMBAYARAN
    public function store(Request $request)
    {
        $isDonation = $request->input('jenis') === 'donasi';

        $rules = [
            'metode_pembayaran' => 'required|in:tunai,transfer',
            'jumlah'            => 'required|integer|min:100000',
            'bukti'             => 'required_if:metode_pembayaran,transfer|mimes:jpg,jpeg,png,pdf|max:2048',
        ];
        if (!$isDonation) {
            $rules['permintaan_id'] = 'required|exists:permintaans,id';
        }
        $request->validate($rules);

        $buktiPath = null;
        if ($request->hasFile('bukti')) {
            $buktiPath = $request->file('bukti')->store('bukti_pembayaran', 'public');
        }

        $data = [
            'user_id'           => auth()->id(),
            'kode_pembayaran'   => 'PAY-' . strtoupper(Str::random(8)),
            'metode_pembayaran' => $request->metode_pembayaran,
            'jumlah'            => $request->jumlah,
            'status'            => 'diajukan',
        ];
        if ($buktiPath) {
            $data['bukti'] = $buktiPath;
        }
        if (!$isDonation) {
            $data['permintaan_id'] = $request->permintaan_id;
        }

        Pembayaran::create($data);

        return redirect()
            ->route('user-pembayaran.index')
            ->with('success', 'Pembayaran berhasil dikirim');
    }


    // DETAIL PEMBAYARAN
public function detail(Pembayaran $pembayaran)
{
    $pembayaran->load([
        'user',
        'permintaan.hewan' 
    ]);

    return view('user.pembayaran.detail', compact('pembayaran'));
}


    // NOTA PEMBAYARAN
   public function nota(Pembayaran $pembayaran)
{
    // pastikan eager load permintaan + hewan supaya tidak n+1
    $pembayaran->load('permintaan.hewan', 'user');

    return view('user.pembayaran.nota', compact('pembayaran'));
}

    // BUKTI TRANSFER (PRINTABLE)
    public function buktiTransfer(Pembayaran $pembayaran)
    {
        if ($pembayaran->user_id !== auth()->id()) {
            abort(403);
        }
        if ($pembayaran->metode_pembayaran !== 'transfer') {
            return redirect()
                ->route('user-pembayaran.detail', $pembayaran->id)
                ->with('error', 'Bukti transfer hanya tersedia untuk metode transfer.');
        }

        $pembayaran->load('permintaan.hewan', 'user');

        return view('user.pembayaran.bukti-transfer', compact('pembayaran'));
    }

public function update(Request $request, Pembayaran $pembayaran)
    {
        $this->authorize('update', $pembayaran);

        $request->validate([
            'jumlah' => 'required|integer|min:100000',
            'bukti' => 'nullable|image|max:2048',
            'status' => 'required|in:diajukan,diterima,ditolak',
        ]);

        if ($request->hasFile('bukti')) {
            $buktiPath = $request->file('bukti')->store('bukti_pembayaran', 'public');
            $pembayaran->bukti = $buktiPath;
        }

        $pembayaran->update([
            'jumlah' => $request->jumlah,
            'status' => $request->status,
        ]);

        return redirect()->route('user-pembayaran.index')->with('success', 'Pembayaran berhasil diperbarui.');
    }


    // HAPUS PEMBAYARAN
    public function destroy(Pembayaran $pembayaran)
    {
        if ($pembayaran->user_id !== auth()->id()) {
            abort(403);
        }

        $pembayaran->delete();

        return redirect()
            ->route('user-pembayaran.index')
            ->with('success', 'Pembayaran berhasil dihapus.');
    }


    
}
