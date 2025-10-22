@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail Kegiatan</h1>
        <div>
            <a href="{{ route('kegiatan.edit', $kegiatan->id) }}" class="d-none d-sm-inline-block btn btn-sm btn-warning shadow-sm">
                <i class="fas fa-edit fa-sm text-white-50"></i> Edit
            </a>
            <a href="{{ route('kegiatan.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
                <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <!-- Kegiatan Details -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Informasi Kegiatan</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h5><i class="fas fa-tag"></i> Judul</h5>
                            <p class="text-muted">{{ $kegiatan->judul }}</p>
                        </div>
                        <div class="col-md-6">
                            <h5><i class="fas fa-calendar"></i> Tanggal</h5>
                            <p class="text-muted">
                                {{ $kegiatan->tanggal ? \Carbon\Carbon::parse($kegiatan->tanggal)->format('d F Y') : '-' }}
                            </p>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-md-6">
                            <h5><i class="fas fa-map-marker-alt"></i> Lokasi</h5>
                            <p class="text-muted">{{ $kegiatan->lokasi ?? '-' }}</p>
                        </div>
                        <div class="col-md-6">
                            <h5><i class="fas fa-images"></i> Jumlah Galeri</h5>
                            <p class="text-muted">{{ $kegiatan->galeri->count() }} item</p>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-12">
                            <h5><i class="fas fa-align-left"></i> Deskripsi</h5>
                            <p class="text-muted">{{ $kegiatan->deskripsi ?? 'Tidak ada deskripsi' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <!-- Galeri Preview -->
            @if($kegiatan->galeri->count() > 0)
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Galeri Kegiatan</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        @foreach($kegiatan->galeri->take(6) as $galeri)
                        <div class="col-6 mb-3">
                            @if($galeri->tipe === 'foto')
                                <img src="{{ asset('storage/galeri/' . $galeri->file) }}"
                                     alt="Galeri" class="img-fluid rounded" style="width: 100%; height: 80px; object-fit: cover;">
                            @else
                                <video class="img-fluid rounded" style="width: 100%; height: 80px; object-fit: cover;">
                                    <source src="{{ asset('storage/galeri/' . $galeri->file) }}" type="video/mp4">
                                </video>
                            @endif
                        </div>
                        @endforeach
                    </div>
                    @if($kegiatan->galeri->count() > 6)
                    <div class="text-center mt-3">
                        <a href="{{ route('galeri.index') }}?kegiatan={{ $kegiatan->id }}" class="btn btn-sm btn-primary">
                            Lihat Semua Galeri
                        </a>
                    </div>
                    @endif
                </div>
            </div>
            @endif

            <!-- Actions -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Aksi</h6>
                </div>
                <div class="card-body">
                    <a href="{{ route('galeri.create') }}?kegiatan={{ $kegiatan->id }}" class="btn btn-success btn-block mb-2">
                        <i class="fas fa-plus"></i> Tambah Galeri
                    </a>
                    <form action="{{ route('kegiatan.destroy', $kegiatan->id) }}" method="POST" class="d-inline w-100">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-block"
                                onclick="return confirm('Apakah Anda yakin ingin menghapus kegiatan ini? Semua galeri terkait juga akan dihapus.')">
                            <i class="fas fa-trash"></i> Hapus Kegiatan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection