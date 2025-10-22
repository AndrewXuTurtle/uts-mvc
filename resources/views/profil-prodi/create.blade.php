@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-white py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Tambah Profil Program Studi</h5>
                        <a href="{{ route('profil-prodi.index') }}" class="btn btn-outline-secondary btn-sm">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('profil-prodi.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="nama_prodi">Nama Program Studi</label>
                            <input type="text" class="form-control @error('nama_prodi') is-invalid @enderror"
                                   id="nama_prodi" name="nama_prodi" value="{{ old('nama_prodi', 'Teknik Perangkat Lunak') }}" required>
                            @error('nama_prodi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="visi">Visi</label>
                            <textarea class="form-control @error('visi') is-invalid @enderror"
                                      id="visi" name="visi" rows="4">{{ old('visi') }}</textarea>
                            @error('visi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="misi">Misi</label>
                            <textarea class="form-control @error('misi') is-invalid @enderror"
                                      id="misi" name="misi" rows="6">{{ old('misi') }}</textarea>
                            @error('misi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="deskripsi">Deskripsi</label>
                            <textarea class="form-control @error('deskripsi') is-invalid @enderror"
                                      id="deskripsi" name="deskripsi" rows="4">{{ old('deskripsi') }}</textarea>
                            @error('deskripsi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="akreditasi">Akreditasi</label>
                            <input type="text" class="form-control @error('akreditasi') is-invalid @enderror"
                                   id="akreditasi" name="akreditasi" value="{{ old('akreditasi') }}" placeholder="Contoh: B">
                            @error('akreditasi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="logo">Logo Program Studi</label>
                            <input type="file" class="form-control @error('logo') is-invalid @enderror"
                                   id="logo" name="logo" accept="image/*">
                            <small class="form-text text-muted">Format: JPG, PNG, GIF. Maksimal 2MB</small>
                            @error('logo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="kontak_email">Email Kontak</label>
                            <input type="email" class="form-control @error('kontak_email') is-invalid @enderror"
                                   id="kontak_email" name="kontak_email" value="{{ old('kontak_email') }}">
                            @error('kontak_email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="kontak_telepon">Telepon Kontak</label>
                            <input type="text" class="form-control @error('kontak_telepon') is-invalid @enderror"
                                   id="kontak_telepon" name="kontak_telepon" value="{{ old('kontak_telepon') }}">
                            @error('kontak_telepon')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-4">
                            <label for="alamat">Alamat</label>
                            <textarea class="form-control @error('alamat') is-invalid @enderror"
                                      id="alamat" name="alamat" rows="3">{{ old('alamat') }}</textarea>
                            @error('alamat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Simpan Data
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection