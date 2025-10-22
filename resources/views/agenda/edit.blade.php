@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Agenda</h1>
        <a href="{{ route('agenda.index') }}" class="btn btn-secondary btn-sm">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('agenda.update', $agenda->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="form-group">
                    <label for="judul">Judul Agenda <span class="text-danger">*</span></label>
                    <input type="text" name="judul" id="judul" class="form-control @error('judul') is-invalid @enderror" value="{{ old('judul', $agenda->judul) }}" required>
                    @error('judul')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="deskripsi">Deskripsi</label>
                    <textarea name="deskripsi" id="deskripsi" rows="4" class="form-control @error('deskripsi') is-invalid @enderror">{{ old('deskripsi', $agenda->deskripsi) }}</textarea>
                    @error('deskripsi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="kategori">Kategori <span class="text-danger">*</span></label>
                        <select name="kategori" id="kategori" class="form-control @error('kategori') is-invalid @enderror" required>
                            <option value="">Pilih Kategori</option>
                            <option value="seminar" {{ old('kategori', $agenda->kategori) == 'seminar' ? 'selected' : '' }}>Seminar</option>
                            <option value="workshop" {{ old('kategori', $agenda->kategori) == 'workshop' ? 'selected' : '' }}>Workshop</option>
                            <option value="rapat" {{ old('kategori', $agenda->kategori) == 'rapat' ? 'selected' : '' }}>Rapat</option>
                            <option value="acara" {{ old('kategori', $agenda->kategori) == 'acara' ? 'selected' : '' }}>Acara</option>
                            <option value="lainnya" {{ old('kategori', $agenda->kategori) == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                        </select>
                        @error('kategori')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group col-md-6">
                        <label for="penyelenggara">Penyelenggara</label>
                        <input type="text" name="penyelenggara" id="penyelenggara" class="form-control @error('penyelenggara') is-invalid @enderror" value="{{ old('penyelenggara', $agenda->penyelenggara) }}">
                        @error('penyelenggara')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="tanggal_mulai">Tanggal & Waktu Mulai <span class="text-danger">*</span></label>
                        <input type="datetime-local" name="tanggal_mulai" id="tanggal_mulai" class="form-control @error('tanggal_mulai') is-invalid @enderror" value="{{ old('tanggal_mulai', $agenda->tanggal_mulai?->format('Y-m-d\TH:i')) }}" required>
                        @error('tanggal_mulai')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group col-md-6">
                        <label for="tanggal_selesai">Tanggal & Waktu Selesai</label>
                        <input type="datetime-local" name="tanggal_selesai" id="tanggal_selesai" class="form-control @error('tanggal_selesai') is-invalid @enderror" value="{{ old('tanggal_selesai', $agenda->tanggal_selesai?->format('Y-m-d\TH:i')) }}">
                        @error('tanggal_selesai')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="lokasi">Lokasi</label>
                    <input type="text" name="lokasi" id="lokasi" class="form-control @error('lokasi') is-invalid @enderror" value="{{ old('lokasi', $agenda->lokasi) }}">
                    @error('lokasi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="gambar">Gambar</label>
                    @if($agenda->gambar)
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $agenda->gambar) }}" alt="Current Image" style="max-width: 200px;">
                        </div>
                    @endif
                    <input type="file" name="gambar" id="gambar" class="form-control-file @error('gambar') is-invalid @enderror" accept="image/*">
                    @error('gambar')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="form-text text-muted">Biarkan kosong jika tidak ingin mengubah gambar</small>
                </div>

                <div class="form-group">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="aktif" name="aktif" value="1" {{ old('aktif', $agenda->aktif) ? 'checked' : '' }}>
                        <label class="custom-control-label" for="aktif">Aktif</label>
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Update
                    </button>
                    <a href="{{ route('agenda.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
