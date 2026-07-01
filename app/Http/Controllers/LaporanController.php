<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\Jabatan;
use App\Models\RiwayatPekerjaan;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class LaporanController extends Controller
{
    /**
     * Display a listing of reports with filters.
     */
    public function index(Request $request)
    {
        $jabatans = Jabatan::all();

        $pegawaiQuery = Pegawai::with('jabatan');

        if ($request->filled('status_pegawai')) {
            $pegawaiQuery->where('status_pegawai', $request->status_pegawai);
        }

        if ($request->filled('jabatan_id')) {
            $pegawaiQuery->where('jabatan_id', $request->jabatan_id);
        }

        $pegawais = $pegawaiQuery->latest()->get();

        // Get Riwayat Pekerjaan of filtered pegawais
        $pegawaiIds = $pegawais->pluck('id')->toArray();
        $riwayats = RiwayatPekerjaan::with('pegawai')
            ->whereIn('pegawai_id', $pegawaiIds)
            ->latest()
            ->get();

        return view('laporan.index', compact('jabatans', 'pegawais', 'riwayats'));
    }

    /**
     * Export the filtered report as a PDF.
     */
    public function cetakPdf(Request $request)
    {
        $pegawaiQuery = Pegawai::with('jabatan');

        $filterStatus = $request->status_pegawai ?? 'Semua';
        $filterJabatanId = $request->jabatan_id;
        $filterJabatanName = 'Semua Jabatan';

        if ($request->filled('status_pegawai')) {
            $pegawaiQuery->where('status_pegawai', $request->status_pegawai);
        }

        if ($request->filled('jabatan_id')) {
            $pegawaiQuery->where('jabatan_id', $filterJabatanId);
            $jab = Jabatan::find($filterJabatanId);
            if ($jab) {
                $filterJabatanName = $jab->nama_jabatan;
            }
        }

        $pegawais = $pegawaiQuery->get();
        $pegawaiIds = $pegawais->pluck('id')->toArray();
        
        $riwayats = RiwayatPekerjaan::with('pegawai')
            ->whereIn('pegawai_id', $pegawaiIds)
            ->latest()
            ->get();

        $tanggalCetak = Carbon::now()->locale('id')->translatedFormat('d F Y');

        $pdf = Pdf::loadView('laporan.pdf', compact(
            'pegawais',
            'riwayats',
            'filterStatus',
            'filterJabatanName',
            'tanggalCetak'
        ))->setPaper('a4', 'landscape');

        return $pdf->stream('Laporan_Kepegawaian_' . Carbon::now()->format('YmdHis') . '.pdf');
    }
}
