@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Kisah Sukses</h1>
        <a href="{{ route('kisah-sukses.index') }}" class="btn btn-sm btn-secondary">
            <i class="fas fa-arrow-left"></i> Kembali
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

                <div class="alert alert-info">
                    <strong>Alumni:</strong> {{ $kisahSukses->mahasiswa->nama ?? 'N/A' }} ({{ $kisahSukses->nim }})
                </div>

                <input type="hidden" name="nim" value="{{ $kisahSukses->nim }}">

                <div class="form-group">
                    <label for="judul">Judul <span class="text-danger">*</span></label>
                    <input type="text" name="judul" id="judul" class="form-control @error('judul') is-invalid @enderror" 
                           value="{{ old('judul', $kisahSukses->judul) }}" required maxlength="255">
                    @error('judul')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="kisah">Kisah Sukses <span class="text-danger">*</span></label>
                    <textarea name="kisah" id="kisah" rows="10" class="form-control @error('kisah') is-invalid @enderror" required>{{ old('kisah', $kisahSukses->kisah) }}</textarea>
                    <small class="form-text text-muted">Ceritakan perjalanan sukses alumni</small>
                    @error('kisah')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="pencapaian">Pencapaian</label>
                            <input type="text" name="pencapaian" id="pencapaian" class="form-control @error('pencapaian') is-invalid @enderror" 
                                   value="{{ old('pencapaian', $kisahSukses->pencapaian) }}" maxlength="255" placeholder="Contoh: CEO di Perusahaan X">
                            <small class="form-text text-muted">Posisi/pencapaian saat ini</small>
                            @error('pencapaian')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tahun_pencapaian">Tahun Pencapaian</label>
                            <input type="number" name="tahun_pencapaian" id="tahun_pencapaian" 
                                   class="form-control @error('tahun_pencapaian') is-invalid @enderror" 
                                   value="{{ old('tahun_pencapaian', $kisahSukses->tahun_pencapaian) }}" 
                                   min="2000" max="{{ date('Y') + 1 }}">
                            @error('tahun_pencapaian')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="foto">Foto</label>
                            @if($kisahSukses->foto)
                                <div class="mb-2">
                                    <img src="{{ asset('storage/' . $kisahSukses->foto) }}" alt="Foto" class="img-thumbnail" style="max-width: 200px;">
                                </div>
                            @endif
                            <input type="file" name="foto" id="foto" class="form-control-file @error('foto') is-invalid @enderror" accept="image/jpeg,image/png,image/jpg">
                            <small class="form-text text-muted">Biarkan kosong jika tidak ingin mengubah. Max 2MB (JPEG, PNG, JPG)</small>
                            @error('foto')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="status">Status <span class="text-danger">*</span></label>
                            <select name="status" id="status" class="form-control @error('status') is-invalid @enderror" required>
                                <option value="Draft" {{ old('status', $kisahSukses->status) == 'Draft' ? 'selected' : '' }}>Draft</option>
                                <option value="Published" {{ old('status', $kisahSukses->status) == 'Published' ? 'selected' : '' }}>Published</option>
                            </select>
                            @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <hr>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Update
                    </button>
                    <a href="{{ route('kisah-sukses.show', $kisahSukses->id) }}" class="btn btn-secondary">
                        <i class="fas fa-times"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
