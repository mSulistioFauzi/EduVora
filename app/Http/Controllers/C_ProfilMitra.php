<?php

namespace App\Http\Controllers;

use App\Models\M_ProfilMitra;
use Illuminate\Http\Request;

class C_ProfilMitra extends Controller
{
    // Menampilkan halaman profil mitra
    public function index()
    {
        $user = auth()->user();

        // Ambil profil mitra berdasarkan pengguna yang login
        $profil = M_ProfilMitra::where('user_id', $user->id)
            ->first();

        return view('backend.mitra.profil', compact('profil'));
    }

    // Menyimpan atau memperbarui profil mitra
    public function simpan(Request $request)
    {
        $request->validate([
            'nama_organisasi' => 'nullable|string|max:255',
            'jabatan' => 'required|string|max:100',
            'nomor_telepon' => 'required|string|max:20',
            'alamat_wilayah' => 'required|string',
            'desa' => 'required|string|max:100',
            'kecamatan' => 'required|string|max:100',
            'kabupaten' => 'required|string|max:100',
            'provinsi' => 'required|string|max:100',

            'dokumen_pendukung' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        $user = auth()->user();

        // Cari profil mitra, jika belum ada maka buat baru
        $profil = M_ProfilMitra::firstOrNew([
            'user_id' => $user->id
        ]);

        $data = $request->only([
            'nama_organisasi',
            'jabatan',
            'nomor_telepon',
            'alamat_wilayah',
            'desa',
            'kecamatan',
            'kabupaten',
            'provinsi',
        ]);

        // Simpan dokumen jika ada file baru
        if ($request->hasFile('dokumen_pendukung')) {
            $data['dokumen_pendukung'] = $request
                ->file('dokumen_pendukung')
                ->store('dokumen/mitra', 'public');
        }

        $profil->fill($data);
        $profil->save();

        return redirect()
            ->route('mitra.profil')
            ->with('success', 'Profil mitra berhasil disimpan.');
    }
}
