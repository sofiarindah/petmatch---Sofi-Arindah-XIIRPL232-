<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PembayaranController extends Controller
{
    // Tampilkan semua pembayaran user
    public function index()
    {
        $pembayaran = Pembayaran::where('user_id', Auth::id())->latest()->get();
        return view('user.pembayaran.index', compact('pembayaran'));
    }

    // Form tambah pembayaran
    public function create()
    {
        return view('user.pembayaran.create');
    }

    // Simpan pembayaran baru
    public function store(Request $request)
    {
        $request->validate([
            'jumlah' => 'required|integer',
            'bukti' => 'nullable|image|max:2048',
        ]);

        $buktiPath = null;
        if ($request->hasFile('bukti')) {
            $buktiPath = $request->file('bukti')->store('bukti_pembayaran', 'public');
        }

        Pembayaran::create([
            'user_id' => Auth::id(),
            'kode_pembayaran' => 'PAY-' . Str::upper(Str::random(8)),
            'jumlah' => $request->jumlah,
            'bukti' => $buktiPath,
            'status' => 'pending',
        ]);

        return redirect()->route('user-pembayaran.index')->with('success', 'Pembayaran berhasil dibuat.');
    }

    // Form edit pembayaran
    public function edit(Pembayaran $pembayaran)
    {
        $this->authorize('update', $pembayaran);
        return view('user.pembayaran.edit', compact('pembayaran'));
    }

    // Update pembayaran
    public function update(Request $request, Pembayaran $pembayaran)
    {
        $this->authorize('update', $pembayaran);

        $request->validate([
            'jumlah' => 'required|integer',
            'bukti' => 'nullable|image|max:2048',
            'status' => 'required|in:pending,diterima,ditolak',
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

    // Hapus pembayaran
    public function destroy(Pembayaran $pembayaran)
    {
        $this->authorize('delete', $pembayaran);
        $pembayaran->delete();
        return redirect()->route('user-pembayaran.index')->with('success', 'Pembayaran berhasil dihapus.');
    }
}
