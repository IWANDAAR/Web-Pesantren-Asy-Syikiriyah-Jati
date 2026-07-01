@extends('layouts.app')

@section('title', 'Edit Jabatan')
@section('page_title', 'Edit Jabatan')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('jabatan.index') }}">Jabatan</a></li>
    <li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card card-outline">
                <div class="card-header border-0">
                    <h5 class="card-title font-weight-bold m-0"><i class="fas fa-edit mr-2 text-warning"></i>Form Edit Jabatan</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('jabatan.update', $jabatan->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-3">
                            <label for="nama_jabatan" class="form-label font-weight-bold text-secondary text-sm">Nama Jabatan <span class="text-danger">*</span></label>
                            <input type="text" name="nama_jabatan" id="nama_jabatan" class="form-control @error('nama_jabatan') is-invalid @enderror" value="{{ old('nama_jabatan', $jabatan->nama_jabatan) }}" required>
                            @error('nama_jabatan')
                                <div class="invalid-feedback font-weight-bold">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="deskripsi" class="form-label font-weight-bold text-secondary text-sm">Deskripsi / Keterangan</label>
                            <textarea name="deskripsi" id="deskripsi" rows="5" class="form-control @error('deskripsi') is-invalid @enderror">{{ old('deskripsi', $jabatan->deskripsi) }}</textarea>
                            @error('deskripsi')
                                <div class="invalid-feedback font-weight-bold">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex gap-2 mt-4">
                            <button type="submit" class="btn btn-warning text-white px-4"><i class="fas fa-save mr-2"></i>Perbarui</button>
                            <a href="{{ route('jabatan.index') }}" class="btn btn-secondary px-4"><i class="fas fa-arrow-left mr-2"></i>Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
