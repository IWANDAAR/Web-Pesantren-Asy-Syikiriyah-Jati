@extends('layouts.app')

@section('title', 'Detail Pegawai')
@section('page_title', 'Detail Pegawai')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('pegawai.index') }}">Data Pegawai</a></li>
    <li class="breadcrumb-item active">{{ $pegawai->nama_lengkap }}</li>
@endsection

@section('content')
    <div class="row">
        <!-- Profile Sidebar -->
        <div class="col-md-4">
            <div class="card card-outline">
                <div class="card-body text-center py-4">
                    <div class="mb-3">
                        @if($pegawai->foto)
                            <img src="{{ asset('storage/' . $pegawai->foto) }}" alt="Foto" class="rounded-circle img-thumbnail" style="width: 140px; height: 140px; object-fit: cover; border: 3px solid #E2E8F0;">
                        @else
                            <div class="bg-light text-secondary rounded-circle d-flex align-items-center justify-content-center m-auto" style="width: 140px; height: 140px; font-size: 3rem; font-weight: 600; border: 3px solid #E2E8F0;">
                                {{ strtoupper(substr($pegawai->nama_lengkap, 0, 2)) }}
                            </div>
                        @endif
                    </div>
                    
                    <h5 class="font-weight-bold text-dark mb-1">{{ $pegawai->nama_lengkap }}</h5>
                    <p class="text-muted text-sm font-weight-bold mb-2">NIP. {{ $pegawai->nip }}</p>
                    
                    <div class="mb-3">
                        <span class="badge bg-light text-dark border px-3 py-2 font-weight-bold mb-1">{{ $pegawai->jabatan->nama_jabatan }}</span><br>
                        @if($pegawai->status_pegawai === 'Guru')
                            <span class="badge bg-success-light text-white px-3 py-1">{{ $pegawai->status_pegawai }}</span>
                        @elseif($pegawai->status_pegawai === 'Tenaga Administrasi')
                            <span class="badge bg-warning-light text-white px-3 py-1">{{ $pegawai->status_pegawai }}</span>
                        @else
                            <span class="badge bg-info-light text-white px-3 py-1">{{ $pegawai->status_pegawai }}</span>
                        @endif
                    </div>

                    @if(Auth::user()->role === 'admin')
                        <div class="d-flex justify-content-center gap-2 mt-4">
                            <a href="{{ route('pegawai.edit', $pegawai->id) }}" class="btn btn-warning text-white btn-sm px-3"><i class="fas fa-edit mr-1"></i>Edit Profil</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Details & History -->
        <div class="col-md-8">
            <!-- Profile Info Card -->
            <div class="card card-outline">
                <div class="card-header border-0">
                    <h5 class="card-title font-weight-bold m-0"><i class="fas fa-info-circle mr-2 text-primary"></i>Informasi Pribadi</h5>
                </div>
                <div class="card-body p-0">
                    <table class="table table-striped mb-0">
                        <tbody>
                            <tr>
                                <th class="px-4 py-3" style="width: 30%;">NIP</th>
                                <td class="px-4 py-3 font-weight-bold">{{ $pegawai->nip }}</td>
                            </tr>
                            <tr>
                                <th class="px-4 py-3">Nama Lengkap</th>
                                <td class="px-4 py-3">{{ $pegawai->nama_lengkap }}</td>
                            </tr>
                            <tr>
                                <th class="px-4 py-3">Jenis Kelamin</th>
                                <td class="px-4 py-3">{{ $pegawai->jenis_kelamin }}</td>
                            </tr>
                            <tr>
                                <th class="px-4 py-3">Tempat, Tanggal Lahir</th>
                                <td class="px-4 py-3">{{ $pegawai->tempat_lahir }}, {{ $pegawai->tanggal_lahir->locale('id')->translatedFormat('d F Y') }}</td>
                            </tr>
                            <tr>
                                <th class="px-4 py-3">Email</th>
                                <td class="px-4 py-3">{{ $pegawai->email }}</td>
                            </tr>
                            <tr>
                                <th class="px-4 py-3">Nomor HP</th>
                                <td class="px-4 py-3">{{ $pegawai->no_hp }}</td>
                            </tr>
                            <tr>
                                <th class="px-4 py-3">Alamat</th>
                                <td class="px-4 py-3">{{ $pegawai->alamat }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Job History Card -->
            <div class="card card-outline mt-3">
                <div class="card-header border-0">
                    <h5 class="card-title font-weight-bold m-0"><i class="fas fa-history mr-2 text-success"></i>Riwayat Perubahan Jabatan</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light text-secondary text-sm">
                                <tr>
                                    <th class="px-4 py-3">Tanggal</th>
                                    <th class="py-3">Jabatan Lama</th>
                                    <th class="py-3">Jabatan Baru</th>
                                    <th class="px-4 py-3">Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($pegawai->riwayatPekerjaans->sortByDesc('tanggal_perubahan') as $riwayat)
                                    <tr>
                                        <td class="px-4 py-3 font-weight-bold">{{ $riwayat->tanggal_perubahan->locale('id')->translatedFormat('d M Y') }}</td>
                                        <td class="py-3">
                                            @if($riwayat->jabatan_lama)
                                                <span class="text-secondary">{{ $riwayat->jabatan_lama }}</span>
                                            @else
                                                <span class="text-muted italic">- (Awal)</span>
                                            @endif
                                        </td>
                                        <td class="py-3">
                                            <span class="badge bg-light text-dark border px-2 py-1 font-weight-bold">{{ $riwayat->jabatan_baru }}</span>
                                        </td>
                                        <td class="px-4 py-3 text-muted">{{ $riwayat->keterangan ?? '-' }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center py-4 text-muted">Belum ada riwayat pekerjaan tercatat.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="mt-3">
                <a href="{{ route('pegawai.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left mr-2"></i>Kembali ke Daftar Pegawai</a>
            </div>
        </div>
    </div>
@endsection
