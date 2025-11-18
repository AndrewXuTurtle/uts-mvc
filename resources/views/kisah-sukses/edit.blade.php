@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Kisah Sukses</h1>
        <a href="{{ route('kisah-sukses.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali
        </a>
    </div>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Form Edit Kisah Sukses</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('kisah-sukses.update', $kisahSukses->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nim">NIM <span class="text-danger">*</span></label>
                            <input type="text" 
                                   name="nim" 
                                   id="nim" 
                                   class="form-control @error('nim') is-invalid @enderror" 
                                   value="{{ old('nim', $kisahSukses->nim) }}" 
                                   required
                                   readonly>
                            @error('nim')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">NIM: {{ $kisahSukses->mahasiswa->nama ?? 'N/A' }}</small>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="kategori">Kategori <span class="text-danger">*</span></label>
                            <select name="kategori" id="kategori" class="form-control @error('kategori') is-invalid @enderror" required>
                                <option value="">Pilih Kategori</option>
                                <option value="karir" {{ old('kategori', $kisahSukses->kategori) == 'karir' ? 'selected' : '' }}>Karir</option>
                                <option value="wirausaha" {{ old('kategori', $kisahSukses->kategori) == 'wirausaha' ? 'selected' : '' }}>Wirausaha</option>
                                <option value="prestasi" {{ old('kategori', $kisahSukses->kategori) == 'prestasi' ? 'selected' : '' }}>Prestasi</option>
                                <option value="melanjutkan_studi" {{ old('kategori', $kisahSukses->kategori) == 'melanjutkan_studi' ? 'selected' : '' }}>Melanjutkan Studi</option>
                            </select>
                            @error('kategori')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="judul">Judul <span class="text-danger">*</span></label>
                    <input type="text" name="judul" id="judul" class="form-control @error('judul') is-invalid @enderror" 
                           value="{{ old('judul', $kisahSukses->judul) }}" required maxlength="255">
                    @error('judul')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="cerita">Cerita <span class="text-danger">*</span></label>
                    <textarea name="cerita" id="cerita" rows="10" class="form-control @error('cerita') is-invalid @enderror" required>{{ old('cerita', $kisahSukses->cerita) }}</textarea>
                    @error('cerita')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="quote">Quote</label>
                    <textarea name="quote" id="quote" rows="3" class="form-control @error('quote') is-invalid @enderror">{{ old('quote', $kisahSukses->quote) }}</textarea>
                    @error('quote')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="foto_utama">Foto Utama</label>
                            @if($kisahSukses->foto_utama)
                            <div class="mb-2">
                                <img src="{{ Storage::url($kisahSukses->foto_utama) }}" alt="Foto Utama" style="max-width: 200px; max-height: 200px;">
                            </div>
                            @endif
                            <input type="file" name="foto_utama" id="foto_utama" class="form-control-file @error('foto_utama') is-invalid @enderror" accept="image/jpeg,image/png,image/jpg">
                            <small class="form-text text-muted">Max 2MB (JPEG, PNG, JPG). Kosongkan jika tidak ingin mengubah.</small>
                            @error('foto_utama')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="galeri_foto">Galeri Foto (Multiple)</label>
                            @if($kisahSukses->galeri_foto && count($kisahSukses->galeri_foto) > 0)
                            <div class="mb-2">
                                @foreach($kisahSukses->galeri_foto as $foto)
                                <img src="{{ Storage::url($foto) }}" alt="Galeri" style="max-width: 100px; max-height: 100px; margin-right: 5px;">
                                @endforeach
                            </div>
                            <div class="custom-control custom-checkbox mb-2">
                                <input type="checkbox" name="replace_galeri" id="replace_galeri" class="custom-control-input" value="1">
                                <label class="custom-control-label" for="replace_galeri">
                                    Replace semua galeri foto yang ada
                                </label>
                            </div>
                            @endif
                            <input type="file" name="galeri_foto[]" id="galeri_foto" class="form-control-file @error('galeri_foto') is-invalid @enderror" 
                                   accept="image/jpeg,image/png,image/jpg" multiple>
                            <small class="form-text text-muted">Max 2MB per foto (JPEG, PNG, JPG)</small>
                            @error('galeri_foto')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="video_url">Video URL (YouTube/Vimeo)</label>
                    <input type="url" name="video_url" id="video_url" class="form-control @error('video_url') is-invalid @enderror" 
                           value="{{ old('video_url', $kisahSukses->video_url) }}" placeholder="https://youtube.com/watch?v=...">
                    @error('video_url')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="tags">Tags (pisahkan dengan koma)</label>
                    <input type="text" name="tags" id="tags" class="form-control @error('tags') is-invalid @enderror" 
                           value="{{ old('tags', is_array($kisahSukses->tags) ? implode(', ', $kisahSukses->tags) : '') }}" 
                           placeholder="startup, international, tech-company">
                    <small class="form-text text-muted">Contoh: startup, international, tech-company</small>
                    @error('tags')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="tanggal_publish">Tanggal Publish <span class="text-danger">*</span></label>
                            <input type="date" name="tanggal_publish" id="tanggal_publish" 
                                   class="form-control @error('tanggal_publish') is-invalid @enderror" 
                                   value="{{ old('tanggal_publish', $kisahSukses->tanggal_publish) }}" required>
                            @error('tanggal_publish')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="status">Status <span class="text-danger">*</span></label>
                            <select name="status" id="status" class="form-control @error('status') is-invalid @enderror" required>
                                <option value="draft" {{ old('status', $kisahSukses->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                                <option value="published" {{ old('status', $kisahSukses->status) == 'published' ? 'selected' : '' }}>Published</option>
                                <option value="archived" {{ old('status', $kisahSukses->status) == 'archived' ? 'selected' : '' }}>Archived</option>
                            </select>
                            @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>&nbsp;</label>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" name="is_featured" id="is_featured" class="custom-control-input" 
                                       value="1" {{ old('is_featured', $kisahSukses->is_featured) ? 'checked' : '' }}>
                                <label class="custom-control-label" for="is_featured">
                                    <i class="fas fa-star text-warning"></i> Featured Story
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="alert alert-info">
                    <strong>Info:</strong> Total Views: {{ number_format($kisahSukses->views) }}
                </div>

                <div class="form-group mt-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Update
                    </button>
                    <a href="{{ route('kisah-sukses.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
