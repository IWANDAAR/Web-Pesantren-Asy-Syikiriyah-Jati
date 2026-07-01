@extends('layouts.app')

@section('title', 'Edit Pegawai')
@section('page_title', 'Edit Data Pegawai')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('pegawai.index') }}">Data Pegawai</a></li>
    <li class="breadcrumb-item"><a href="{{ route('pegawai.show', $pegawai->id) }}">{{ $pegawai->nama_lengkap }}</a></li>
    <li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card card-outline">
                <div class="card-header border-0">
                    <h5 class="card-title font-weight-bold m-0"><i class="fas fa-edit mr-2 text-warning"></i>Form Edit Pegawai</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('pegawai.update', $pegawai->id) }}" method="POST" enctype="multipart/form-data" class="row g-3">
                        @csrf
                        @method('PUT')
                        
                        <!-- NIP -->
                        <div class="col-md-6">
                            <label for="nip" class="form-label font-weight-bold text-secondary text-sm">NIP (Nomor Induk Pegawai) <span class="text-danger">*</span></label>
                            <input type="text" name="nip" id="nip" class="form-control @error('nip') is-invalid @enderror" value="{{ old('nip', $pegawai->nip) }}" required>
                            @error('nip')
                                <div class="invalid-feedback font-weight-bold">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Nama Lengkap -->
                        <div class="col-md-6">
                            <label for="nama_lengkap" class="form-label font-weight-bold text-secondary text-sm">Nama Lengkap <span class="text-danger">*</span></label>
                            <input type="text" name="nama_lengkap" id="nama_lengkap" class="form-control @error('nama_lengkap') is-invalid @enderror" value="{{ old('nama_lengkap', $pegawai->nama_lengkap) }}" required>
                            @error('nama_lengkap')
                                <div class="invalid-feedback font-weight-bold">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Jenis Kelamin -->
                        <div class="col-md-4">
                            <label for="jenis_kelamin" class="form-label font-weight-bold text-secondary text-sm">Jenis Kelamin <span class="text-danger">*</span></label>
                            <select name="jenis_kelamin" id="jenis_kelamin" class="form-control @error('jenis_kelamin') is-invalid @enderror" required>
                                <option value="">-- Pilih Jenis Kelamin --</option>
                                <option value="Laki-laki" {{ old('jenis_kelamin', $pegawai->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="Perempuan" {{ old('jenis_kelamin', $pegawai->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                            @error('jenis_kelamin')
                                <div class="invalid-feedback font-weight-bold">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Tempat Lahir -->
                        <div class="col-md-4">
                            <label for="tempat_lahir" class="form-label font-weight-bold text-secondary text-sm">Tempat Lahir <span class="text-danger">*</span></label>
                            <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control @error('tempat_lahir') is-invalid @enderror" value="{{ old('tempat_lahir', $pegawai->tempat_lahir) }}" required>
                            @error('tempat_lahir')
                                <div class="invalid-feedback font-weight-bold">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Tanggal Lahir -->
                        <div class="col-md-4">
                            <label for="tanggal_lahir" class="form-label font-weight-bold text-secondary text-sm">Tanggal Lahir <span class="text-danger">*</span></label>
                            <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control @error('tanggal_lahir') is-invalid @enderror" value="{{ old('tanggal_lahir', $pegawai->tanggal_lahir->format('Y-m-d')) }}" required>
                            @error('tanggal_lahir')
                                <div class="invalid-feedback font-weight-bold">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="col-md-6">
                            <label for="email" class="form-label font-weight-bold text-secondary text-sm">Email <span class="text-danger">*</span></label>
                            <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $pegawai->email) }}" required>
                            @error('email')
                                <div class="invalid-feedback font-weight-bold">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- No HP -->
                        <div class="col-md-6">
                            <label for="no_hp" class="form-label font-weight-bold text-secondary text-sm">Nomor HP <span class="text-danger">*</span></label>
                            <input type="text" name="no_hp" id="no_hp" class="form-control @error('no_hp') is-invalid @enderror" value="{{ old('no_hp', $pegawai->no_hp) }}" required>
                            @error('no_hp')
                                <div class="invalid-feedback font-weight-bold">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Status Pegawai -->
                        <div class="col-md-6">
                            <label for="status_pegawai" class="form-label font-weight-bold text-secondary text-sm">Status Pegawai <span class="text-danger">*</span></label>
                            <select name="status_pegawai" id="status_pegawai" class="form-control @error('status_pegawai') is-invalid @enderror" required>
                                <option value="">-- Pilih Status --</option>
                                <option value="Guru" {{ old('status_pegawai', $pegawai->status_pegawai) == 'Guru' ? 'selected' : '' }}>Guru</option>
                                <option value="Tenaga Administrasi" {{ old('status_pegawai', $pegawai->status_pegawai) == 'Tenaga Administrasi' ? 'selected' : '' }}>Tenaga Administrasi</option>
                                <option value="Staf Pendukung" {{ old('status_pegawai', $pegawai->status_pegawai) == 'Staf Pendukung' ? 'selected' : '' }}>Staf Pendukung</option>
                            </select>
                            @error('status_pegawai')
                                <div class="invalid-feedback font-weight-bold">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Jabatan -->
                        <div class="col-md-6">
                            <label for="jabatan_id" class="form-label font-weight-bold text-secondary text-sm">Jabatan Sekarang <span class="text-danger">*</span></label>
                            <select name="jabatan_id" id="jabatan_id" class="form-control @error('jabatan_id') is-invalid @enderror" required>
                                <option value="">-- Pilih Jabatan --</option>
                                @foreach($jabatans as $jabatan)
                                    <option value="{{ $jabatan->id }}" {{ old('jabatan_id', $pegawai->jabatan_id) == $jabatan->id ? 'selected' : '' }}>{{ $jabatan->nama_jabatan }}</option>
                                @endforeach
                            </select>
                            @error('jabatan_id')
                                <div class="invalid-feedback font-weight-bold">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Alamat -->
                        <div class="col-md-12">
                            <label for="alamat" class="form-label font-weight-bold text-secondary text-sm">Alamat Rumah Lengkap <span class="text-danger">*</span></label>
                            <textarea name="alamat" id="alamat" rows="3" class="form-control @error('alamat') is-invalid @enderror" required>{{ old('alamat', $pegawai->alamat) }}</textarea>
                            @error('alamat')
                                <div class="invalid-feedback font-weight-bold">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Foto -->
                        <div class="col-md-12">
                            <label for="foto" class="form-label font-weight-bold text-secondary text-sm">Ganti Foto Profil</label>
                            
                            @if($pegawai->foto)
                                <div class="mb-2">
                                    <img src="{{ asset('storage/' . $pegawai->foto) }}" alt="Foto Lama" class="img-thumbnail rounded" style="width: 100px; height: 100px; object-fit: cover;">
                                    <div class="text-xs text-muted">Foto saat ini</div>
                                </div>
                            @endif

                            <input type="file" name="foto" id="foto" class="form-control @error('foto') is-invalid @enderror">
                            <small class="form-text text-muted">Biarkan kosong jika tidak ingin mengganti foto. Format: JPG, JPEG, PNG. Maksimal 2MB.</small>
                            @error('foto')
                                <div class="invalid-feedback font-weight-bold d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Buttons -->
                        <div class="col-12 mt-4 d-flex gap-2">
                            <button type="submit" class="btn btn-warning px-4 text-white"><i class="fas fa-save mr-2"></i>Perbarui</button>
                            <a href="{{ route('pegawai.index') }}" class="btn btn-secondary px-4"><i class="fas fa-arrow-left mr-2"></i>Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
