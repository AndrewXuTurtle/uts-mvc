@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tambah Galeri</h1>
        <a href="{{ route('galeri.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali
        </a>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Form Tambah Galeri</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('galeri.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="kegiatan_id">Kegiatan *</label>
                            <select class="form-control @error('kegiatan_id') is-invalid @enderror"
                                    id="kegiatan_id" name="kegiatan_id" required>
                                <option value="">Pilih Kegiatan</option>
                                @foreach($kegiatan as $k)
                                    <option value="{{ $k->id }}" {{ old('kegiatan_id', request('kegiatan')) == $k->id ? 'selected' : '' }}>
                                        {{ $k->judul }}
                                    </option>
                                @endforeach
                            </select>
                            @error('kegiatan_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="file">File (Foto/Video) *</label>
                            <input type="file" class="form-control @error('file') is-invalid @enderror"
                                   id="file" name="file" accept="image/*,video/*" required>
                            <small class="form-text text-muted">Format yang didukung: JPG, PNG, MP4</small>
                            @error('file')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="tipe">Tipe File *</label>
                            <select class="form-control @error('tipe') is-invalid @enderror"
                                    id="tipe" name="tipe" required>
                                <option value="foto" {{ old('tipe') == 'foto' ? 'selected' : '' }}>Foto</option>
                                <option value="video" {{ old('tipe') == 'video' ? 'selected' : '' }}>Video</option>
                            </select>
                            @error('tipe')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="keterangan">Keterangan</label>
                            <textarea class="form-control @error('keterangan') is-invalid @enderror"
                                      id="keterangan" name="keterangan" rows="3">{{ old('keterangan') }}</textarea>
                            @error('keterangan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
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
    </div>
</div>

<script>
document.getElementById('file').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const fileType = file.type.split('/')[0]; // 'image' or 'video'
        const tipeSelect = document.getElementById('tipe');

        if (fileType === 'image') {
            tipeSelect.value = 'foto';
        } else if (fileType === 'video') {
            tipeSelect.value = 'video';
        }
    }
});
</script>
@endsection