@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tambah Foto Galeri</h1>
        <a href="{{ route('galeri.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali
        </a>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Form Tambah Foto Galeri</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('galeri.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="judul">Judul *</label>
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

                        <div class="form-group">
                            <label for="foto">Foto *</label>
                            <input type="file" class="form-control @error('foto') is-invalid @enderror"
                                   id="foto" name="foto" accept="image/*" required>
                            <small class="form-text text-muted">Format yang didukung: JPG, PNG, GIF, WebP. Maksimal 5MB</small>
                            @error('foto')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="kategori">Kategori *</label>
                            <select class="form-control @error('kategori') is-invalid @enderror"
                                    id="kategori" name="kategori" required>
                                <option value="">Pilih Kategori</option>
                                <option value="akademik" {{ old('kategori') == 'akademik' ? 'selected' : '' }}>Akademik</option>
                                <option value="kemahasiswaan" {{ old('kategori') == 'kemahasiswaan' ? 'selected' : '' }}>Kemahasiswaan</option>
                                <option value="fasilitas" {{ old('kategori') == 'fasilitas' ? 'selected' : '' }}>Fasilitas</option>
                                <option value="kegiatan" {{ old('kategori') == 'kegiatan' ? 'selected' : '' }}>Kegiatan</option>
                                <option value="prestasi" {{ old('kategori') == 'prestasi' ? 'selected' : '' }}>Prestasi</option>
                                <option value="lainnya" {{ old('kategori') == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                            </select>
                            @error('kategori')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tanggal">Tanggal</label>
                                    <input type="date" class="form-control @error('tanggal') is-invalid @enderror"
                                           id="tanggal" name="tanggal" value="{{ old('tanggal') }}">
                                    @error('tanggal')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="fotografer">Fotografer</label>
                                    <input type="text" class="form-control @error('fotografer') is-invalid @enderror"
                                           id="fotografer" name="fotografer" value="{{ old('fotografer') }}">
                                    @error('fotografer')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tampilkan_di_home">Tampilkan di Homepage</label>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input"
                                               id="tampilkan_di_home" name="tampilkan_di_home" value="1"
                                               {{ old('tampilkan_di_home') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="tampilkan_di_home">
                                            Ya, tampilkan foto ini di homepage
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="urutan">Urutan Prioritas</label>
                                    <input type="number" class="form-control @error('urutan') is-invalid @enderror"
                                           id="urutan" name="urutan" value="{{ old('urutan', 1) }}" min="1">
                                    <small class="form-text text-muted">Angka kecil = prioritas tinggi</small>
                                    @error('urutan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Simpan
                            </button>
                            <a href="{{ route('galeri.index') }}" class="btn btn-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <!-- Preview -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Preview Foto</h6>
                </div>
                <div class="card-body">
                    <div id="image-preview" class="text-center">
                        <div class="text-muted">
                            <i class="fas fa-image fa-3x mb-3"></i>
                            <p>Preview foto akan muncul di sini</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Info -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Informasi</h6>
                </div>
                <div class="card-body">
                    <p class="text-muted small">
                        <strong>Kategori Galeri:</strong><br>
                        - <strong>Akademik:</strong> Wisuda, kuliah, ujian<br>
                        - <strong>Kemahasiswaan:</strong> Organisasi, lomba<br>
                        - <strong>Fasilitas:</strong> Lab, perpustakaan<br>
                        - <strong>Kegiatan:</strong> Seminar, workshop<br>
                        - <strong>Prestasi:</strong> Juara lomba, penghargaan<br>
                        - <strong>Lainnya:</strong> Kategori lainnya
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('foto').addEventListener('change', function(e) {
    const file = e.target.files[0];
    const preview = document.getElementById('image-preview');

    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.innerHTML = `
                <img src="${e.target.result}" class="img-fluid rounded" style="max-height: 300px;">
            `;
        };
        reader.readAsDataURL(file);
    } else {
        preview.innerHTML = `
            <div class="text-muted">
                <i class="fas fa-image fa-3x mb-3"></i>
                <p>Preview foto akan muncul di sini</p>
            </div>
        `;
    }
});
</script>
@endsection