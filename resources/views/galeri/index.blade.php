@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Galeri Foto</h1>
        <a href="{{ route('galeri.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Foto
        </a>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    <!-- Filter -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Filter Galeri</h6>
        </div>
        <div class="card-body">
            <form method="GET" class="form-inline">
                <div class="form-group mr-3">
                    <label for="kategori" class="mr-2">Kategori:</label>
                    <select name="kategori" id="kategori" class="form-control">
                        <option value="">Semua Kategori</option>
                        @foreach($kategoriList as $kat)
                        <option value="{{ $kat }}" {{ request('kategori') == $kat ? 'selected' : '' }}>
                            {{ ucfirst($kat) }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group mr-3">
                    <label for="search" class="mr-2">Cari:</label>
                    <input type="text" name="search" id="search" class="form-control"
                           value="{{ request('search') }}" placeholder="Judul, deskripsi, fotografer...">
                </div>
                <button type="submit" class="btn btn-primary mr-2">
                    <i class="fas fa-search"></i> Filter
                </button>
                <a href="{{ route('galeri.index') }}" class="btn btn-secondary">
                    <i class="fas fa-times"></i> Reset
                </a>
            </form>
        </div>
    </div>

    <!-- Gallery Grid -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Foto Galeri</h6>
        </div>
        <div class="card-body">
            @if($galeri->count() > 0)
                <div class="row">
                    @foreach($galeri as $item)
                    <div class="col-md-3 mb-4">
                        <div class="card h-100">
                            <div class="position-relative">
                                <img src="{{ asset('storage/galeri/' . $item->foto) }}"
                                     alt="{{ $item->judul }}" class="card-img-top" style="height: 200px; object-fit: cover;">

                                @if($item->tampilkan_di_home)
                                <span class="badge badge-success position-absolute" style="top: 10px; left: 10px;">
                                    <i class="fas fa-home"></i> Homepage
                                </span>
                                @endif

                                <span class="badge badge-primary position-absolute" style="top: 10px; right: 10px;">
                                    {{ ucfirst($item->kategori) }}
                                </span>
                            </div>

                            <div class="card-body d-flex flex-column">
                                <h6 class="card-title">{{ Str::limit($item->judul, 40) }}</h6>

                                @if($item->deskripsi)
                                <p class="card-text text-muted small">{{ Str::limit($item->deskripsi, 60) }}</p>
                                @endif

                                <div class="mt-auto">
                                    <div class="text-muted small mb-2">
                                        @if($item->tanggal)
                                        <i class="fas fa-calendar"></i> {{ $item->tanggal->format('d/m/Y') }}
                                        @endif
                                        @if($item->fotografer)
                                        <br><i class="fas fa-camera"></i> {{ $item->fotografer }}
                                        @endif
                                    </div>

                                    <div class="btn-group btn-group-sm w-100" role="group">
                                        <a href="{{ route('galeri.show', $item->id) }}" class="btn btn-info">
                                            <i class="fas fa-eye"></i> Lihat
                                        </a>
                                        <a href="{{ route('galeri.edit', $item->id) }}" class="btn btn-warning">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <form action="{{ route('galeri.destroy', $item->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger"
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus foto ini?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-center">
                    {{ $galeri->appends(request()->query())->links() }}
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-images fa-3x text-muted mb-3"></i>
                    <h5 class="text-muted">Belum ada foto galeri</h5>
                    <p class="text-muted">Tambahkan foto pertama untuk memulai galeri Anda.</p>
                    <a href="{{ route('galeri.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Tambah Foto Pertama
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection