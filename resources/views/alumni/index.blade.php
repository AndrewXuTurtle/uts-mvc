@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Alumni</h1>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <!-- Tabs Navigation -->
    <ul class="nav nav-tabs mb-4" id="alumniTab" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link {{ $tab === 'lengkap' ? 'active' : '' }}" 
               href="{{ route('alumni.index', ['tab' => 'lengkap']) }}">
                <i class="fas fa-check-circle"></i> Data Lengkap
                <span class="badge badge-success">{{ $countLengkap }}</span>
            </a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link {{ $tab === 'belum_lengkap' ? 'active' : '' }}" 
               href="{{ route('alumni.index', ['tab' => 'belum_lengkap']) }}">
                <i class="fas fa-exclamation-circle"></i> Belum Lengkap
                <span class="badge badge-warning">{{ $countBelumLengkap }}</span>
            </a>
        </li>
    </ul>

    <!-- Search Form -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Pencarian</h6>
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('alumni.index') }}" class="row g-3">
                <input type="hidden" name="tab" value="{{ $tab }}">
                <div class="col-md-10">
                    <input type="text" class="form-control" name="search"
                           value="{{ request('search') }}" placeholder="Cari NIM atau nama alumni...">
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary btn-block">
                        <i class="fas fa-search"></i> Cari
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- DataTable -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                @if($tab === 'lengkap')
                    Alumni dengan Data Lengkap
                @else
                    Alumni dengan Data Belum Lengkap
                @endif
                ({{ $alumni->total() }} data)
            </h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>NIM</th>
                            <th>Nama</th>
                            <th>Prodi</th>
                            <th>Email</th>
                            <th>Status Data</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($alumni as $item)
                            <tr>
                                <td>{{ $item->nim }}</td>
                                <td>{{ $item->mahasiswa->nama ?? 'N/A' }}</td>
                                <td>{{ $item->mahasiswa->prodi ?? 'N/A' }}</td>
                                <td>{{ $item->email ?? '-' }}</td>
                                <td>
                                    @if($item->status_data === 'Lengkap')
                                        <span class="badge badge-success">Lengkap</span>
                                    @else
                                        <span class="badge badge-warning">Belum Lengkap</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('alumni.show', $item->id) }}" class="btn btn-sm btn-info" title="Detail">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('alumni.edit', $item->id) }}" class="btn btn-sm btn-warning" title="Edit & Lengkapi">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" 
                                            data-target="#deleteModal{{ $item->id }}" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>

                                    <!-- Delete Modal -->
                                    <div class="modal fade" id="deleteModal{{ $item->id }}" tabindex="-1" role="dialog">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Konfirmasi Hapus</h5>
                                                    <button type="button" class="close" data-dismiss="modal">
                                                        <span>&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    Apakah Anda yakin ingin menghapus data alumni <strong>{{ $item->mahasiswa->nama ?? 'N/A' }}</strong>?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                    <form action="{{ route('alumni.destroy', $item->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-4">
                                    <i class="fas fa-users fa-3x mb-3"></i>
                                    <p>Tidak ada data alumni ditemukan.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($alumni->hasPages())
            <div class="d-flex justify-content-center mt-4">
                {{ $alumni->appends(request()->query())->links() }}
            </div>
            @endif
        </div>
    </div>
</div>
@endsection