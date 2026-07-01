<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use Illuminate\Http\Request;

class JabatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jabatans = Jabatan::all();
        return view('jabatan.index', compact('jabatans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('jabatan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_jabatan' => 'required|string|max:255|unique:jabatans,nama_jabatan',
            'deskripsi' => 'nullable|string',
        ], [
            'nama_jabatan.required' => 'Nama jabatan wajib diisi.',
            'nama_jabatan.unique' => 'Nama jabatan sudah terdaftar.',
        ]);

        Jabatan::create($request->all());

        return redirect()->route('jabatan.index')->with('success', 'Jabatan berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Jabatan $jabatan)
    {
        return view('jabatan.edit', compact('jabatan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Jabatan $jabatan)
    {
        $request->validate([
            'nama_jabatan' => 'required|string|max:255|unique:jabatans,nama_jabatan,' . $jabatan->id,
            'deskripsi' => 'nullable|string',
        ], [
            'nama_jabatan.required' => 'Nama jabatan wajib diisi.',
            'nama_jabatan.unique' => 'Nama jabatan sudah terdaftar.',
        ]);

        $jabatan->update($request->all());

        return redirect()->route('jabatan.index')->with('success', 'Jabatan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Jabatan $jabatan)
    {
        if ($jabatan->pegawais()->count() > 0) {
            return redirect()->route('jabatan.index')->with('error', 'Jabatan tidak dapat dihapus karena masih memiliki pegawai.');
        }

        $jabatan->delete();

        return redirect()->route('jabatan.index')->with('success', 'Jabatan berhasil dihapus.');
    }
}
