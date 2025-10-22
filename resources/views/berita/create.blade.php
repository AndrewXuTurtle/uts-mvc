@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-white py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Tambah Berita Baru</h5>
                        <a href="{{ route('berita.index') }}" class="btn btn-outline-secondary btn-sm">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('berita.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="judul">Judul</label>
                            <input type="text" class="form-control @error('judul') is-invalid @enderror" 
                                   id="judul" name="judul" value="{{ old('judul') }}" required maxlength="50">
                            @error('judul')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="isi">Isi Berita</label>
                            <textarea class="form-control @error('isi') is-invalid @enderror" 
                                      id="isi" name="isi" rows="5" required>{{ old('isi') }}</textarea>
                            @error('isi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="gambar">Gambar</label>
                            <input type="file" class="form-control @error('gambar') is-invalid @enderror" 
                                   id="gambar" name="gambar" accept="image/*">
                            @error('gambar')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="penulis">Penulis</label>
                            <input type="text" class="form-control @error('penulis') is-invalid @enderror" 
                                   id="penulis" name="penulis" value="{{ old('penulis') }}" required maxlength="100">
                            @error('penulis')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-4">
                            <label for="tanggal">Tanggal</label>
                            <input type="date" class="form-control @error('tanggal') is-invalid @enderror" 
                                   id="tanggal" name="tanggal" value="{{ old('tanggal') }}" required>
                            @error('tanggal')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <hr>
                        
                        <!-- Prestasi Section -->
                        <div class="form-group mb-3">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="is_prestasi" name="is_prestasi" value="1" {{ old('is_prestasi') ? 'checked' : '' }} onchange="togglePrestasiFields()">
                                <label class="custom-control-label" for="is_prestasi">
                                    <strong>Ini adalah Prestasi Mahasiswa</strong>
                                </label>
                            </div>
                        </div>

                        <div id="prestasi-fields" style="display: {{ old('is_prestasi') ? 'block' : 'none' }};">
                            <div class="card bg-light mb-3">
                                <div class="card-body">
                                    <h6 class="card-title mb-3">Data Prestasi Mahasiswa</h6>
                                    
                                    <div class="form-row">
                                        <div class="form-group col-md-6 mb-3">
                                            <label for="nama_mahasiswa">Nama Mahasiswa <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control @error('nama_mahasiswa') is-invalid @enderror" 
                                                   id="nama_mahasiswa" name="nama_mahasiswa" value="{{ old('nama_mahasiswa') }}">
                                            @error('nama_mahasiswa')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-6 mb-3">
                                            <label for="nim">NIM <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control @error('nim') is-invalid @enderror" 
                                                   id="nim" name="nim" value="{{ old('nim') }}">
                                            @error('nim')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="program_studi">Program Studi</label>
                                        <input type="text" class="form-control @error('program_studi') is-invalid @enderror" 
                                               id="program_studi" name="program_studi" value="{{ old('program_studi') }}">
                                        @error('program_studi')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-6 mb-3">
                                            <label for="tingkat_prestasi">Tingkat Prestasi</label>
                                            <select class="form-control @error('tingkat_prestasi') is-invalid @enderror" 
                                                    id="tingkat_prestasi" name="tingkat_prestasi">
                                                <option value="">Pilih Tingkat</option>
                                                <option value="Internasional" {{ old('tingkat_prestasi') == 'Internasional' ? 'selected' : '' }}>Internasional</option>
                                                <option value="Nasional" {{ old('tingkat_prestasi') == 'Nasional' ? 'selected' : '' }}>Nasional</option>
                                                <option value="Regional" {{ old('tingkat_prestasi') == 'Regional' ? 'selected' : '' }}>Regional</option>
                                                <option value="Lokal" {{ old('tingkat_prestasi') == 'Lokal' ? 'selected' : '' }}>Lokal</option>
                                            </select>
                                            @error('tingkat_prestasi')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-6 mb-3">
                                            <label for="jenis_prestasi">Jenis Prestasi</label>
                                            <input type="text" class="form-control @error('jenis_prestasi') is-invalid @enderror" 
                                                   id="jenis_prestasi" name="jenis_prestasi" value="{{ old('jenis_prestasi') }}" 
                                                   placeholder="e.g. Akademik, Olahraga, Seni">
                                            @error('jenis_prestasi')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-6 mb-3">
                                            <label for="penyelenggara">Penyelenggara</label>
                                            <input type="text" class="form-control @error('penyelenggara') is-invalid @enderror" 
                                                   id="penyelenggara" name="penyelenggara" value="{{ old('penyelenggara') }}">
                                            @error('penyelenggara')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-6 mb-3">
                                            <label for="tanggal_prestasi">Tanggal Prestasi</label>
                                            <input type="date" class="form-control @error('tanggal_prestasi') is-invalid @enderror" 
                                                   id="tanggal_prestasi" name="tanggal_prestasi" value="{{ old('tanggal_prestasi') }}">
                                            @error('tanggal_prestasi')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Simpan Berita
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function togglePrestasiFields() {
    const checkbox = document.getElementById('is_prestasi');
    const fields = document.getElementById('prestasi-fields');
    const requiredFields = ['nama_mahasiswa', 'nim'];
    
    if (checkbox.checked) {
        fields.style.display = 'block';
        requiredFields.forEach(field => {
            document.getElementById(field).required = true;
        });
    } else {
        fields.style.display = 'none';
        requiredFields.forEach(field => {
            document.getElementById(field).required = false;
        });
    }
}

// Check on page load
document.addEventListener('DOMContentLoaded', function() {
    togglePrestasiFields();
});
</script>
@endsection