<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\Jabatan;
use App\Models\RiwayatPekerjaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Pegawai::with('jabatan');

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama_lengkap', 'like', "%{$search}%")
                  ->orWhere('nip', 'like', "%{$search}%")
                  ->orWhereHas('jabatan', function ($jq) use ($search) {
                      $jq->where('nama_jabatan', 'like', "%{$search}%");
                  });
            });
        }

        // Filter Jabatan
        if ($request->filled('jabatan_id')) {
            $query->where('jabatan_id', $request->jabatan_id);
        }

        // Filter Status
        if ($request->filled('status_pegawai')) {
            $query->where('status_pegawai', $request->status_pegawai);
        }

        $pegawais = $query->latest()->paginate(10)->withQueryString();
        $jabatans = Jabatan::all();

        return view('pegawai.index', compact('pegawais', 'jabatans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $jabatans = Jabatan::all();
        return view('pegawai.create', compact('jabatans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nip' => 'required|string|unique:pegawais,nip|max:50',
            'nama_lengkap' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string',
            'no_hp' => 'required|numeric',
            'email' => 'required|email|unique:pegawais,email|max:255',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'status_pegawai' => 'required|in:Guru,Tenaga Administrasi,Staf Pendukung',
            'jabatan_id' => 'required|exists:jabatans,id',
        ], [
            'nip.required' => 'NIP wajib diisi.',
            'nip.unique' => 'NIP sudah digunakan.',
            'nama_lengkap.required' => 'Nama lengkap wajib diisi.',
            'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih.',
            'tempat_lahir.required' => 'Tempat lahir wajib diisi.',
            'tanggal_lahir.required' => 'Tanggal lahir wajib diisi.',
            'alamat.required' => 'Alamat wajib diisi.',
            'no_hp.required' => 'No HP wajib diisi.',
            'no_hp.numeric' => 'No HP harus berupa angka.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',
            'foto.image' => 'File foto harus berupa gambar.',
            'foto.mimes' => 'Format foto harus berupa JPG, JPEG, atau PNG.',
            'foto.max' => 'Ukuran foto maksimal adalah 2MB.',
            'status_pegawai.required' => 'Status pegawai wajib diisi.',
            'jabatan_id.required' => 'Jabatan wajib diisi.',
        ]);

        $data = $request->all();

        // Handle File Upload
        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('foto_pegawai', 'public');
        }

        $pegawai = Pegawai::create($data);

        // Record Initial Job History
        RiwayatPekerjaan::create([
            'pegawai_id' => $pegawai->id,
            'jabatan_lama' => null,
            'jabatan_baru' => $pegawai->jabatan->nama_jabatan,
            'tanggal_perubahan' => Carbon::now(),
            'keterangan' => 'Pengangkatan Pertama Pegawai Baru',
        ]);

        return redirect()->route('pegawai.index')->with('success', 'Pegawai berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pegawai $pegawai)
    {
        $pegawai->load('jabatan', 'riwayatPekerjaans');
        return view('pegawai.show', compact('pegawai'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pegawai $pegawai)
    {
        $jabatans = Jabatan::all();
        return view('pegawai.edit', compact('pegawai', 'jabatans'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pegawai $pegawai)
    {
        $request->validate([
            'nip' => 'required|string|max:50|unique:pegawais,nip,' . $pegawai->id,
            'nama_lengkap' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string',
            'no_hp' => 'required|numeric',
            'email' => 'required|email|max:255|unique:pegawais,email,' . $pegawai->id,
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'status_pegawai' => 'required|in:Guru,Tenaga Administrasi,Staf Pendukung',
            'jabatan_id' => 'required|exists:jabatans,id',
        ], [
            'nip.required' => 'NIP wajib diisi.',
            'nip.unique' => 'NIP sudah digunakan.',
            'nama_lengkap.required' => 'Nama lengkap wajib diisi.',
            'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih.',
            'tempat_lahir.required' => 'Tempat lahir wajib diisi.',
            'tanggal_lahir.required' => 'Tanggal lahir wajib diisi.',
            'alamat.required' => 'Alamat wajib diisi.',
            'no_hp.required' => 'No HP wajib diisi.',
            'no_hp.numeric' => 'No HP harus berupa angka.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',
            'foto.image' => 'File foto harus berupa gambar.',
            'foto.mimes' => 'Format foto harus berupa JPG, JPEG, atau PNG.',
            'foto.max' => 'Ukuran foto maksimal adalah 2MB.',
            'status_pegawai.required' => 'Status pegawai wajib diisi.',
            'jabatan_id.required' => 'Jabatan wajib diisi.',
        ]);

        $oldJabatanId = $pegawai->jabatan_id;
        $newJabatanId = $request->jabatan_id;
        $data = $request->all();

        // Handle File Upload
        if ($request->hasFile('foto')) {
            // Delete old photo if exists
            if ($pegawai->foto && Storage::disk('public')->exists($pegawai->foto)) {
                Storage::disk('public')->delete($pegawai->foto);
            }
            $data['foto'] = $request->file('foto')->store('foto_pegawai', 'public');
        }

        $pegawai->update($data);

        // Auto Log Job History if Jabatan Changes
        if ($oldJabatanId != $newJabatanId) {
            $oldJabatan = Jabatan::find($oldJabatanId);
            $newJabatan = Jabatan::find($newJabatanId);

            RiwayatPekerjaan::create([
                'pegawai_id' => $pegawai->id,
                'jabatan_lama' => $oldJabatan ? $oldJabatan->nama_jabatan : null,
                'jabatan_baru' => $newJabatan->nama_jabatan,
                'tanggal_perubahan' => Carbon::now(),
                'keterangan' => 'Mutasi Jabatan (Perubahan Sistem)',
            ]);
        }

        return redirect()->route('pegawai.index')->with('success', 'Pegawai berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pegawai $pegawai)
    {
        // Delete photo if exists
        if ($pegawai->foto && Storage::disk('public')->exists($pegawai->foto)) {
            Storage::disk('public')->delete($pegawai->foto);
        }

        $pegawai->delete();

        return redirect()->route('pegawai.index')->with('success', 'Pegawai berhasil dihapus.');
    }
}
