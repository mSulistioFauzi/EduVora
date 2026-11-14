<?php

namespace App\Http\Controllers;

use App\Models\M_PengajuanBantuan;
use App\Models\M_ProfilMitra;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Storage;

class C_PengajuanBantuan extends Controller
{
    public function index()
    {
        $profil = M_ProfilMitra::where('user_id', auth()->id())->first();

        if (!$profil) {
            return redirect()
                ->route('mitra.profil')
                ->with('error', 'Lengkapi profil organisasi terlebih dahulu.');
        }

        $pengajuan = M_PengajuanBantuan::where('profil_mitra_id', $profil->id)
            ->latest()
            ->paginate(10);

        return view('backend.mitra.pengajuan.index', compact('pengajuan'));
    }

    public function create()
    {
        $profil = M_ProfilMitra::where('user_id', auth()->id())->first();

        if (!$profil) {
            return redirect()
                ->route('mitra.profil')
                ->with('error', 'Lengkapi profil organisasi terlebih dahulu.');
        }

        return view('backend.mitra.pengajuan.create');
    }

    public function store(Request $request)
    {
        $profil = M_ProfilMitra::where('user_id', auth()->id())->first();

        if (!$profil) {
            return redirect()
                ->route('mitra.profil')
                ->with('error', 'Lengkapi profil organisasi terlebih dahulu.');
        }

        $data = $request->validate([
            'judul_pengajuan' => 'required|string|max:255',
            'deskripsi_kondisi' => 'required|string',
            'jumlah_anak' => 'required|integer|min:1',
            'jenjang_pendidikan' => 'required|string|max:100',
            'fasilitas_tersedia' => 'nullable|string',
            'waktu_yang_diharapkan' => 'nullable|string|max:255',
            'foto_pendukung' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('foto_pendukung')) {
            $data['foto_pendukung'] = $request->file('foto_pendukung')
                ->store('pengajuan-bantuan', 'public');
        }

        $data['profil_mitra_id'] = $profil->id;
        $data['status_pengajuan'] = 'menunggu';

        M_PengajuanBantuan::create($data);

        return redirect()
            ->route('mitra.pengajuan.index')
            ->with('success', 'Pengajuan bantuan berhasil dikirim dan sedang menunggu pemeriksaan admin.');
    }

    public function detail($id)
    {
        $profil = M_ProfilMitra::where('user_id', auth()->id())->firstOrFail();

        $pengajuan = M_PengajuanBantuan::where('profil_mitra_id', $profil->id)
            ->findOrFail($id);

        return view('backend.mitra.pengajuan.detail', compact('pengajuan'));
    }
}
