<?php

namespace App\Http\Controllers;

use App\Models\M_MataPelajaran;
use App\Models\M_PengajuanBantuan;
use App\Models\M_ProgramMengajar;
use Illuminate\Http\Request;

class C_AdminProgramMengajar extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $program = M_ProgramMengajar::with([
            'mataPelajaran',
            'pengajuan'
        ])->latest()->paginate(10);

        return view('backend.admin.program.index', compact('program'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pengajuan = M_PengajuanBantuan::where(
            'status_pengajuan',
            'disetujui'
        )
        ->whereDoesntHave('programMengajar')
        ->latest()
        ->get();

        $mataPelajaran = M_MataPelajaran::orderBy(
            'nama_mata_pelajaran'
        )->get();

        return view('backend.admin.program.create', compact(
            'pengajuan',
            'mataPelajaran'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'pengajuan_id' => 'nullable|exists:pengajuan_bantuan,id',
            'mata_pelajaran_id' => 'required|exists:mata_pelajaran,id',
            'nama_program' => 'required|string|max:255',
            'deskripsi_program' => 'nullable|string',
            'lokasi' => 'required|string',
            'jenjang_pendidikan' => 'required|string|max:100',
            'kuota_relawan' => 'required|integer|min:1',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
            'jam_mulai' => 'nullable|date_format:H:i',
            'jam_selesai' => 'nullable|date_format:H:i',
            'status_program' => 'required|in:draf,dibuka',
        ]);

        // Memastikan pengajuan yang dipilih sudah disetujui
        if (!empty($data['pengajuan_id'])) {
            $pengajuan = M_PengajuanBantuan::findOrFail(
                $data['pengajuan_id']
            );

            if ($pengajuan->status_pengajuan !== 'disetujui') {
                return back()
                    ->withInput()
                    ->withErrors([
                        'pengajuan_id' => 'Pengajuan belum disetujui.'
                    ]);
            }

            // Memastikan pengajuan belum digunakan
            if ($pengajuan->programMengajar()->exists()) {
                return back()
                    ->withInput()
                    ->withErrors([
                        'pengajuan_id' => 'Pengajuan sudah memiliki program.'
                    ]);
            }
        }

        // Mengisi ID admin yang sedang login
        $data['admin_id'] = auth()->id();

        M_ProgramMengajar::create($data);

        return redirect()
            ->route('admin.program.index')
            ->with('success', 'Program mengajar berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $program = M_ProgramMengajar::with([
            'mataPelajaran',
            'pengajuan',
            'admin'
        ])->findOrFail($id);

        return view('backend.admin.program.detail', compact('program'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
