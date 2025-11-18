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
                            <h5><i class="fas fa-tag"></i> Kategori</h5>
                            <p class="text-muted">
                                <span class="badge badge-primary">{{ ucfirst($galeri->kategori) }}</span>
                            </p>
                        </div>
                        <div class="col-md-6">
                            <h5><i class="fas fa-calendar"></i> Tanggal</h5>
                            <p class="text-muted">{{ $galeri->tanggal ? $galeri->tanggal->format('d F Y') : 'N/A' }}</p>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-md-6">
                            <h5><i class="fas fa-camera"></i> Fotografer</h5>
                            <p class="text-muted">{{ $galeri->fotografer ?? 'Tidak diketahui' }}</p>
                        </div>
                        <div class="col-md-6">
                            <h5><i class="fas fa-home"></i> Tampilkan di Home</h5>
                            <p class="text-muted">
                                <span class="badge badge-{{ $galeri->tampilkan_di_home ? 'success' : 'secondary' }}">
                                    {{ $galeri->tampilkan_di_home ? 'Ya' : 'Tidak' }}
                                </span>
                            </p>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-md-6">
                            <h5><i class="fas fa-sort-numeric-up"></i> Urutan</h5>
                            <p class="text-muted">{{ $galeri->urutan }}</p>
                        </div>
                        <div class="col-md-6">
                            <h5><i class="fas fa-clock"></i> Dibuat</h5>
                            <p class="text-muted">{{ $galeri->created_at->format('d F Y H:i') }}</p>
                        </div>
                    </div>

                    @if($galeri->deskripsi)
                    <hr>

                    <div class="row">
                        <div class="col-12">
                            <h5><i class="fas fa-align-left"></i> Deskripsi</h5>
                            <p class="text-muted">{{ $galeri->deskripsi }}</p>
                        </div>
                    </div>
                    @endif

                    <hr>

                    <div class="row">
                        <div class="col-12">
                            <h5><i class="fas fa-image"></i> Foto</h5>
                            <div class="text-center">
                                <img src="{{ asset('storage/galeri/' . $galeri->foto) }}"
                                     alt="{{ $galeri->judul }}" class="img-fluid rounded shadow" style="max-height: 500px;">
                            </div>
                            <p class="text-muted mt-2">
                                <small>Nama file: {{ $galeri->foto }}</small>
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
                    <form action="{{ route('galeri.destroy', $galeri->id) }}" method="POST" class="d-inline w-100">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-block"
                                onclick="return confirm('Apakah Anda yakin ingin menghapus foto galeri ini?')">
                            <i class="fas fa-trash"></i> Hapus Galeri
                        </button>
                    </form>
                </div>
            </div>

            <!-- Related Photos -->
            @php
                $related = \App\Models\Galeri::where('kategori', $galeri->kategori)
                    ->where('id', '!=', $galeri->id)
                    ->orderBy('urutan')
                    ->orderBy('tanggal', 'desc')
                    ->limit(6)
                    ->get();
            @endphp

            @if($related->count() > 0)
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Foto Terkait</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        @foreach($related as $item)
                        <div class="col-6 mb-3">
                            <a href="{{ route('galeri.show', $item->id) }}">
                                <img src="{{ asset('storage/galeri/' . $item->foto) }}"
                                     alt="{{ $item->judul }}" class="img-fluid rounded">
                            </a>
                            <p class="text-xs mt-1 text-center">{{ Str::limit($item->judul, 20) }}</p>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection