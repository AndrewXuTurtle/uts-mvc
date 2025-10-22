@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-white py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Edit Project</h5>
                        <a href="{{ route('project.index') }}" class="btn btn-outline-secondary btn-sm">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('project.update', $project->project_id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group mb-3">
                            <label for="judul_proyek">Judul Proyek</label>
                            <input type="text" class="form-control @error('judul_proyek') is-invalid @enderror"
                                   id="judul_proyek" name="judul_proyek" value="{{ old('judul_proyek', $project->judul_proyek) }}" required>
                            @error('judul_proyek')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="deskripsi_singkat">Deskripsi Singkat</label>
                            <textarea class="form-control @error('deskripsi_singkat') is-invalid @enderror"
                                      id="deskripsi_singkat" name="deskripsi_singkat" rows="3">{{ old('deskripsi_singkat', $project->deskripsi_singkat) }}</textarea>
                            @error('deskripsi_singkat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="nama_mahasiswa">Nama Mahasiswa</label>
                            <input type="text" class="form-control @error('nama_mahasiswa') is-invalid @enderror"
                                   id="nama_mahasiswa" name="nama_mahasiswa" value="{{ old('nama_mahasiswa', $project->nama_mahasiswa) }}" required>
                            @error('nama_mahasiswa')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="nim_mahasiswa">NIM Mahasiswa</label>
                            <input type="text" class="form-control @error('nim_mahasiswa') is-invalid @enderror"
                                   id="nim_mahasiswa" name="nim_mahasiswa" value="{{ old('nim_mahasiswa', $project->nim_mahasiswa) }}" required>
                            @error('nim_mahasiswa')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="program_studi">Program Studi</label>
                            <input type="hidden" name="program_studi" value="Teknik Perangkat Lunak">
                            <div class="form-control bg-light">Teknik Perangkat Lunak</div>
                        </div>

                        <div class="form-group mb-3">
                            <label for="dosen_pembimbing">Dosen Pembimbing</label>
                            <input type="text" class="form-control @error('dosen_pembimbing') is-invalid @enderror"
                                   id="dosen_pembimbing" name="dosen_pembimbing" value="{{ old('dosen_pembimbing', $project->dosen_pembimbing) }}">
                            @error('dosen_pembimbing')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="tahun_selesai">Tahun Selesai</label>
                            <input type="number" class="form-control @error('tahun_selesai') is-invalid @enderror"
                                   id="tahun_selesai" name="tahun_selesai" value="{{ old('tahun_selesai', $project->tahun_selesai) }}" required min="2000" max="{{ date('Y') + 1 }}">
                            @error('tahun_selesai')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="path_foto_utama">Foto Utama</label>
                            @if($project->path_foto_utama)
                                <div class="mb-2">
                                    <img src="{{ asset('storage/' . $project->path_foto_utama) }}" alt="Current Photo"
                                         class="img-thumbnail" width="100">
                                </div>
                            @endif
                            <input type="file" class="form-control @error('path_foto_utama') is-invalid @enderror"
                                   id="path_foto_utama" name="path_foto_utama" accept="image/*">
                            @error('path_foto_utama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="path_foto_galeri">Foto Galeri (Multiple)</label>
                            @if($project->path_foto_galeri)
                                <div class="mb-2">
                                    <small class="text-muted">Foto galeri saat ini:</small>
                                    <div class="row" id="gallery-images">
                                        @foreach(explode(',', $project->path_foto_galeri) as $index => $galeri)
                                            <div class="col-md-3 mb-2 gallery-item" data-image-path="{{ trim($galeri) }}">
                                                <div class="card">
                                                    <img src="{{ asset('storage/' . trim($galeri)) }}" alt="Galeri"
                                                         class="card-img-top" style="height: 100px; object-fit: cover;">
                                                    <div class="card-body p-2">
                                                        <button type="button" class="btn btn-danger btn-sm delete-gallery-image" 
                                                                data-image-path="{{ trim($galeri) }}">
                                                            <i class="fas fa-trash"></i> Hapus
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                            <input type="file" class="form-control @error('path_foto_galeri') is-invalid @enderror"
                                   id="path_foto_galeri" name="path_foto_galeri[]" accept="image/*" multiple>
                            <small class="form-text text-muted">Pilih gambar baru untuk ditambahkan ke galeri (tidak akan menggantikan yang lama)</small>
                            @error('path_foto_galeri')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-4">
                            <label for="keywords">Keywords</label>
                            <input type="text" class="form-control @error('keywords') is-invalid @enderror"
                                   id="keywords" name="keywords" value="{{ old('keywords', $project->keywords) }}" placeholder="pisahkan dengan koma">
                            @error('keywords')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Update Data
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Handle gallery image deletion
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('delete-gallery-image') || e.target.closest('.delete-gallery-image')) {
            e.preventDefault();
            
            const button = e.target.classList.contains('delete-gallery-image') ? e.target : e.target.closest('.delete-gallery-image');
            const imagePath = button.getAttribute('data-image-path');
            const galleryItem = button.closest('.gallery-item');
            
            if (confirm('Apakah Anda yakin ingin menghapus gambar ini dari galeri?')) {
                // Send delete request
                fetch(`{{ url('project') }}/${{{ $project->project_id }}}/gallery`, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        image_path: imagePath
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Remove the image from the UI
                        galleryItem.remove();
                        
                        // Check if gallery is empty
                        const galleryContainer = document.getElementById('gallery-images');
                        if (galleryContainer && galleryContainer.children.length === 0) {
                            const gallerySection = galleryContainer.closest('.mb-2');
                            if (gallerySection) {
                                gallerySection.remove();
                            }
                        }
                        
                        alert('Gambar galeri berhasil dihapus');
                    } else {
                        alert('Gagal menghapus gambar: ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat menghapus gambar');
                });
            }
        }
    });
});
</script>
@endpush