@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-white py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Tambah Project Baru</h5>
                        <a href="{{ route('project.index') }}" class="btn btn-outline-secondary btn-sm">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('project.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="form-group mb-3">
                            <label for="nim">NIM Mahasiswa <span class="text-danger">*</span></label>
                            <select class="form-control @error('nim') is-invalid @enderror" 
                                    id="nim" name="nim" required>
                                <option value="">-- Pilih Mahasiswa --</option>
                                @foreach($mahasiswa as $mhs)
                                    <option value="{{ $mhs->nim }}" {{ old('nim') == $mhs->nim ? 'selected' : '' }}>
                                        {{ $mhs->nim }} - {{ $mhs->nama }}
                                    </option>
                                @endforeach
                            </select>
                            @error('nim')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">Pilih mahasiswa yang membuat project</small>
                        </div>

                        <div class="form-group mb-3">
                            <label for="judul_project">Judul Project <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('judul_project') is-invalid @enderror"
                                   id="judul_project" name="judul_project" value="{{ old('judul_project') }}" required>
                            @error('judul_project')
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

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="tahun">Tahun Mulai <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control @error('tahun') is-invalid @enderror"
                                           id="tahun" name="tahun" value="{{ old('tahun', date('Y')) }}" 
                                           required min="2000" max="{{ date('Y') + 1 }}">
                                    @error('tahun')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="tahun_selesai">Tahun Selesai</label>
                                    <input type="number" class="form-control @error('tahun_selesai') is-invalid @enderror"
                                           id="tahun_selesai" name="tahun_selesai" value="{{ old('tahun_selesai', date('Y')) }}" 
                                           min="2000" max="{{ date('Y') + 1 }}">
                                    @error('tahun_selesai')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label for="kategori">Kategori</label>
                            <select class="form-control @error('kategori') is-invalid @enderror" 
                                    id="kategori" name="kategori">
                                <option value="">-- Pilih Kategori --</option>
                                <option value="Web Application" {{ old('kategori') == 'Web Application' ? 'selected' : '' }}>Web Application</option>
                                <option value="Mobile Application" {{ old('kategori') == 'Mobile Application' ? 'selected' : '' }}>Mobile Application</option>
                                <option value="Desktop Application" {{ old('kategori') == 'Desktop Application' ? 'selected' : '' }}>Desktop Application</option>
                                <option value="Game" {{ old('kategori') == 'Game' ? 'selected' : '' }}>Game</option>
                                <option value="Machine Learning" {{ old('kategori') == 'Machine Learning' ? 'selected' : '' }}>Machine Learning</option>
                                <option value="IoT" {{ old('kategori') == 'IoT' ? 'selected' : '' }}>IoT</option>
                                <option value="Lainnya" {{ old('kategori') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                            </select>
                            @error('kategori')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="teknologi">Teknologi yang Digunakan</label>
                            <input type="text" class="form-control @error('teknologi') is-invalid @enderror"
                                   id="teknologi" name="teknologi" value="{{ old('teknologi') }}"
                                   placeholder="Contoh: Laravel, Vue.js, MySQL">
                            @error('teknologi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="dosen_pembimbing">Dosen Pembimbing</label>
                            <select class="form-control @error('dosen_pembimbing') is-invalid @enderror"
                                    id="dosen_pembimbing" name="dosen_pembimbing">
                                <option value="">-- Pilih Dosen --</option>
                                @foreach(\App\Models\Dosen::where('status', 'Aktif')->orderBy('nama')->get() as $dsn)
                                    <option value="{{ $dsn->nama }}" {{ old('dosen_pembimbing') == $dsn->nama ? 'selected' : '' }}>
                                        {{ $dsn->nama }}
                                    </option>
                                @endforeach
                            </select>
                            @error('dosen_pembimbing')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="link_github">Link GitHub</label>
                                    <input type="url" class="form-control @error('link_github') is-invalid @enderror"
                                           id="link_github" name="link_github" value="{{ old('link_github') }}"
                                           placeholder="https://github.com/...">
                                    @error('link_github')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="link_demo">Link Demo</label>
                                    <input type="url" class="form-control @error('link_demo') is-invalid @enderror"
                                           id="link_demo" name="link_demo" value="{{ old('link_demo') }}"
                                           placeholder="https://...">
                                    @error('link_demo')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label for="status">Status</label>
                            <select class="form-control @error('status') is-invalid @enderror" 
                                    id="status" name="status">
                                <option value="Published" {{ old('status', 'Published') == 'Published' ? 'selected' : '' }}>Published</option>
                                <option value="Draft" {{ old('status') == 'Draft' ? 'selected' : '' }}>Draft</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="cover_image">Cover Image</label>
                            <input type="file" class="form-control @error('cover_image') is-invalid @enderror"
                                   id="cover_image" name="cover_image" accept="image/*">
                            @error('cover_image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">Format: JPG, PNG, max 2MB</small>
                        </div>

                        <div class="form-group mb-3">
                            <label for="galeri">Galeri (Multiple Images)</label>
                            <input type="file" class="form-control @error('galeri.*') is-invalid @enderror"
                                   id="galeri" name="galeri[]" accept="image/*" multiple>
                            @error('galeri.*')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">Bisa pilih multiple images, max 2MB per file</small>
                        </div>

                        <div class="form-group mt-4">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Simpan
                            </button>
                            <a href="{{ route('project.index') }}" class="btn btn-secondary">
                                <i class="fas fa-times"></i> Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection