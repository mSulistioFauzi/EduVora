<?php

namespace App\Http\Controllers;

use App\Models\M_MataPelajaran;
use App\Models\M_ProfilRelawan;
use App\Models\KeahlianRelawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class C_ProfilRelawan extends Controller
{
    // Menampilkan halaman profil relawan
    public function index()
    {
        $user = auth()->user();

        // Ambil profil berdasarkan pengguna yang sedang login
        $profil = M_ProfilRelawan::with('keahlian')
            ->where('user_id', $user->id)
            ->first();

        // Ambil semua mata pelajaran
        $mataPelajaran = M_MataPelajaran::orderBy('nama_mata_pelajaran')->get();

        // Ambil ID mata pelajaran yang sudah dipilih
        $keahlianTerpilih = $profil
            ? $profil->keahlian->pluck('mata_pelajaran_id')->toArray()
            : [];

        return view('backend.relawan.profil', compact(
            'profil',
            'mataPelajaran',
            'keahlianTerpilih'
        ));
    }

    // Menyimpan atau memperbarui profil relawan
    public function simpan(Request $request)
    {
        $request->validate([
            'jenis_kelamin' => 'nullable|in:Laki-laki,Perempuan',
            'tanggal_lahir' => 'nullable|date',
            'alamat' => 'nullable|string',
            'pendidikan_terakhir' => 'nullable|string|max:100',
            'instansi_pendidikan' => 'nullable|string|max:255',
            'pengalaman_mengajar' => 'nullable|string',
            'deskripsi_diri' => 'nullable|string',

            'dokumen_identitas' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'dokumen_pendidikan' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',

            'mata_pelajaran_ids' => 'nullable|array',
            'mata_pelajaran_ids.*' => 'exists:mata_pelajaran,id',
        ]);

        $user = auth()->user();

        // Cari profil, jika belum ada maka buat baru
        $profil = M_ProfilRelawan::firstOrNew([
            'user_id' => $user->id
        ]);

        $data = $request->only([
            'jenis_kelamin',
            'tanggal_lahir',
            'alamat',
            'pendidikan_terakhir',
            'instansi_pendidikan',
            'pengalaman_mengajar',
            'deskripsi_diri',
        ]);

        // Simpan dokumen identitas jika ada file baru
        if ($request->hasFile('dokumen_identitas')) {
            $data['dokumen_identitas'] = $request
                ->file('dokumen_identitas')
                ->store('dokumen/relawan', 'public');
        }

        // Simpan dokumen pendidikan jika ada file baru
        if ($request->hasFile('dokumen_pendidikan')) {
            $data['dokumen_pendidikan'] = $request
                ->file('dokumen_pendidikan')
                ->store('dokumen/relawan', 'public');
        }

        DB::transaction(function () use ($profil, $data, $request) {

            // Simpan data profil
            $profil->fill($data);
            $profil->save();

            // Hapus keahlian lama
            $profil->keahlian()->delete();

            // Simpan keahlian yang dipilih
            $mataPelajaranIds = array_unique(
                $request->input('mata_pelajaran_ids', [])
            );

            foreach ($mataPelajaranIds as $id) {
                $profil->keahlian()->create([
                    'mata_pelajaran_id' => $id,
                ]);
            }
        });

        return redirect()
            ->route('relawan.profil')
            ->with('success', 'Profil relawan berhasil disimpan.');
    }
}
