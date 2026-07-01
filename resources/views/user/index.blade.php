@extends('layouts.app')

@section('title', 'Manajemen User')
@section('page_title', 'Manajemen User Pengguna')

@section('breadcrumb')
    <li class="breadcrumb-item active">User</li>
@endsection

@section('content')
    <div class="card card-outline">
        <div class="card-header border-0 d-flex align-items-center justify-content-between">
            <h5 class="card-title font-weight-bold m-0"><i class="fa-solid fa-user-shield mr-2 text-primary"></i>Pengguna Sistem</h5>
            <a href="{{ route('user.create') }}" class="btn btn-primary btn-sm rounded-lg"><i class="fas fa-plus mr-1"></i>Tambah User</a>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light text-secondary text-sm">
                        <tr>
                            <th class="px-4 py-3" style="width: 80px;">No</th>
                            <th class="py-3">Nama Lengkap</th>
                            <th class="py-3">Email</th>
                            <th class="py-3">Role Akses</th>
                            <th class="py-3">Tanggal Terdaftar</th>
                            <th class="px-4 py-3 text-center" style="width: 150px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $index => $user)
                            <tr>
                                <td class="px-4 py-3 font-weight-bold">{{ $index + 1 }}</td>
                                <td class="py-3 font-weight-bold text-dark">{{ $user->name }}</td>
                                <td class="py-3">{{ $user->email }}</td>
                                <td class="py-3">
                                    @if($user->role === 'admin')
                                        <span class="badge bg-primary text-white px-2 py-1">Administrator</span>
                                    @else
                                        <span class="badge bg-success text-white px-2 py-1">Pimpinan</span>
                                    @endif
                                </td>
                                <td class="py-3 text-muted">{{ $user->created_at->locale('id')->translatedFormat('d M Y, H:i') }} WIB</td>
                                <td class="px-4 py-3 text-center">
                                    <div class="d-flex justify-content-center gap-1">
                                        <a href="{{ route('user.edit', $user->id) }}" class="btn btn-warning btn-xs text-white" title="Edit"><i class="fas fa-edit"></i></a>
                                        
                                        @if(Auth::id() !== $user->id)
                                            <form action="{{ route('user.destroy', $user->id) }}" method="POST" class="delete-form d-inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-danger btn-xs delete-btn" title="Hapus"><i class="fas fa-trash"></i></button>
                                            </form>
                                        @else
                                            <button type="button" class="btn btn-secondary btn-xs disabled" title="Anda sedang login dengan akun ini" disabled><i class="fas fa-trash"></i></button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
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
                    text: "Akun user ini akan dihapus permanen dari sistem!",
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
