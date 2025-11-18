@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Mahasiswa</h1>
        <a href="{{ route('mahasiswa.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Mahasiswa
        </a>
    </div>

    <!-- Tabs Navigation -->
    <ul class="nav nav-tabs mb-4" id="mahasiswaTab" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link {{ $tab === 'aktif' ? 'active' : '' }}" 
               href="{{ route('mahasiswa.index', ['tab' => 'aktif']) }}">
                <i class="fas fa-user-graduate"></i> Mahasiswa Aktif
                <span class="badge badge-primary">{{ $countAktif }}</span>
            </a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link {{ $tab === 'eligible' ? 'active' : '' }}" 
               href="{{ route('mahasiswa.index', ['tab' => 'eligible']) }}">
                <i class="fas fa-user-check"></i> Eligible untuk Lulus
                <span class="badge badge-warning">{{ $countEligible }}</span>
            </a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link {{ $tab === 'lulus' ? 'active' : '' }}" 
               href="{{ route('mahasiswa.index', ['tab' => 'lulus']) }}">
                <i class="fas fa-graduation-cap"></i> Sudah Lulus
                <span class="badge badge-success">{{ $countLulus }}</span>
            </a>
        </li>
    </ul>

    <!-- Search Form -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Pencarian</h6>
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('mahasiswa.index') }}" class="row g-3">
                <input type="hidden" name="tab" value="{{ $tab }}">
                <div class="col-md-10">
                    <input type="text" class="form-control" name="search"
                           value="{{ request('search') }}" placeholder="Cari nama, NIM, atau prodi...">
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary btn-block">
                        <i class="fas fa-search"></i> Cari
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Data Table -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                @if($tab === 'aktif')
                    Daftar Mahasiswa Aktif
                @elseif($tab === 'eligible')
                    Mahasiswa Eligible untuk Lulus
                @else
                    Mahasiswa yang Sudah Lulus
                @endif
                ({{ $mahasiswa->total() }} data)
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
                            <th>Tahun Masuk</th>
                            @if($tab === 'lulus')
                                <th>Tahun Lulus</th>
                            @endif
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($mahasiswa as $mhs)
                        <tr>
                            <td>{{ $mhs->nim }}</td>
                            <td>{{ $mhs->nama }}</td>
                            <td>{{ $mhs->prodi }}</td>
                            <td>{{ $mhs->tahun_masuk }}</td>
                            @if($tab === 'lulus')
                                <td>{{ $mhs->tahun_lulus ?? '-' }}</td>
                            @endif
                            <td>
                                @if($mhs->status === 'Aktif')
                                    <span class="badge badge-primary">Aktif</span>
                                @elseif($mhs->status === 'Lulus')
                                    <span class="badge badge-success">Lulus</span>
                                @elseif($mhs->status === 'Cuti')
                                    <span class="badge badge-warning">Cuti</span>
                                @elseif($mhs->status === 'DO')
                                    <span class="badge badge-danger">DO</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('mahasiswa.show', $mhs) }}" class="btn btn-info btn-sm" title="Detail">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('mahasiswa.edit', $mhs) }}" class="btn btn-warning btn-sm" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                
                                @if($tab === 'eligible' && $mhs->status === 'Aktif')
                                    <form action="{{ route('mahasiswa.convert-to-alumni', $mhs) }}" method="POST" class="d-inline"
                                          onsubmit="return confirm('Konversi mahasiswa {{ $mhs->nama }} menjadi alumni?')">
                                        @csrf
                                        <button type="submit" class="btn btn-success btn-sm" title="Konversi ke Alumni">
                                            <i class="fas fa-graduation-cap"></i>
                                        </button>
                                    </form>
                                @endif

                                @if($tab === 'aktif')
                                    <form action="{{ route('mahasiswa.destroy', $mhs) }}" method="POST" class="d-inline"
                                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus data mahasiswa ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="{{ $tab === 'lulus' ? '7' : '6' }}" class="text-center text-muted py-4">
                                <i class="fas fa-users fa-3x mb-3"></i>
                                <p>Tidak ada data mahasiswa ditemukan.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($mahasiswa->hasPages())
            <div class="d-flex justify-content-center mt-4">
                {{ $mahasiswa->appends(request()->query())->links() }}
            </div>
            @endif
        </div>
    </div>
</div>
@endsection