@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data PKM (Program Kreativitas Mahasiswa)</h1>
        <a href="{{ route('pkm.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i> Tambah PKM
        </a>
    </div>

    <!-- Search and Filter Form -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Filter & Pencarian</h6>
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('pkm.index') }}" class="row g-3">
                <div class="col-md-3">
                    <label for="search" class="form-label">Pencarian</label>
                    <input type="text" class="form-control" id="search" name="search"
                           value="{{ request('search') }}" placeholder="Cari judul, deskripsi, mitra...">
                </div>
                <div class="col-md-2">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-control" id="status" name="status">
                        <option value="">Semua Status</option>
                        @foreach($statusList as $key => $label)
                            <option value="{{ $key }}" {{ request('status') == $key ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="tahun" class="form-label">Tahun</label>
                    <select class="form-control" id="tahun" name="tahun">
                        <option value="">Semua Tahun</option>
                        @foreach($tahunList as $tahun)
                            <option value="{{ $tahun }}" {{ request('tahun') == $tahun ? 'selected' : '' }}>
                                {{ $tahun }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="dosen_id" class="form-label">Dosen Pembimbing</label>
                    <select class="form-control" id="dosen_id" name="dosen_id">
                        <option value="">Semua Dosen</option>
                        @foreach($dosenList as $dosen)
                            <option value="{{ $dosen->id }}" {{ request('dosen_id') == $dosen->id ? 'selected' : '' }}>
                                {{ $dosen->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="mahasiswa_id" class="form-label">Mahasiswa</label>
                    <select class="form-control" id="mahasiswa_id" name="mahasiswa_id">
                        <option value="">Semua Mahasiswa</option>
                        @foreach($mahasiswaList as $mhs)
                            <option value="{{ $mhs->id }}" {{ request('mahasiswa_id') == $mhs->id ? 'selected' : '' }}>
                                {{ $mhs->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-1">
                    <label class="form-label">&nbsp;</label>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-search"></i>
                        </button>
                        <a href="{{ route('pkm.index') }}" class="btn btn-secondary mt-1">
                            <i class="fas fa-times"></i>
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Data Table -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar PKM ({{ $pkm->total() }} data)</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Judul PKM</th>
                            <th>Mahasiswa</th>
                            <th>Dosen Pembimbing</th>
                            <th>Mitra</th>
                            <th>Status</th>
                            <th>Tahun</th>
                            <th>Biaya</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pkm as $item)
                        <tr>
                            <td>
                                <div>
                                    <strong>{{ Str::limit($item->judul, 40) }}</strong>
                                    @if($item->deskripsi)
                                        <br><small class="text-muted">{{ Str::limit($item->deskripsi, 50) }}</small>
                                    @endif
                                </div>
                            </td>
                            <td>
                                @if($item->mahasiswa->count() > 0)
                                    @foreach($item->mahasiswa as $mhs)
                                        {{ $mhs->nama }}
                                        @if(!$loop->last)
                                            <br>
                                        @endif
                                    @endforeach
                                @else
                                    <span class="text-muted">N/A</span>
                                @endif
                            </td>
                            <td>
                                @if($item->dosen->count() > 0)
                                    @foreach($item->dosen as $d)
                                        {{ $d->nama }}
                                        @if(!$loop->last)
                                            <br>
                                        @endif
                                    @endforeach
                                @else
                                    <span class="text-muted">N/A</span>
                                @endif
                            </td>
                            <td>{{ $item->mitra ?? '-' }}</td>
                            <td>
                                <span class="badge badge-{{ $item->status_badge }}">
                                    {{ $item->status_label }}
                                </span>
                            </td>
                            <td>{{ $item->tahun }}</td>
                            <td>{{ $item->biaya_formatted }}</td>
                            <td>
                                <a href="{{ route('pkm.show', $item) }}" class="btn btn-info btn-sm">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('pkm.edit', $item) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('pkm.destroy', $item) }}" method="POST" class="d-inline"
                                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus data PKM ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted py-4">
                                <i class="fas fa-lightbulb fa-3x mb-3"></i>
                                <p>Tidak ada data PKM ditemukan.</p>
                                <a href="{{ route('pkm.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus"></i> Tambah PKM Pertama
                                </a>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($pkm->hasPages())
            <div class="d-flex justify-content-center mt-4">
                {{ $pkm->appends(request()->query())->links() }}
            </div>
            @endif
        </div>
    </div>
</div>
@endsection