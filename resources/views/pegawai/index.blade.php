@extends('layouts.app')

@section('title', 'Data Pegawai')
@section('page_title', 'Data Pegawai')

@section('breadcrumb')
    <li class="breadcrumb-item active">Data Pegawai</li>
@endsection

@section('content')
    <!-- Filter Card -->
    <div class="card card-outline">
        <div class="card-body">
            <form action="{{ route('pegawai.index') }}" method="GET" class="row g-3 align-items-end">
                <div class="col-md-3">
                    <label for="search" class="form-label font-weight-bold text-secondary text-sm">Pencarian</label>
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0 text-muted"><i class="fas fa-search"></i></span>
                        <input type="text" name="search" id="search" class="form-control border-start-0" placeholder="Nama, NIP, Jabatan..." value="{{ request('search') }}">
                    </div>
                </div>
                
                <div class="col-md-3">
                    <label for="jabatan_id" class="form-label font-weight-bold text-secondary text-sm">Filter Jabatan</label>
                    <select name="jabatan_id" id="jabatan_id" class="form-control select2">
                        <option value="">-- Semua Jabatan --</option>
                        @foreach($jabatans as $jabatan)
                            <option value="{{ $jabatan->id }}" {{ request('jabatan_id') == $jabatan->id ? 'selected' : '' }}>{{ $jabatan->nama_jabatan }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3">
                    <label for="status_pegawai" class="form-label font-weight-bold text-secondary text-sm">Filter Status</label>
                    <select name="status_pegawai" id="status_pegawai" class="form-control">
                        <option value="">-- Semua Status --</option>
                        <option value="Guru" {{ request('status_pegawai') == 'Guru' ? 'selected' : '' }}>Guru</option>
                        <option value="Tenaga Administrasi" {{ request('status_pegawai') == 'Tenaga Administrasi' ? 'selected' : '' }}>Tenaga Administrasi</option>
                        <option value="Staf Pendukung" {{ request('status_pegawai') == 'Staf Pendukung' ? 'selected' : '' }}>Staf Pendukung</option>
                    </select>
                </div>

                <div class="col-md-3 d-flex gap-2">
                    <button type="submit" class="btn btn-primary w-100"><i class="fas fa-filter mr-1"></i>Filter</button>
                    <a href="{{ route('pegawai.index') }}" class="btn btn-outline-secondary w-100"><i class="fas fa-sync mr-1"></i>Reset</a>
                </div>
            </form>
        </div>
    </div>

    <!-- Data Table Card -->
    <div class="card card-outline mt-3">
        <div class="card-header border-0 d-flex align-items-center justify-content-between">
            <h5 class="card-title font-weight-bold m-0"><i class="fa-solid fa-list mr-2 text-primary"></i>Daftar Kepegawaian</h5>
            @if(Auth::user()->role === 'admin')
                <a href="{{ route('pegawai.create') }}" class="btn btn-primary btn-sm rounded-lg"><i class="fas fa-plus mr-1"></i>Tambah Pegawai</a>
            @endif
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light text-secondary text-sm">
                        <tr>
                            <th class="px-4 py-3 text-center" style="width: 60px;">Foto</th>
                            <th class="py-3">NIP / Nama</th>
                            <th class="py-3">Jenis Kelamin</th>
                            <th class="py-3">Jabatan</th>
                            <th class="py-3">Status</th>
                            <th class="py-3">Email & No HP</th>
                            <th class="px-4 py-3 text-center" style="width: 150px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pegawais as $pegawai)
                            <tr>
                                <td class="px-4 py-3 text-center">
                                    @if($pegawai->foto)
                                        <img src="{{ asset('storage/' . $pegawai->foto) }}" alt="Foto" class="rounded-circle" style="width: 40px; height: 40px; object-fit: cover; border: 2px solid #E2E8F0;">
                                    @else
                                        <div class="bg-light text-secondary rounded-circle d-flex align-items-center justify-content-center m-auto" style="width: 40px; height: 40px; font-weight: 600; border: 2px solid #E2E8F0;">
                                            {{ strtoupper(substr($pegawai->nama_lengkap, 0, 1)) }}
                                        </div>
                                    @endif
                                </td>
                                <td class="py-3">
                                    <div class="font-weight-bold text-dark">{{ $pegawai->nama_lengkap }}</div>
                                    <small class="text-muted font-weight-bold">{{ $pegawai->nip }}</small>
                                </td>
                                <td class="py-3">{{ $pegawai->jenis_kelamin }}</td>
                                <td class="py-3">
                                    <span class="badge bg-light text-dark border px-2 py-1 font-weight-bold">{{ $pegawai->jabatan->nama_jabatan }}</span>
                                </td>
                                <td class="py-3">
                                    @if($pegawai->status_pegawai === 'Guru')
                                        <span class="badge bg-success-light text-white px-2 py-1">{{ $pegawai->status_pegawai }}</span>
                                    @elseif($pegawai->status_pegawai === 'Tenaga Administrasi')
                                        <span class="badge bg-warning-light text-white px-2 py-1">{{ $pegawai->status_pegawai }}</span>
                                    @else
                                        <span class="badge bg-info-light text-white px-2 py-1">{{ $pegawai->status_pegawai }}</span>
                                    @endif
                                </td>
                                <td class="py-3">
                                    <div><i class="fas fa-envelope text-xs text-muted mr-1"></i>{{ $pegawai->email }}</div>
                                    <small class="text-muted"><i class="fas fa-phone text-xs mr-1"></i>{{ $pegawai->no_hp }}</small>
                                </td>
                                <td class="px-4 py-3 text-center">
                                    <div class="d-flex justify-content-center gap-1">
                                        <a href="{{ route('pegawai.show', $pegawai->id) }}" class="btn btn-info btn-xs text-white" title="Detail"><i class="fas fa-eye"></i></a>
                                        @if(Auth::user()->role === 'admin')
                                            <a href="{{ route('pegawai.edit', $pegawai->id) }}" class="btn btn-warning btn-xs text-white" title="Edit"><i class="fas fa-edit"></i></a>
                                            <!-- Delete Form -->
                                            <form action="{{ route('pegawai.destroy', $pegawai->id) }}" method="POST" class="delete-form d-inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-danger btn-xs delete-btn" title="Hapus"><i class="fas fa-trash"></i></button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-5 text-muted">
                                    <i class="fas fa-users fa-3x mb-3 text-light"></i>
                                    <p class="mb-0">Tidak ada data pegawai ditemukan.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if($pegawais->hasPages())
            <div class="card-footer bg-white border-0 py-3">
                <div class="d-flex justify-content-end">
                    {{ $pegawais->links('pagination::bootstrap-5') }}
                </div>
            </div>
        @endif
    </div>
@endsection

@section('scripts')
    <script>
        $(function () {
            // Delete confirmation dialog
            $('.delete-btn').on('click', function (e) {
                e.preventDefault();
                const form = $(this).closest('.delete-form');

                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Data pegawai beserta riwayat pekerjaan akan dihapus permanen!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#EF4444',
                    cancelButtonColor: '#64748B',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>
@endsection
