@extends('layouts.app')

@section('title', 'Laporan Kepegawaian')
@section('page_title', 'Laporan Kepegawaian')

@section('breadcrumb')
    <li class="breadcrumb-item active">Laporan Kepegawaian</li>
@endsection

@section('content')
    <!-- Filter Card -->
    <div class="card card-outline">
        <div class="card-header border-0">
            <h5 class="card-title font-weight-bold m-0"><i class="fas fa-filter mr-2 text-primary"></i>Filter Laporan</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('laporan.index') }}" method="GET" id="filterForm">
                <div class="row g-3 align-items-end">
                    <div class="col-md-4">
                        <label for="jabatan_id" class="form-label font-weight-bold text-secondary text-sm">Jabatan</label>
                        <select name="jabatan_id" id="jabatan_id" class="form-control">
                            <option value="">-- Semua Jabatan --</option>
                            @foreach($jabatans as $jabatan)
                                <option value="{{ $jabatan->id }}" {{ request('jabatan_id') == $jabatan->id ? 'selected' : '' }}>{{ $jabatan->nama_jabatan }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label for="status_pegawai" class="form-label font-weight-bold text-secondary text-sm">Status Pegawai</label>
                        <select name="status_pegawai" id="status_pegawai" class="form-control">
                            <option value="">-- Semua Status --</option>
                            <option value="Guru" {{ request('status_pegawai') == 'Guru' ? 'selected' : '' }}>Guru</option>
                            <option value="Tenaga Administrasi" {{ request('status_pegawai') == 'Tenaga Administrasi' ? 'selected' : '' }}>Tenaga Administrasi</option>
                            <option value="Staf Pendukung" {{ request('status_pegawai') == 'Staf Pendukung' ? 'selected' : '' }}>Staf Pendukung</option>
                        </select>
                    </div>

                    <div class="col-md-4 d-flex gap-2">
                        <button type="submit" class="btn btn-primary w-100"><i class="fas fa-search mr-2"></i>Tampilkan</button>
                        <button type="button" id="btnCetak" class="btn btn-success w-100"><i class="fas fa-file-pdf mr-2"></i>Cetak PDF</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Tampilan Laporan -->
    <div class="row mt-4">
        <!-- 1. Tabel Pegawai -->
        <div class="col-12 mb-4">
            <div class="card card-outline">
                <div class="card-header border-0">
                    <h5 class="card-title font-weight-bold m-0 text-dark"><i class="fas fa-users mr-2 text-primary"></i>Data Pegawai (Hasil Filter)</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light text-secondary text-sm">
                                <tr>
                                    <th class="px-4 py-3" style="width: 80px;">No</th>
                                    <th class="py-3">NIP</th>
                                    <th class="py-3">Nama Lengkap</th>
                                    <th class="py-3">Jenis Kelamin</th>
                                    <th class="py-3">Jabatan</th>
                                    <th class="py-3">Status</th>
                                    <th class="px-4 py-3">No HP</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($pegawais as $index => $pegawai)
                                    <tr>
                                        <td class="px-4 py-3 font-weight-bold">{{ $index + 1 }}</td>
                                        <td class="py-3 font-weight-bold">{{ $pegawai->nip }}</td>
                                        <td class="py-3">{{ $pegawai->nama_lengkap }}</td>
                                        <td class="py-3">{{ $pegawai->jenis_kelamin }}</td>
                                        <td class="py-3"><span class="badge bg-light text-dark border font-weight-bold">{{ $pegawai->jabatan->nama_jabatan }}</span></td>
                                        <td class="py-3">
                                            @if($pegawai->status_pegawai === 'Guru')
                                                <span class="badge bg-success-light text-white px-2 py-1">{{ $pegawai->status_pegawai }}</span>
                                            @elseif($pegawai->status_pegawai === 'Tenaga Administrasi')
                                                <span class="badge bg-warning-light text-white px-2 py-1">{{ $pegawai->status_pegawai }}</span>
                                            @else
                                                <span class="badge bg-info-light text-white px-2 py-1">{{ $pegawai->status_pegawai }}</span>
                                            @endif
                                        </td>
                                        <td class="px-4 py-3">{{ $pegawai->no_hp }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center py-4 text-muted">Tidak ada data pegawai yang memenuhi filter.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- 2. Tabel Riwayat Pekerjaan -->
        <div class="col-12">
            <div class="card card-outline">
                <div class="card-header border-0">
                    <h5 class="card-title font-weight-bold m-0 text-dark"><i class="fas fa-history mr-2 text-success"></i>Riwayat Pekerjaan (Hasil Filter)</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light text-secondary text-sm">
                                <tr>
                                    <th class="px-4 py-3" style="width: 80px;">No</th>
                                    <th class="py-3">Nama Pegawai</th>
                                    <th class="py-3">NIP</th>
                                    <th class="py-3">Jabatan Lama</th>
                                    <th class="py-3">Jabatan Baru</th>
                                    <th class="py-3">Tanggal Mutasi</th>
                                    <th class="px-4 py-3">Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($riwayats as $index => $riwayat)
                                    <tr>
                                        <td class="px-4 py-3 font-weight-bold">{{ $index + 1 }}</td>
                                        <td class="py-3 font-weight-bold">{{ $riwayat->pegawai->nama_lengkap }}</td>
                                        <td class="py-3">{{ $riwayat->pegawai->nip }}</td>
                                        <td class="py-3">
                                            @if($riwayat->jabatan_lama)
                                                <span class="text-secondary">{{ $riwayat->jabatan_lama }}</span>
                                            @else
                                                <span class="text-muted italic">- (Awal Kerja)</span>
                                            @endif
                                        </td>
                                        <td class="py-3"><span class="badge bg-light text-dark border font-weight-bold">{{ $riwayat->jabatan_baru }}</span></td>
                                        <td class="py-3 font-weight-bold text-secondary">{{ $riwayat->tanggal_perubahan->locale('id')->translatedFormat('d M Y') }}</td>
                                        <td class="px-4 py-3 text-sm text-muted">{{ $riwayat->keterangan ?? '-' }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center py-4 text-muted">Tidak ada riwayat pekerjaan yang memenuhi filter.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(function () {
            // PDF print link trigger
            $('#btnCetak').on('click', function () {
                const queryParams = $('#filterForm').serialize();
                const printUrl = "{{ route('laporan.cetak') }}?" + queryParams;
                window.open(printUrl, '_blank');
            });
        });
    </script>
@endsection
