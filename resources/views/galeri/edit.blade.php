@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Foto Galeri</h1>
        <a href="{{ route('galeri.show', $galeri->id) }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali
        </a>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Form Edit Foto Galeri</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('galeri.update', $galeri->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="judul">Judul *</label>
                            <input type="text" class="form-control @error('judul') is-invalid @enderror"
                                   id="judul" name="judul" value="{{ old('judul', $galeri->judul) }}" required>
                            @error('judul')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="deskripsi">Deskripsi</label>
                            <textarea class="form-control @error('deskripsi') is-invalid @enderror"
                                      id="deskripsi" name="deskripsi" rows="3">{{ old('deskripsi', $galeri->deskripsi) }}</textarea>
                            @error('deskripsi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="foto">Foto - Kosongkan jika tidak ingin mengubah</label>
                            <input type="file" class="form-control @error('foto') is-invalid @enderror"
                                   id="foto" name="foto" accept="image/*">
                            <small class="form-text text-muted">Format yang didukung: JPG, PNG, GIF, WebP. Maksimal 5MB</small>
                            @error('foto')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                            @if($galeri->foto)
                            <div class="mt-2">
                                <small class="text-muted">Foto saat ini:</small><br>
                                <img src="{{ asset('storage/galeri/' . $galeri->foto) }}" alt="Current photo" width="200" class="img-thumbnail mt-1">
                            </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="kategori">Kategori *</label>
                            <select class="form-control @error('kategori') is-invalid @enderror"
                                    id="kategori" name="kategori" required>
                                <option value="">Pilih Kategori</option>
                                <option value="akademik" {{ old('kategori', $galeri->kategori) == 'akademik' ? 'selected' : '' }}>Akademik</option>
                                <option value="kemahasiswaan" {{ old('kategori', $galeri->kategori) == 'kemahasiswaan' ? 'selected' : '' }}>Kemahasiswaan</option>
                                <option value="fasilitas" {{ old('kategori', $galeri->kategori) == 'fasilitas' ? 'selected' : '' }}>Fasilitas</option>
                                <option value="kegiatan" {{ old('kategori', $galeri->kategori) == 'kegiatan' ? 'selected' : '' }}>Kegiatan</option>
                                <option value="prestasi" {{ old('kategori', $galeri->kategori) == 'prestasi' ? 'selected' : '' }}>Prestasi</option>
                                <option value="lainnya" {{ old('kategori', $galeri->kategori) == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
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
                                           id="tanggal" name="tanggal" value="{{ old('tanggal', $galeri->tanggal ? $galeri->tanggal->format('Y-m-d') : '') }}">
                                    @error('tanggal')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="fotografer">Fotografer</label>
                                    <input type="text" class="form-control @error('fotografer') is-invalid @enderror"
                                           id="fotografer" name="fotografer" value="{{ old('fotografer', $galeri->fotografer) }}">
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
                                               {{ old('tampilkan_di_home', $galeri->tampilkan_di_home) ? 'checked' : '' }}>
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
                                           id="urutan" name="urutan" value="{{ old('urutan', $galeri->urutan) }}" min="1">
                                    <small class="form-text text-muted">Angka kecil = prioritas tinggi</small>
                                    @error('urutan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Perbarui
                            </button>
                            <a href="{{ route('galeri.show', $galeri->id) }}" class="btn btn-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <!-- Current Photo -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Foto Saat Ini</h6>
                </div>
                <div class="card-body">
                    <div id="current-preview" class="text-center">
                        <img src="{{ asset('storage/galeri/' . $galeri->foto) }}"
                             alt="{{ $galeri->judul }}" class="img-fluid rounded" style="max-height: 300px;">
                    </div>
                </div>
            </div>

            <!-- New Photo Preview -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Preview Foto Baru</h6>
                </div>
                <div class="card-body">
                    <div id="image-preview" class="text-center">
                        <div class="text-muted">
                            <i class="fas fa-image fa-2x mb-2"></i>
                            <p class="small">Preview foto baru akan muncul di sini</p>
                        </div>
                    </div>
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
                <img src="${e.target.result}" class="img-fluid rounded" style="max-height: 200px;">
            `;
        };
        reader.readAsDataURL(file);
    } else {
        preview.innerHTML = `
            <div class="text-muted">
                <i class="fas fa-image fa-2x mb-2"></i>
                <p class="small">Preview foto baru akan muncul di sini</p>
            </div>
        `;
    }
});
</script>
@endsection