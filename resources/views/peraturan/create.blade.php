@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tambah Peraturan</h1>
        <a href="{{ route('peraturan.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali
        </a>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Form Tambah Peraturan</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('peraturan.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="judul">Judul Peraturan *</label>
                            <input type="text" class="form-control @error('judul') is-invalid @enderror"
                                   id="judul" name="judul" value="{{ old('judul') }}" required>
                            @error('judul')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="deskripsi">Deskripsi</label>
                            <textarea class="form-control @error('deskripsi') is-invalid @enderror"
                                      id="deskripsi" name="deskripsi" rows="3">{{ old('deskripsi') }}</textarea>
                            @error('deskripsi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="kategori">Kategori *</label>
                                    <select class="form-control @error('kategori') is-invalid @enderror"
                                            id="kategori" name="kategori" required>
                                        <option value="">-- Pilih Kategori --</option>
                                        <option value="Akademik" {{ old('kategori') == 'Akademik' ? 'selected' : '' }}>Akademik</option>
                                        <option value="Kemahasiswaan" {{ old('kategori') == 'Kemahasiswaan' ? 'selected' : '' }}>Kemahasiswaan</option>
                                        <option value="Administratif" {{ old('kategori') == 'Administratif' ? 'selected' : '' }}>Administratif</option>
                                        <option value="Keuangan" {{ old('kategori') == 'Keuangan' ? 'selected' : '' }}>Keuangan</option>
                                    </select>
                                    @error('kategori')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="jenis">Jenis Dokumen *</label>
                                    <select class="form-control @error('jenis') is-invalid @enderror"
                                            id="jenis" name="jenis" required>
                                        <option value="">-- Pilih Jenis --</option>
                                        <option value="Kalender Akademik" {{ old('jenis') == 'Kalender Akademik' ? 'selected' : '' }}>Kalender Akademik</option>
                                        <option value="Panduan Studi" {{ old('jenis') == 'Panduan Studi' ? 'selected' : '' }}>Panduan Studi</option>
                                        <option value="Skripsi" {{ old('jenis') == 'Skripsi' ? 'selected' : '' }}>Skripsi</option>
                                        <option value="Magang" {{ old('jenis') == 'Magang' ? 'selected' : '' }}>Magang</option>
                                        <option value="Tata Tertib" {{ old('jenis') == 'Tata Tertib' ? 'selected' : '' }}>Tata Tertib</option>
                                        <option value="Kode Etik" {{ old('jenis') == 'Kode Etik' ? 'selected' : '' }}>Kode Etik</option>
                                        <option value="Kegiatan" {{ old('jenis') == 'Kegiatan' ? 'selected' : '' }}>Kegiatan</option>
                                        <option value="SOP" {{ old('jenis') == 'SOP' ? 'selected' : '' }}>SOP</option>
                                        <option value="Surat Menyurat" {{ old('jenis') == 'Surat Menyurat' ? 'selected' : '' }}>Surat Menyurat</option>
                                        <option value="Cuti Kuliah" {{ old('jenis') == 'Cuti Kuliah' ? 'selected' : '' }}>Cuti Kuliah</option>
                                        <option value="Biaya Kuliah" {{ old('jenis') == 'Biaya Kuliah' ? 'selected' : '' }}>Biaya Kuliah</option>
                                        <option value="Beasiswa" {{ old('jenis') == 'Beasiswa' ? 'selected' : '' }}>Beasiswa</option>
                                        <option value="Denda Keterlambatan" {{ old('jenis') == 'Denda Keterlambatan' ? 'selected' : '' }}>Denda Keterlambatan</option>
                                    </select>
                                    @error('jenis')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="file">File PDF *</label>
                            <input type="file" class="form-control-file @error('file') is-invalid @enderror"
                                   id="file" name="file" accept=".pdf" required>
                            <small class="form-text text-muted">Format: PDF. Maksimal 10MB</small>
                            @error('file')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="urutan">Urutan Tampil</label>
                                    <input type="number" class="form-control @error('urutan') is-invalid @enderror"
                                           id="urutan" name="urutan" value="{{ old('urutan', 0) }}" min="0">
                                    <small class="form-text text-muted">0 = tampil paling bawah</small>
                                    @error('urutan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="is_active">Status</label>
                                    <select class="form-control @error('is_active') is-invalid @enderror"
                                            id="is_active" name="is_active">
                                        <option value="1" {{ old('is_active', 1) == 1 ? 'selected' : '' }}>Aktif</option>
                                        <option value="0" {{ old('is_active') == 0 ? 'selected' : '' }}>Tidak Aktif</option>
                                    </select>
                                    @error('is_active')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group mt-4">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Simpan
                            </button>
                            <a href="{{ route('peraturan.index') }}" class="btn btn-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Panduan</h6>
                </div>
                <div class="card-body">
                    <ul class="small mb-0">
                        <li>Judul harus jelas dan deskriptif</li>
                        <li>File harus dalam format PDF</li>
                        <li>Ukuran maksimal file: 10MB</li>
                        <li>Pilih kategori dan jenis yang sesuai</li>
                        <li>Urutan tampil: angka lebih besar = muncul lebih atas</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
