@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Kisah Sukses Alumni</h1>
        <a href="{{ route('kisah-sukses.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Kisah Sukses
        </a>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden-true">&times;</span>
        </button>
    </div>
    @endif

    <!-- Filter -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Filter Data</h6>
        </div>
        <div class="card-body">
            <form method="GET" class="form-inline">
                <div class="form-group mr-3">
                    <label for="kategori" class="mr-2">Kategori:</label>
                    <select name="kategori" id="kategori" class="form-control">
                        <option value="">Semua Kategori</option>
                        <option value="karir" {{ request('kategori') == 'karir' ? 'selected' : '' }}>Karir</option>
                        <option value="wirausaha" {{ request('kategori') == 'wirausaha' ? 'selected' : '' }}>Wirausaha</option>
                        <option value="prestasi" {{ request('kategori') == 'prestasi' ? 'selected' : '' }}>Prestasi</option>
                        <option value="melanjutkan_studi" {{ request('kategori') == 'melanjutkan_studi' ? 'selected' : '' }}>Melanjutkan Studi</option>
                    </select>
                </div>
                <div class="form-group mr-3">
                    <label for="status" class="mr-2">Status:</label>
                    <select name="status" id="status" class="form-control">
                        <option value="">Semua Status</option>
                        <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                        <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>Published</option>
                        <option value="archived" {{ request('status') == 'archived' ? 'selected' : '' }}>Archived</option>
                    </select>
                </div>
                <div class="form-group mr-3">
                    <input type="text" name="search" class="form-control" placeholder="Cari judul/alumni..." value="{{ request('search') }}">
                </div>
                <button type="submit" class="btn btn-primary">Filter</button>
                <a href="{{ route('kisah-sukses.index') }}" class="btn btn-secondary ml-2">Reset</a>
            </form>
        </div>
    </div>

    <!-- Data Table -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Kisah Sukses</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Foto</th>
                            <th>Judul</th>
                            <th>Alumni</th>
                            <th>Kategori</th>
                            <th>Status</th>
                            <th>Featured</th>
                            <th>Views</th>
                            <th>Tanggal Publish</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($kisahSukses as $item)
                        <tr>
                            <td>{{ $loop->iteration + ($kisahSukses->currentPage() - 1) * $kisahSukses->perPage() }}</td>
                            <td>
                                @if($item->foto_utama)
                                <img src="{{ Storage::url($item->foto_utama) }}" alt="{{ $item->judul }}" style="width: 60px; height: 60px; object-fit: cover;">
                                @else
                                <span class="text-muted">No Image</span>
                                @endif
                            </td>
                            <td>{{ Str::limit($item->judul, 50) }}</td>
                            <td>{{ $item->mahasiswa->nama ?? '-' }}</td>
                            <td>
                                <span class="badge badge-info">
                                    {{ ucwords(str_replace('_', ' ', $item->kategori)) }}
                                </span>
                            </td>
                            <td>
                                @if($item->status == 'published')
                                <span class="badge badge-success">Published</span>
                                @elseif($item->status == 'draft')
                                <span class="badge badge-warning">Draft</span>
                                @else
                                <span class="badge badge-secondary">Archived</span>
                                @endif
                            </td>
                            <td>
                                @if($item->is_featured)
                                <i class="fas fa-star text-warning"></i>
                                @else
                                <i class="far fa-star text-muted"></i>
                                @endif
                            </td>
                            <td>{{ number_format($item->views) }}</td>
                            <td>{{ date('d M Y', strtotime($item->tanggal_publish)) }}</td>
                            <td class="text-nowrap">
                                <a href="{{ route('kisah-sukses.show', $item->id) }}" class="btn btn-info btn-sm" title="Detail">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('kisah-sukses.edit', $item->id) }}" class="btn btn-warning btn-sm" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('kisah-sukses.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="10" class="text-center">Tidak ada data</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-3">
                {{ $kisahSukses->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
