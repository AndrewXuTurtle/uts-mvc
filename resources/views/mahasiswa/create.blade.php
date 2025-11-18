@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tambah Data Mahasiswa</h1>
        <a href="{{ route('mahasiswa.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali
        </a>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Form Tambah Mahasiswa</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('mahasiswa.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="nim">NIM *</label>
                            <input type="text" class="form-control @error('nim') is-invalid @enderror"
                                   id="nim" name="nim" value="{{ old('nim') }}" required>
                            @error('nim')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="nama">Nama Lengkap *</label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                   id="nama" name="nama" value="{{ old('nama') }}" required>
                            @error('nama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="email">Email *</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                   id="email" name="email" value="{{ old('email') }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="no_hp">No. HP</label>
                                    <input type="text" class="form-control @error('no_hp') is-invalid @enderror"
                                           id="no_hp" name="no_hp" value="{{ old('no_hp') }}">
                                    @error('no_hp')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="jenis_kelamin">Jenis Kelamin *</label>
                                    <select class="form-control @error('jenis_kelamin') is-invalid @enderror"
                                            id="jenis_kelamin" name="jenis_kelamin" required>
                                        <option value="">-- Pilih --</option>
                                        <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                        <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                    </select>
                                    @error('jenis_kelamin')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tempat_lahir">Tempat Lahir</label>
                                    <input type="text" class="form-control @error('tempat_lahir') is-invalid @enderror"
                                           id="tempat_lahir" name="tempat_lahir" value="{{ old('tempat_lahir') }}">
                                    @error('tempat_lahir')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tanggal_lahir">Tanggal Lahir</label>
                                    <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror"
                                           id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}">
                                    @error('tanggal_lahir')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <textarea class="form-control @error('alamat') is-invalid @enderror"
                                      id="alamat" name="alamat" rows="3">{{ old('alamat') }}</textarea>
                            @error('alamat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="tahun_masuk">Tahun Masuk *</label>
                                    <input type="number" class="form-control @error('tahun_masuk') is-invalid @enderror"
                                           id="tahun_masuk" name="tahun_masuk" value="{{ old('tahun_masuk', date('Y')) }}"
                                           min="2000" max="{{ date('Y') + 1 }}" required>
                                    @error('tahun_masuk')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="kelas">Kelas</label>
                                    <input type="text" class="form-control @error('kelas') is-invalid @enderror"
                                           id="kelas" name="kelas" value="{{ old('kelas') }}" placeholder="Contoh: TPL-A">
                                    @error('kelas')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="status">Status *</label>
                                    <select class="form-control @error('status') is-invalid @enderror"
                                            id="status" name="status" required>
                                        <option value="Aktif" {{ old('status') == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                                        <option value="Lulus" {{ old('status') == 'Lulus' ? 'selected' : '' }}>Lulus</option>
                                        <option value="Cuti" {{ old('status') == 'Cuti' ? 'selected' : '' }}>Cuti</option>
                                        <option value="DO" {{ old('status') == 'DO' ? 'selected' : '' }}>DO</option>
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="prodi">Program Studi</label>
                            <input type="text" class="form-control @error('prodi') is-invalid @enderror"
                                   id="prodi" name="prodi" value="{{ old('prodi', 'Teknik Perangkat Lunak') }}" readonly>
                            @error('prodi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="foto">Foto Profil</label>
                            <input type="file" class="form-control @error('foto') is-invalid @enderror"
                                   id="foto" name="foto" accept="image/*">
                            <small class="form-text text-muted">Format: JPG, PNG, GIF. Maksimal 2MB</small>
                            @error('foto')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Simpan
                            </button>
                            <a href="{{ route('mahasiswa.index') }}" class="btn btn-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <!-- Info Panel -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Informasi</h6>
                </div>
                <div class="card-body">
                    <h5>Tambah Data Mahasiswa</h5>
                    <p class="mb-0">Form ini digunakan untuk menambahkan data mahasiswa baru ke dalam sistem.</p>
                </div>
            </div>

            <!-- Guidelines -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Panduan</h6>
                </div>
                <div class="card-body">
                    <ul class="small mb-0">
                        <li>NIM harus unik dan tidak boleh sama dengan mahasiswa lain</li>
                        <li>Email harus valid dan unik</li>
                        <li>Foto profil bersifat opsional</li>
                        <li>Format foto: JPG, PNG, atau GIF</li>
                        <li>Ukuran maksimal foto: 2MB</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection