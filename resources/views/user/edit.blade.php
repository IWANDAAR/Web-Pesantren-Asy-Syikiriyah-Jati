@extends('layouts.app')

@section('title', 'Edit User')
@section('page_title', 'Edit User Pengguna')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('user.index') }}">User</a></li>
    <li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card card-outline">
                <div class="card-header border-0">
                    <h5 class="card-title font-weight-bold m-0"><i class="fas fa-user-edit mr-2 text-warning"></i>Form Edit Pengguna</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('user.update', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-3">
                            <label for="name" class="form-label font-weight-bold text-secondary text-sm">Nama Lengkap <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $user->name) }}" required>
                            @error('name')
                                <div class="invalid-feedback font-weight-bold">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label font-weight-bold text-secondary text-sm">Alamat Email <span class="text-danger">*</span></label>
                            <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $user->email) }}" required>
                            @error('email')
                                <div class="invalid-feedback font-weight-bold">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="role" class="form-label font-weight-bold text-secondary text-sm">Role Akses <span class="text-danger">*</span></label>
                            <select name="role" id="role" class="form-control @error('role') is-invalid @enderror" required>
                                <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="pimpinan" {{ old('role', $user->role) == 'pimpinan' ? 'selected' : '' }}>Pimpinan</option>
                            </select>
                            @error('role')
                                <div class="invalid-feedback font-weight-bold">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="bg-light p-3 rounded mb-3 border">
                            <h6 class="font-weight-bold text-secondary text-xs text-uppercase mb-2">Ubah Password (Opsional)</h6>
                            
                            <div class="mb-2">
                                <label for="password" class="form-label text-secondary text-sm">Password Baru</label>
                                <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="Biarkan kosong jika tidak diubah">
                                @error('password')
                                    <div class="invalid-feedback font-weight-bold">{{ $message }}</div>
                                @enderror
                            </div>

                            <div>
                                <label for="password_confirmation" class="form-label text-secondary text-sm">Konfirmasi Password Baru</label>
                                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Ulangi password baru">
                            </div>
                        </div>

                        <div class="d-flex gap-2 mt-4">
                            <button type="submit" class="btn btn-warning text-white px-4"><i class="fas fa-save mr-2"></i>Perbarui</button>
                            <a href="{{ route('user.index') }}" class="btn btn-secondary px-4"><i class="fas fa-arrow-left mr-2"></i>Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
