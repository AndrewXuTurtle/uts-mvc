@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail Galeri</h1>
        <div>
            <a href="{{ route('galeri.edit', $galeri->id) }}" class="d-none d-sm-inline-block btn btn-sm btn-warning shadow-sm">
                <i class="fas fa-edit fa-sm text-white-50"></i> Edit
            </a>
            <a href="{{ route('galeri.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
                <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <!-- Galeri Details -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Informasi Galeri</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h5><i class="fas fa-calendar"></i> Kegiatan</h5>
                            <p class="text-muted">{{ $galeri->kegiatan->judul ?? 'N/A' }}</p>
                        </div>
                        <div class="col-md-6">
                            <h5><i class="fas fa-file"></i> Tipe File</h5>
                            <p class="text-muted">
                                <span class="badge badge-{{ $galeri->tipe === 'foto' ? 'primary' : 'info' }}">
                                    {{ ucfirst($galeri->tipe) }}
                                </span>
                            </p>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-12">
                            <h5><i class="fas fa-align-left"></i> Keterangan</h5>
                            <p class="text-muted">{{ $galeri->keterangan ?? 'Tidak ada keterangan' }}</p>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-12">
                            <h5><i class="fas fa-image"></i> File</h5>
                            <div class="text-center">
                                @if($galeri->tipe === 'foto')
                                    <img src="{{ asset('storage/galeri/' . $galeri->file) }}"
                                         alt="Galeri" class="img-fluid rounded shadow" style="max-height: 400px;">
                                @else
                                    <video controls class="img-fluid rounded shadow" style="max-height: 400px;">
                                        <source src="{{ asset('storage/galeri/' . $galeri->file) }}" type="video/mp4">
                                        Browser Anda tidak mendukung tag video.
                                    </video>
                                @endif
                            </div>
                            <p class="text-muted mt-2">
                                <small>Nama file: {{ $galeri->file }}</small>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <!-- Actions -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Aksi</h6>
                </div>
                <div class="card-body">
                    <a href="{{ route('galeri.edit', $galeri->id) }}" class="btn btn-warning btn-block mb-2">
                        <i class="fas fa-edit"></i> Edit Galeri
                    </a>
                    <a href="{{ route('kegiatan.show', $galeri->kegiatan_id) }}" class="btn btn-info btn-block mb-2">
                        <i class="fas fa-eye"></i> Lihat Kegiatan
                    </a>
                    <form action="{{ route('galeri.destroy', $galeri->id) }}" method="POST" class="d-inline w-100">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-block"
                                onclick="return confirm('Apakah Anda yakin ingin menghapus galeri ini? File akan dihapus secara permanen.')">
                            <i class="fas fa-trash"></i> Hapus Galeri
                        </button>
                    </form>
                </div>
            </div>

            <!-- File Info -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Informasi File</h6>
                </div>
                <div class="card-body">
                    <div class="text-center">
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $galeri->tipe === 'foto' ? 'Foto' : 'Video' }}</div>
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Tipe File</div>
                    </div>
                    <hr>
                    <p class="text-muted small">
                        <strong>Dibuat:</strong><br>
                        {{ $galeri->created_at->format('d F Y H:i') }}
                    </p>
                    @if($galeri->updated_at != $galeri->created_at)
                    <p class="text-muted small">
                        <strong>Diubah:</strong><br>
                        {{ $galeri->updated_at->format('d F Y H:i') }}
                    </p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection