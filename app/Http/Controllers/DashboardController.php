<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\Jabatan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display the dashboard.
     */
    public function index()
    {
        $totalPegawai = Pegawai::count();
        $totalGuru = Pegawai::where('status_pegawai', 'Guru')->count();
        $totalAdministrasi = Pegawai::where('status_pegawai', 'Tenaga Administrasi')->count();
        $totalStaf = Pegawai::where('status_pegawai', 'Staf Pendukung')->count();
        $totalJabatan = Jabatan::count();

        // Data for Chart.js: Pegawai per Jabatan
        $jabatans = Jabatan::withCount('pegawais')->get();
        $chartJabatanLabels = $jabatans->pluck('nama_jabatan')->toArray();
        $chartJabatanData = $jabatans->pluck('pegawais_count')->toArray();

        // Data for Chart.js: Status Pegawai
        $chartStatusLabels = ['Guru', 'Tenaga Administrasi', 'Staf Pendukung'];
        $chartStatusData = [
            $totalGuru,
            $totalAdministrasi,
            $totalStaf
        ];

        return view('dashboard', compact(
            'totalPegawai',
            'totalGuru',
            'totalAdministrasi',
            'totalStaf',
            'totalJabatan',
            'chartJabatanLabels',
            'chartJabatanData',
            'chartStatusLabels',
            'chartStatusData'
        ));
    }
}
