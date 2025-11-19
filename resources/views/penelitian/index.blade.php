@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Penelitian</h1>
        <a href="{{ route('penelitian.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Penelitian
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
            <h6 class="m-0 font-weight-bold text-primary">Filter Data Penelitian</h6>
        </div>
        <div class="card-body">
            <form method="GET" class="form-inline">
                <div class="form-group mr-3">
                    <label for="status" class="mr-2">Status:</label>
                    <select name="status" id="status" class="form-control">
                        <option value="">Semua Status</option>
                        @foreach($statusList as $status)
                        <option value="{{ $status }}" {{ request('status') == $status ? 'selected' : '' }}>
                            {{ ucfirst($status) }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group mr-3">
                    <label for="tahun" class="mr-2">Tahun:</label>
                    <select name="tahun" id="tahun" class="form-control">
                        <option value="">Semua Tahun</option>
                        @foreach($tahunList as $tahun)
                        <option value="{{ $tahun }}" {{ request('tahun') == $tahun ? 'selected' : '' }}>
                            {{ $tahun }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group mr-3">
                    <label for="ketua_peneliti_id" class="mr-2">Ketua Peneliti:</label>
                    <select name="ketua_peneliti_id" id="ketua_peneliti_id" class="form-control">
                        <option value="">Semua Dosen</option>
                        @foreach($dosenList as $dosen)
                        <option value="{{ $dosen->id }}" {{ request('ketua_peneliti_id') == $dosen->id ? 'selected' : '' }}>
                            {{ $dosen->nama }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group mr-3">
                    <label for="search" class="mr-2">Cari:</label>
                    <input type="text" name="search" id="search" class="form-control"
                           value="{{ request('search') }}" placeholder="Judul, deskripsi, bidang...">
                </div>
                <button type="submit" class="btn btn-primary mr-2">
                    <i class="fas fa-search"></i> Filter
                </button>
                <a href="{{ route('penelitian.index') }}" class="btn btn-secondary">
                    <i class="fas fa-times"></i> Reset
                </a>
            </form>
        </div>
    </div>

    <!-- Data Table -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Penelitian</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Judul</th>
                            <th>Ketua Peneliti</th>
                            <th>Jenis</th>
                            <th>Tahun</th>
                            <th>Status</th>
                            <th>Dana</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($penelitian as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>
                                <strong>{{ Str::limit($item->judul_penelitian, 50) }}</strong>
                                @if($item->deskripsi)
                                <br><small class="text-muted">{{ Str::limit($item->deskripsi, 80) }}</small>
                                @endif
                            </td>
                            <td>{{ $item->ketuaPeneliti->nama ?? 'N/A' }}</td>
                            <td>{{ $item->jenis_penelitian ?? '-' }}</td>
                            <td>{{ $item->tahun }}</td>
                            <td>
                                <span class="badge badge-{{ $item->status == 'Selesai' ? 'success' : ($item->status == 'Sedang Berjalan' ? 'primary' : 'secondary') }}">
                                    {{ $item->status }}
                                </span>
                            </td>
                            <td>
                                @if($item->dana)
                                    Rp {{ number_format($item->dana, 0, ',', '.') }}
                                    @if($item->sumber_dana)
                                    <br><small class="text-muted">{{ $item->sumber_dana }}</small>
                                    @endif
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('penelitian.show', $item->id) }}" class="btn btn-info btn-sm">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('penelitian.edit', $item->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('penelitian.destroy', $item->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus data penelitian ini?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-3">
                {{ $penelitian->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
</div>
@endsection