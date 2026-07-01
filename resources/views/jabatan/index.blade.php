@extends('layouts.app')

@section('title', 'Jabatan')
@section('page_title', 'Manajemen Jabatan')

@section('breadcrumb')
    <li class="breadcrumb-item active">Jabatan</li>
@endsection

@section('content')
    <div class="row">
        <!-- List Jabatan -->
        <div class="{{ Auth::user()->role === 'admin' ? 'col-md-8' : 'col-md-12' }}">
            <div class="card card-outline">
                <div class="card-header border-0">
                    <h5 class="card-title font-weight-bold m-0"><i class="fa-solid fa-briefcase mr-2 text-primary"></i>Daftar Jabatan</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0" id="jabatanTable">
                            <thead class="table-light text-secondary text-sm">
                                <tr>
                                    <th class="px-4 py-3" style="width: 80px;">No</th>
                                    <th class="py-3">Nama Jabatan</th>
                                    <th class="py-3">Deskripsi</th>
                                    <th class="px-4 py-3 text-center" style="width: 150px;">Total Pegawai</th>
                                    @if(Auth::user()->role === 'admin')
                                        <th class="px-4 py-3 text-center" style="width: 150px;">Aksi</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($jabatans as $index => $jabatan)
                                    <tr>
                                        <td class="px-4 py-3 font-weight-bold">{{ $index + 1 }}</td>
                                        <td class="py-3 font-weight-bold text-dark">{{ $jabatan->nama_jabatan }}</td>
                                        <td class="py-3 text-muted text-sm">{{ $jabatan->deskripsi ?? '-' }}</td>
                                        <td class="px-4 py-3 text-center">
                                            <span class="badge bg-primary-light text-white px-2 py-1 font-weight-bold" style="font-size: 0.85rem;">{{ $jabatan->pegawais->count() }} orang</span>
                                        </td>
                                        @if(Auth::user()->role === 'admin')
                                            <td class="px-4 py-3 text-center">
                                                <div class="d-flex justify-content-center gap-1">
                                                    <a href="{{ route('jabatan.edit', $jabatan->id) }}" class="btn btn-warning btn-xs text-white" title="Edit"><i class="fas fa-edit"></i></a>
                                                    
                                                    <form action="{{ route('jabatan.destroy', $jabatan->id) }}" method="POST" class="delete-form d-inline-block">
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
                                        <td colspan="5" class="text-center py-4 text-muted">Belum ada data jabatan.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Add Jabatan Form (Admin Only) -->
        @if(Auth::user()->role === 'admin')
            <div class="col-md-4">
                <div class="card card-outline">
                    <div class="card-header border-0">
                        <h5 class="card-title font-weight-bold m-0"><i class="fas fa-plus mr-2 text-success"></i>Tambah Jabatan</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('jabatan.store') }}" method="POST">
                            @csrf
                            
                            <div class="mb-3">
                                <label for="nama_jabatan" class="form-label font-weight-bold text-secondary text-sm">Nama Jabatan <span class="text-danger">*</span></label>
                                <input type="text" name="nama_jabatan" id="nama_jabatan" class="form-control @error('nama_jabatan') is-invalid @enderror" value="{{ old('nama_jabatan') }}" placeholder="Contoh: Bendahara Pondok" required>
                                @error('nama_jabatan')
                                    <div class="invalid-feedback font-weight-bold">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="deskripsi" class="form-label font-weight-bold text-secondary text-sm">Deskripsi / Keterangan</label>
                                <textarea name="deskripsi" id="deskripsi" rows="4" class="form-control @error('deskripsi') is-invalid @enderror" placeholder="Tuliskan wewenang atau keterangan jabatan...">{{ old('deskripsi') }}</textarea>
                                @error('deskripsi')
                                    <div class="invalid-feedback font-weight-bold">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-success w-100 mt-2"><i class="fas fa-save mr-2"></i>Simpan Jabatan</button>
                        </form>
                    </div>
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
                    text: "Jabatan akan dihapus secara permanen!",
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
