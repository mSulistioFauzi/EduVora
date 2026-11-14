<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class C_VerifikasiAkun extends Controller
{
    // Menampilkan daftar akun relawan dan mitra
    public function index(Request $request)
    {
        $akun = User::with(['profilRelawan', 'profilMitra'])
            ->whereIn('peran', ['relawan', 'mitra'])
            ->when($request->cari, function ($query, $cari) {
                $query->where(function ($q) use ($cari) {
                    $q->where('name', 'like', "%{$cari}%")
                        ->orWhere('email', 'like', "%{$cari}%");
                });
            })->when($request->status, function ($query, $status) {
                $query->where('status_akun', $status);
            })->latest()->paginate(10)->withQueryString();

        return view('backend.admin.verifikasi.index', compact('akun'));
    }

    // Menampilkan detail akun yang akan diperiksa
    public function detail($id)
    {
        $akun = User::with(['profilRelawan', 'profilMitra'])
            ->whereIn('peran', ['relawan', 'mitra'])
            ->findOrFail($id);

        return view('backend.admin.verifikasi.detail', compact('akun'));
    }

    // Memperbarui status akun
    public function perbaruiStatus(Request $request, $id)
    {
        $request->validate([
            'status_akun' => 'required|in:terverifikasi,perlu_perbaikan,ditolak',
        ]);

        $akun = User::whereIn('peran', ['relawan', 'mitra'])
            ->findOrFail($id);

        $akun->update([
            'status_akun' => $request->status_akun,
        ]);

        return redirect()
            ->route('admin.verifikasi.detail', $akun->id)
            ->with('success', 'Status akun berhasil diperbarui.');
    }
}
