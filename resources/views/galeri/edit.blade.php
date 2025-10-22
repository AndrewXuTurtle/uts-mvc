@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Galeri</h1>
        <a href="{{ route('galeri.show', $galeri->id) }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali
        </a>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Form Edit Galeri</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('galeri.update', $galeri->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="kegiatan_id">Kegiatan *</label>
                            <select class="form-control @error('kegiatan_id') is-invalid @enderror"
                                    id="kegiatan_id" name="kegiatan_id" required>
                                <option value="">Pilih Kegiatan</option>
                                @foreach($kegiatan as $k)
                                    <option value="{{ $k->id }}" {{ old('kegiatan_id', $galeri->kegiatan_id) == $k->id ? 'selected' : '' }}>
                                        {{ $k->judul }}
                                    </option>
                                @endforeach
                            </select>
                            @error('kegiatan_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="file">File (Foto/Video) - Kosongkan jika tidak ingin mengubah</label>
                            <input type="file" class="form-control @error('file') is-invalid @enderror"
                                   id="file" name="file" accept="image/*,video/*">
                            <small class="form-text text-muted">Format yang didukung: JPG, PNG, MP4, MOV, AVI</small>
                            @error('file')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                            @if($galeri->file)
                            <div class="mt-2">
                                <small class="text-muted">File saat ini:</small><br>
                                @if($galeri->tipe === 'foto')
                                    <img src="{{ asset('storage/galeri/' . $galeri->file) }}" alt="Current file" width="100" class="img-thumbnail mt-1">
                                @else
                                    <video width="100" class="img-thumbnail mt-1">
                                        <source src="{{ asset('storage/galeri/' . $galeri->file) }}" type="video/mp4">
                                    </video>
                                @endif
                            </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="tipe">Tipe File *</label>
                            <select class="form-control @error('tipe') is-invalid @enderror"
                                    id="tipe" name="tipe" required>
                                <option value="foto" {{ old('tipe', $galeri->tipe) == 'foto' ? 'selected' : '' }}>Foto</option>
                                <option value="video" {{ old('tipe', $galeri->tipe) == 'video' ? 'selected' : '' }}>Video</option>
                            </select>
                            @error('tipe')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="keterangan">Keterangan</label>
                            <textarea class="form-control @error('keterangan') is-invalid @enderror"
                                      id="keterangan" name="keterangan" rows="3">{{ old('keterangan', $galeri->keterangan) }}</textarea>
                            @error('keterangan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
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