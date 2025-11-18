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
                    <form action="{{ route('project.update', $project) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="form-group mb-3">
                            <label for="nim">NIM Mahasiswa <span class="text-danger">*</span></label>
                            <select class="form-control @error('nim') is-invalid @enderror" 
                                    id="nim" name="nim" required>
                                <option value="">-- Pilih Mahasiswa --</option>
                                @foreach(\App\Models\Mahasiswa::orderBy('nama')->get() as $mhs)
                                    <option value="{{ $mhs->nim }}" {{ old('nim', $project->nim) == $mhs->nim ? 'selected' : '' }}>
                                        {{ $mhs->nim }} - {{ $mhs->nama }}
                                    </option>
                                @endforeach
                            </select>
                            @error('nim')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="judul_project">Judul Project <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('judul_project') is-invalid @enderror"
                                   id="judul_project" name="judul_project" value="{{ old('judul_project', $project->judul_project) }}" required>
                            @error('judul_project')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="deskripsi">Deskripsi</label>
                            <textarea class="form-control @error('deskripsi') is-invalid @enderror"
                                      id="deskripsi" name="deskripsi" rows="4">{{ old('deskripsi', $project->deskripsi) }}</textarea>
                            @error('deskripsi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="tahun">Tahun Mulai <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control @error('tahun') is-invalid @enderror"
                                           id="tahun" name="tahun" value="{{ old('tahun', $project->tahun) }}" 
                                           min="2000" max="{{ date('Y') + 1 }}" required>
                                    @error('tahun')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="tahun_selesai">Tahun Selesai</label>
                                    <input type="number" class="form-control @error('tahun_selesai') is-invalid @enderror"
                                           id="tahun_selesai" name="tahun_selesai" value="{{ old('tahun_selesai', $project->tahun_selesai) }}" 
                                           min="2000" max="{{ date('Y') + 5 }}">
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
                                <option value="Web Application" {{ old('kategori', $project->kategori) == 'Web Application' ? 'selected' : '' }}>Web Application</option>
                                <option value="Mobile Application" {{ old('kategori', $project->kategori) == 'Mobile Application' ? 'selected' : '' }}>Mobile Application</option>
                                <option value="Desktop Application" {{ old('kategori', $project->kategori) == 'Desktop Application' ? 'selected' : '' }}>Desktop Application</option>
                                <option value="Game" {{ old('kategori', $project->kategori) == 'Game' ? 'selected' : '' }}>Game</option>
                                <option value="Machine Learning" {{ old('kategori', $project->kategori) == 'Machine Learning' ? 'selected' : '' }}>Machine Learning</option>
                                <option value="IoT" {{ old('kategori', $project->kategori) == 'IoT' ? 'selected' : '' }}>IoT</option>
                                <option value="Lainnya" {{ old('kategori', $project->kategori) == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                            </select>
                            @error('kategori')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="teknologi">Teknologi yang Digunakan</label>
                            <input type="text" class="form-control @error('teknologi') is-invalid @enderror"
                                   id="teknologi" name="teknologi" value="{{ old('teknologi', $project->teknologi) }}" 
                                   placeholder="Contoh: Laravel, Vue.js, MySQL">
                            @error('teknologi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">Pisahkan dengan koma</small>
                        </div>

                        <div class="form-group mb-3">
                            <label for="dosen_pembimbing">Dosen Pembimbing</label>
                            <select class="form-control @error('dosen_pembimbing') is-invalid @enderror" 
                                    id="dosen_pembimbing" name="dosen_pembimbing">
                                <option value="">-- Pilih Dosen --</option>
                                @foreach(\App\Models\Dosen::where('status', 'Aktif')->orderBy('nama')->get() as $dosen)
                                    <option value="{{ $dosen->nama }}" {{ old('dosen_pembimbing', $project->dosen_pembimbing) == $dosen->nama ? 'selected' : '' }}>
                                        {{ $dosen->nama }}
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
                                           id="link_github" name="link_github" value="{{ old('link_github', $project->link_github) }}" 
                                           placeholder="https://github.com/username/repository">
                                    @error('link_github')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="link_demo">Link Demo</label>
                                    <input type="url" class="form-control @error('link_demo') is-invalid @enderror"
                                           id="link_demo" name="link_demo" value="{{ old('link_demo', $project->link_demo) }}" 
                                           placeholder="https://demo.example.com">
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
                                <option value="Published" {{ old('status', $project->status) == 'Published' ? 'selected' : '' }}>Published</option>
                                <option value="Draft" {{ old('status', $project->status) == 'Draft' ? 'selected' : '' }}>Draft</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <hr class="my-4">

                        <div class="form-group mb-3">
                            <label for="cover_image">Cover Image</label>
                            <input type="file" class="form-control-file @error('cover_image') is-invalid @enderror"
                                   id="cover_image" name="cover_image" accept="image/*">
                            @error('cover_image')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah cover image. Maksimal 2MB</small>
                            
                            @if($project->cover_image)
                            <div class="mt-2">
                                <small class="text-muted">Cover image saat ini:</small><br>
                                <img src="{{ Storage::url($project->cover_image) }}" alt="Cover" 
                                     class="img-thumbnail mt-1" style="max-height: 150px; object-fit: cover;">
                            </div>
                            @endif
                        </div>

                        <div class="form-group mb-3">
                            <label for="galeri">Galeri (Multiple Images)</label>
                            <input type="file" class="form-control-file @error('galeri.*') is-invalid @enderror"
                                   id="galeri" name="galeri[]" accept="image/*" multiple>
                            @error('galeri.*')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">Upload gambar tambahan untuk galeri. Maksimal 2MB per file</small>
                            
                            @if($project->galeri && count($project->galeri) > 0)
                            <div class="mt-3">
                                <small class="text-muted">Gambar galeri saat ini ({{ count($project->galeri) }}):</small>
                                <div class="row mt-2">
                                    @foreach($project->galeri as $index => $image)
                                    <div class="col-md-3 mb-2">
                                        <div class="position-relative">
                                            <img src="{{ Storage::url($image) }}" alt="Galeri {{ $index + 1 }}" 
                                                 class="img-thumbnail" style="height: 100px; width: 100%; object-fit: cover;">
                                            <a href="{{ route('project.delete-gallery-image', ['project' => $project->id, 'index' => $index]) }}" 
                                               class="btn btn-danger btn-sm position-absolute" 
                                               style="top: 5px; right: 5px;"
                                               onclick="return confirm('Hapus gambar ini?')">
                                                <i class="fas fa-times"></i>
                                            </a>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @endif
                        </div>

                        <hr class="my-4">

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('project.index') }}" class="btn btn-secondary">
                                <i class="fas fa-times"></i> Batal
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Update Project
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection