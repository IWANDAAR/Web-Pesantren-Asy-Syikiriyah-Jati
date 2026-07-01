@extends('layouts.app')

@section('title', 'Riwayat Pekerjaan')
@section('page_title', 'Riwayat Perubahan Pekerjaan')

@section('breadcrumb')
    <li class="breadcrumb-item active">Riwayat Pekerjaan</li>
@endsection

@section('content')
    <div class="card card-outline">
        <div class="card-header border-0 d-flex align-items-center justify-content-between">
            <h5 class="card-title font-weight-bold m-0"><i class="fa-solid fa-clock-rotate-left mr-2 text-primary"></i>Log Riwayat Mutasi Jabatan</h5>
            @if(Auth::user()->role === 'admin')
                <a href="{{ route('riwayat.create') }}" class="btn btn-primary btn-sm rounded-lg"><i class="fas fa-plus mr-1"></i>Tambah Riwayat</a>
            @endif
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0" id="riwayatTable">
                    <thead class="table-light text-secondary text-sm">
                        <tr>
                            <th class="px-4 py-3" style="width: 80px;">No</th>
                            <th class="py-3">Pegawai</th>
                            <th class="py-3">NIP</th>
                            <th class="py-3">Jabatan Lama</th>
                            <th class="py-3">Jabatan Baru</th>
                            <th class="py-3">Tanggal Perubahan</th>
                            <th class="py-3">Keterangan</th>
                            @if(Auth::user()->role === 'admin')
                                <th class="px-4 py-3 text-center" style="width: 150px;">Aksi</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($riwayats as $index => $riwayat)
                            <tr>
                                <td class="px-4 py-3 font-weight-bold">{{ $index + 1 }}</td>
                                <td class="py-3 font-weight-bold text-dark">
                                    <a href="{{ route('pegawai.show', $riwayat->pegawai_id) }}" class="text-primary text-decoration-none">
                                        {{ $riwayat->pegawai->nama_lengkap }}
                                    </a>
                                </td>
                                <td class="py-3">{{ $riwayat->pegawai->nip }}</td>
                                <td class="py-3">
                                    @if($riwayat->jabatan_lama)
                                        <span class="text-secondary">{{ $riwayat->jabatan_lama }}</span>
                                    @else
                                        <span class="text-muted italic">- (Awal Kerja)</span>
                                    @endif
                                </td>
                                <td class="py-3">
                                    <span class="badge bg-light text-dark border px-2 py-1 font-weight-bold">{{ $riwayat->jabatan_baru }}</span>
                                </td>
                                <td class="py-3 font-weight-bold text-secondary">
                                    {{ $riwayat->tanggal_perubahan->locale('id')->translatedFormat('d M Y') }}
                                </td>
                                <td class="py-3 text-muted text-sm">{{ $riwayat->keterangan ?? '-' }}</td>
                                @if(Auth::user()->role === 'admin')
                                    <td class="px-4 py-3 text-center">
                                        <div class="d-flex justify-content-center gap-1">
                                            <a href="{{ route('riwayat.edit', $riwayat->id) }}" class="btn btn-warning btn-xs text-white" title="Edit"><i class="fas fa-edit"></i></a>
                                            
                                            <form action="{{ route('riwayat.destroy', $riwayat->id) }}" method="POST" class="delete-form d-inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-danger btn-xs delete-btn" title="Hapus"><i class="fas fa-trash"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                @endif
                            </tr>
                        @empty
                            <tr>
                                <td colspan="{{ Auth::user()->role === 'admin' ? 8 : 7 }}" class="text-center py-5 text-muted">
                                    <i class="fas fa-history fa-3x mb-3 text-light"></i>
                                    <p class="mb-0">Tidak ada log riwayat pekerjaan.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
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
                    text: "Log riwayat pekerjaan ini akan dihapus secara permanen!",
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
