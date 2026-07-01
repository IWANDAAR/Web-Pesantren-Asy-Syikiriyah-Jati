@extends('layouts.app')

@section('title', 'Edit Riwayat Pekerjaan')
@section('page_title', 'Edit Riwayat Pekerjaan')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('riwayat.index') }}">Riwayat Pekerjaan</a></li>
    <li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card card-outline">
                <div class="card-header border-0">
                    <h5 class="card-title font-weight-bold m-0"><i class="fas fa-edit mr-2 text-warning"></i>Form Edit Riwayat</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('riwayat.update', $riwayat->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-3">
                            <label for="pegawai_id" class="form-label font-weight-bold text-secondary text-sm">Pilih Pegawai <span class="text-danger">*</span></label>
                            <select name="pegawai_id" id="pegawai_id" class="form-control @error('pegawai_id') is-invalid @enderror" required>
                                <option value="">-- Pilih Pegawai --</option>
                                @foreach($pegawais as $pegawai)
                                    <option value="{{ $pegawai->id }}" {{ old('pegawai_id', $riwayat->pegawai_id) == $pegawai->id ? 'selected' : '' }}>{{ $pegawai->nama_lengkap }} ({{ $pegawai->nip }})</option>
                                @endforeach
                            </select>
                            @error('pegawai_id')
                                <div class="invalid-feedback font-weight-bold">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="jabatan_lama" class="form-label font-weight-bold text-secondary text-sm">Jabatan Lama (Kosongkan jika awal masuk)</label>
                            <input type="text" name="jabatan_lama" id="jabatan_lama" class="form-control @error('jabatan_lama') is-invalid @enderror" value="{{ old('jabatan_lama', $riwayat->jabatan_lama) }}">
                            @error('jabatan_lama')
                                <div class="invalid-feedback font-weight-bold">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="jabatan_baru" class="form-label font-weight-bold text-secondary text-sm">Jabatan Baru <span class="text-danger">*</span></label>
                            <input type="text" name="jabatan_baru" id="jabatan_baru" class="form-control @error('jabatan_baru') is-invalid @enderror" value="{{ old('jabatan_baru', $riwayat->jabatan_baru) }}" required>
                            @error('jabatan_baru')
                                <div class="invalid-feedback font-weight-bold">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="tanggal_perubahan" class="form-label font-weight-bold text-secondary text-sm">Tanggal Perubahan <span class="text-danger">*</span></label>
                            <input type="date" name="tanggal_perubahan" id="tanggal_perubahan" class="form-control @error('tanggal_perubahan') is-invalid @enderror" value="{{ old('tanggal_perubahan', $riwayat->tanggal_perubahan->format('Y-m-d')) }}" required>
                            @error('tanggal_perubahan')
                                <div class="invalid-feedback font-weight-bold">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="keterangan" class="form-label font-weight-bold text-secondary text-sm">Keterangan / Alasan Perubahan</label>
                            <textarea name="keterangan" id="keterangan" rows="3" class="form-control @error('keterangan') is-invalid @enderror">{{ old('keterangan', $riwayat->keterangan) }}</textarea>
                            @error('keterangan')
                                <div class="invalid-feedback font-weight-bold">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex gap-2 mt-4">
                            <button type="submit" class="btn btn-warning text-white px-4"><i class="fas fa-save mr-2"></i>Perbarui</button>
                            <a href="{{ route('riwayat.index') }}" class="btn btn-secondary px-4"><i class="fas fa-arrow-left mr-2"></i>Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
