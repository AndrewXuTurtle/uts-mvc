@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Peraturan</h1>
        <a href="{{ route('peraturan.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali
        </a>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Form Edit Peraturan</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('peraturan.update', $peraturan) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="judul">Judul Peraturan *</label>
                            <input type="text" class="form-control @error('judul') is-invalid @enderror"
                                   id="judul" name="judul" value="{{ old('judul', $peraturan->judul) }}" required>
                            @error('judul')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="deskripsi">Deskripsi</label>
                            <textarea class="form-control @error('deskripsi') is-invalid @enderror"
                                      id="deskripsi" name="deskripsi" rows="3">{{ old('deskripsi', $peraturan->deskripsi) }}</textarea>
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
                                        <option value="Akademik" {{ old('kategori', $peraturan->kategori) == 'Akademik' ? 'selected' : '' }}>Akademik</option>
                                        <option value="Kemahasiswaan" {{ old('kategori', $peraturan->kategori) == 'Kemahasiswaan' ? 'selected' : '' }}>Kemahasiswaan</option>
                                        <option value="Administratif" {{ old('kategori', $peraturan->kategori) == 'Administratif' ? 'selected' : '' }}>Administratif</option>
                                        <option value="Keuangan" {{ old('kategori', $peraturan->kategori) == 'Keuangan' ? 'selected' : '' }}>Keuangan</option>
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
                                        <option value="Kalender Akademik" {{ old('jenis', $peraturan->jenis) == 'Kalender Akademik' ? 'selected' : '' }}>Kalender Akademik</option>
                                        <option value="Panduan Studi" {{ old('jenis', $peraturan->jenis) == 'Panduan Studi' ? 'selected' : '' }}>Panduan Studi</option>
                                        <option value="Skripsi" {{ old('jenis', $peraturan->jenis) == 'Skripsi' ? 'selected' : '' }}>Skripsi</option>
                                        <option value="Magang" {{ old('jenis', $peraturan->jenis) == 'Magang' ? 'selected' : '' }}>Magang</option>
                                        <option value="Tata Tertib" {{ old('jenis', $peraturan->jenis) == 'Tata Tertib' ? 'selected' : '' }}>Tata Tertib</option>
                                        <option value="Kode Etik" {{ old('jenis', $peraturan->jenis) == 'Kode Etik' ? 'selected' : '' }}>Kode Etik</option>
                                        <option value="Kegiatan" {{ old('jenis', $peraturan->jenis) == 'Kegiatan' ? 'selected' : '' }}>Kegiatan</option>
                                        <option value="SOP" {{ old('jenis', $peraturan->jenis) == 'SOP' ? 'selected' : '' }}>SOP</option>
                                        <option value="Surat Menyurat" {{ old('jenis', $peraturan->jenis) == 'Surat Menyurat' ? 'selected' : '' }}>Surat Menyurat</option>
                                        <option value="Cuti Kuliah" {{ old('jenis', $peraturan->jenis) == 'Cuti Kuliah' ? 'selected' : '' }}>Cuti Kuliah</option>
                                        <option value="Biaya Kuliah" {{ old('jenis', $peraturan->jenis) == 'Biaya Kuliah' ? 'selected' : '' }}>Biaya Kuliah</option>
                                        <option value="Beasiswa" {{ old('jenis', $peraturan->jenis) == 'Beasiswa' ? 'selected' : '' }}>Beasiswa</option>
                                        <option value="Denda Keterlambatan" {{ old('jenis', $peraturan->jenis) == 'Denda Keterlambatan' ? 'selected' : '' }}>Denda Keterlambatan</option>
                                    </select>
                                    @error('jenis')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="file">File PDF</label>
                            
                            @if($peraturan->file_path)
                            <div class="alert alert-info mb-2">
                                <i class="fas fa-file-pdf"></i> File saat ini: 
                                <strong>{{ $peraturan->file_name ?? basename($peraturan->file_path) }}</strong>
                                <span class="badge badge-secondary ml-2">{{ $peraturan->file_size_formatted }}</span>
                                <a href="{{ Storage::url($peraturan->file_path) }}" target="_blank" class="btn btn-sm btn-info ml-2">
                                    <i class="fas fa-eye"></i> Lihat
                                </a>
                            </div>
                            @endif
                            
                            <input type="file" class="form-control-file @error('file') is-invalid @enderror"
                                   id="file" name="file" accept=".pdf">
                            <small class="form-text text-muted">
                                Format: PDF. Maksimal 10MB. Kosongkan jika tidak ingin mengubah file.
                            </small>
                            @error('file')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="urutan">Urutan Tampil</label>
                                    <input type="number" class="form-control @error('urutan') is-invalid @enderror"
                                           id="urutan" name="urutan" value="{{ old('urutan', $peraturan->urutan) }}" min="0">
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
                                        <option value="1" {{ old('is_active', $peraturan->is_active) == 1 ? 'selected' : '' }}>Aktif</option>
                                        <option value="0" {{ old('is_active', $peraturan->is_active) == 0 ? 'selected' : '' }}>Tidak Aktif</option>
                                    </select>
                                    @error('is_active')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group mt-4">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Update
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
                        <li>Kosongkan file jika tidak ingin mengubah</li>
                        <li>Pilih kategori dan jenis yang sesuai</li>
                        <li>Urutan tampil: angka lebih besar = muncul lebih atas</li>
                    </ul>
                </div>
            </div>

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-danger">Informasi File</h6>
                </div>
                <div class="card-body">
                    <table class="table table-sm table-borderless">
                        <tr>
                            <td class="text-muted">Nama File:</td>
                            <td>{{ $peraturan->file_name ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">Ukuran:</td>
                            <td>{{ $peraturan->file_size_formatted ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">Diupload:</td>
                            <td>{{ $peraturan->created_at->format('d M Y') }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">Terakhir Update:</td>
                            <td>{{ $peraturan->updated_at->format('d M Y H:i') }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
