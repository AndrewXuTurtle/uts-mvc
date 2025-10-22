@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Alumni</h1>
        <a href="{{ route('alumni.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Alumni
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

    <!-- Filter Section -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Filter Data Alumni</h6>
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('alumni.index') }}">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="tahun_lulus">Tahun Lulus</label>
                            <select name="tahun_lulus" id="tahun_lulus" class="form-control">
                                <option value="">Semua Tahun</option>
                                @foreach($tahunList as $tahun)
                                    <option value="{{ $tahun }}" {{ request('tahun_lulus') == $tahun ? 'selected' : '' }}>
                                        {{ $tahun }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="program_studi">Program Studi</label>
                            <select name="program_studi" id="program_studi" class="form-control">
                                <option value="">Semua Prodi</option>
                                @foreach($prodiList as $prodi)
                                    <option value="{{ $prodi }}" {{ request('program_studi') == $prodi ? 'selected' : '' }}>
                                        {{ $prodi }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="search">Cari (Nama/NIM/Perusahaan)</label>
                            <input type="text" name="search" id="search" class="form-control" 
                                   value="{{ request('search') }}" placeholder="Masukkan kata kunci...">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>&nbsp;</label>
                            <div>
                                <button type="submit" class="btn btn-primary btn-block">
                                    <i class="fas fa-search"></i> Filter
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                @if(request()->hasAny(['tahun_lulus', 'program_studi', 'search']))
                    <div class="text-right">
                        <a href="{{ route('alumni.index') }}" class="btn btn-sm btn-secondary">
                            <i class="fas fa-times"></i> Reset Filter
                        </a>
                    </div>
                @endif
            </form>
        </div>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Alumni</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Foto</th>
                            <th>Nama</th>
                            <th>NIM</th>
                            <th>Program Studi</th>
                            <th>Tahun Lulus</th>
                            <th>IPK</th>
                            <th>Pekerjaan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($alumni as $index => $item)
                            <tr>
                                <td>{{ $alumni->firstItem() + $index }}</td>
                                <td>
                                    @if($item->foto)
                                        <img src="{{ asset('storage/' . $item->foto) }}" alt="{{ $item->nama }}" 
                                             class="img-thumbnail" style="width: 60px; height: 60px; object-fit: cover;">
                                    @else
                                        <img src="https://via.placeholder.com/60" alt="No Photo" class="img-thumbnail">
                                    @endif
                                </td>
                                <td>{{ $item->nama }}</td>
                                <td>{{ $item->nim }}</td>
                                <td>{{ $item->program_studi }}</td>
                                <td>{{ $item->tahun_lulus }}</td>
                                <td>{{ $item->ipk ? number_format($item->ipk, 2) : '-' }}</td>
                                <td>
                                    @if($item->pekerjaan_sekarang)
                                        <span class="badge badge-{{ $item->pekerjaan_sekarang == 'Bekerja' ? 'success' : ($item->pekerjaan_sekarang == 'Wirausaha' ? 'info' : 'warning') }}">
                                            {{ $item->pekerjaan_sekarang }}
                                        </span>
                                        @if($item->nama_perusahaan)
                                            <br><small class="text-muted">{{ $item->nama_perusahaan }}</small>
                                        @endif
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('alumni.show', $item->id) }}" class="btn btn-sm btn-info" title="Detail">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('alumni.edit', $item->id) }}" class="btn btn-sm btn-warning" title="Edit">
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
                                                    Apakah Anda yakin ingin menghapus data alumni <strong>{{ $item->nama }}</strong>?
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
                                <td colspan="9" class="text-center">Tidak ada data alumni</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-3">
                {{ $alumni->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
