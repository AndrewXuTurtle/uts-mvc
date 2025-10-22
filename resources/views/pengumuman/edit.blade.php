@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Pengumuman</h1>
        <a href="{{ route('pengumuman.index') }}" class="btn btn-secondary btn-sm">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('pengumuman.update', $pengumuman->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="form-group">
                    <label for="judul">Judul Pengumuman <span class="text-danger">*</span></label>
                    <input type="text" name="judul" id="judul" class="form-control @error('judul') is-invalid @enderror" value="{{ old('judul', $pengumuman->judul) }}" required>
                    @error('judul')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="isi">Isi Pengumuman <span class="text-danger">*</span></label>
                    <textarea name="isi" id="isi" rows="5" class="form-control @error('isi') is-invalid @enderror" required>{{ old('isi', $pengumuman->isi) }}</textarea>
                    @error('isi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="prioritas">Prioritas <span class="text-danger">*</span></label>
                        <select name="prioritas" id="prioritas" class="form-control @error('prioritas') is-invalid @enderror" required>
                            <option value="">Pilih Prioritas</option>
                            <option value="rendah" {{ old('prioritas', $pengumuman->prioritas) == 'rendah' ? 'selected' : '' }}>Rendah</option>
                            <option value="sedang" {{ old('prioritas', $pengumuman->prioritas) == 'sedang' ? 'selected' : '' }}>Sedang</option>
                            <option value="tinggi" {{ old('prioritas', $pengumuman->prioritas) == 'tinggi' ? 'selected' : '' }}>Tinggi</option>
                        </select>
                        @error('prioritas')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group col-md-6">
                        <label for="penulis">Penulis <span class="text-danger">*</span></label>
                        <input type="text" name="penulis" id="penulis" class="form-control @error('penulis') is-invalid @enderror" value="{{ old('penulis', $pengumuman->penulis) }}" required>
                        @error('penulis')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="tanggal_mulai">Tanggal Mulai <span class="text-danger">*</span></label>
                        <input type="date" name="tanggal_mulai" id="tanggal_mulai" class="form-control @error('tanggal_mulai') is-invalid @enderror" value="{{ old('tanggal_mulai', $pengumuman->tanggal_mulai?->format('Y-m-d')) }}" required>
                        @error('tanggal_mulai')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group col-md-6">
                        <label for="tanggal_selesai">Tanggal Selesai</label>
                        <input type="date" name="tanggal_selesai" id="tanggal_selesai" class="form-control @error('tanggal_selesai') is-invalid @enderror" value="{{ old('tanggal_selesai', $pengumuman->tanggal_selesai?->format('Y-m-d')) }}">
                        @error('tanggal_selesai')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="gambar">Gambar</label>
                    @if($pengumuman->gambar)
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $pengumuman->gambar) }}" alt="Current Image" style="max-width: 200px;">
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
                        <input type="checkbox" class="custom-control-input" id="aktif" name="aktif" value="1" {{ old('aktif', $pengumuman->aktif) ? 'checked' : '' }}>
                        <label class="custom-control-label" for="aktif">Aktif</label>
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Update
                    </button>
                    <a href="{{ route('pengumuman.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
