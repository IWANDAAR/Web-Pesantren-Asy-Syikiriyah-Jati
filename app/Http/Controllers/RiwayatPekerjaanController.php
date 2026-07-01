<?php

namespace App\Http\Controllers;

use App\Models\RiwayatPekerjaan;
use App\Models\Pegawai;
use Illuminate\Http\Request;

class RiwayatPekerjaanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $riwayats = RiwayatPekerjaan::with('pegawai')->latest()->get();
        return view('riwayat.index', compact('riwayats'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pegawais = Pegawai::all();
        return view('riwayat.create', compact('pegawais'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'pegawai_id' => 'required|exists:pegawais,id',
            'jabatan_lama' => 'nullable|string|max:255',
            'jabatan_baru' => 'required|string|max:255',
            'tanggal_perubahan' => 'required|date',
            'keterangan' => 'nullable|string',
        ], [
            'pegawai_id.required' => 'Pegawai wajib dipilih.',
            'pegawai_id.exists' => 'Pegawai tidak valid.',
            'jabatan_baru.required' => 'Jabatan baru wajib diisi.',
            'tanggal_perubahan.required' => 'Tanggal perubahan wajib diisi.',
        ]);

        RiwayatPekerjaan::create($request->all());

        return redirect()->route('riwayat.index')->with('success', 'Riwayat pekerjaan berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RiwayatPekerjaan $riwayat)
    {
        $pegawais = Pegawai::all();
        return view('riwayat.edit', compact('riwayat', 'pegawais'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RiwayatPekerjaan $riwayat)
    {
        $request->validate([
            'pegawai_id' => 'required|exists:pegawais,id',
            'jabatan_lama' => 'nullable|string|max:255',
            'jabatan_baru' => 'required|string|max:255',
            'tanggal_perubahan' => 'required|date',
            'keterangan' => 'nullable|string',
        ], [
            'pegawai_id.required' => 'Pegawai wajib dipilih.',
            'pegawai_id.exists' => 'Pegawai tidak valid.',
            'jabatan_baru.required' => 'Jabatan baru wajib diisi.',
            'tanggal_perubahan.required' => 'Tanggal perubahan wajib diisi.',
        ]);

        $riwayat->update($request->all());

        return redirect()->route('riwayat.index')->with('success', 'Riwayat pekerjaan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RiwayatPekerjaan $riwayat)
    {
        $riwayat->delete();
        return redirect()->route('riwayat.index')->with('success', 'Riwayat pekerjaan berhasil dihapus.');
    }
}
