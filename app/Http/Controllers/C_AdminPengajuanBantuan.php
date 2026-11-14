<?php

namespace App\Http\Controllers;

use App\Models\M_PengajuanBantuan;
use Illuminate\Http\Request;

class C_AdminPengajuanBantuan extends Controller
{
    public function index(Request $request)
    {
        $pengajuan = M_PengajuanBantuan::with('profilMitra.user')
            ->when($request->status, function ($query, $status) {
                $query->where('status_pengajuan', $status);
            })->latest()->paginate(10);

        return view('backend.admin.pengajuan.index', compact('pengajuan'));
    }

    public function detail($id)
    {
        $pengajuan = M_PengajuanBantuan::with('profilMitra.user')
            ->findOrFail($id);

        return view('backend.admin.pengajuan.detail', compact('pengajuan'));
    }

    public function perbaruiStatus(Request $request, $id)
    {
        $data = $request->validate([
            'status_pengajuan' => 'required|in:disetujui,ditolak',
            'catatan_admin' => 'nullable|string|max:2000',
        ]);

        $pengajuan = M_PengajuanBantuan::findOrFail($id);

        $pengajuan->update([
            'status_pengajuan' => $data['status_pengajuan'],
            'catatan_admin' => $data['catatan_admin'] ?? null,
            'diperiksa_pada' => now(),
        ]);

        return redirect()->route('admin.pengajuan.detail', $pengajuan->id)->with('success', 'Status pengajuan berhasil diperbarui.');
    }
}
