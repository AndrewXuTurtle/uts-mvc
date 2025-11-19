@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Alumni</h1>
        <div>
            <a href="{{ route('alumni.sync') }}" class="btn btn-sm btn-info shadow-sm" 
               onclick="return confirm('Sinkronisasi alumni dari mahasiswa yang sudah lulus?')">
                <i class="fas fa-sync"></i> Sync dari Mahasiswa
            </a>
            <a href="{{ route('alumni.create') }}" class="btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-plus"></i> Tambah Alumni
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert">
                <span>&times;</span>
            </button>
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Filter Alumni</h6>
        </div>
        <div class="card-body">
            <form method="GET">
                <div class="row">
                    <div class="col-md-4">
                        <label>Tahun Lulus</label>
                        <select name="tahun_lulus" class="form-control">
                            <option value="">Semua Tahun</option>
                            @foreach($tahunList as $tahun)
                                <option value="{{ $tahun }}" {{ request('tahun_lulus') == $tahun ? 'selected' : '' }}>{{ $tahun }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label>Cari (NIM atau Nama)</label>
                        <input type="text" name="search" class="form-control" value="{{ request('search') }}" placeholder="Cari alumni...">
                    </div>
                    <div class="col-md-2">
                        <label>&nbsp;</label>
                        <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-search"></i> Filter</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Alumni ({{ $alumni->total() }} alumni)</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="bg-light">
                        <tr>
                            <th width="5%">No</th>
                            <th>NIM</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Program Studi</th>
                            <th>Tahun Lulus</th>
                            <th width="15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($alumni as $index => $item)
                        <tr>
                            <td>{{ $alumni->firstItem() + $index }}</td>
                            <td>{{ $item->nim }}</td>
                            <td>{{ $item->mahasiswa->nama ?? '-' }}</td>
                            <td>{{ $item->mahasiswa->email ?? '-' }}</td>
                            <td>{{ $item->mahasiswa->prodi ?? 'Teknik Perangkat Lunak' }}</td>
                            <td><span class="badge badge-primary">{{ $item->tahun_lulus ?? '-' }}</span></td>
                            <td>
                                <a href="{{ route('alumni.show', $item->id) }}" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                                <a href="{{ route('alumni.edit', $item->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                <form action="{{ route('alumni.destroy', $item->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center">Tidak ada data alumni. <a href="{{ route('alumni.sync') }}" onclick="return confirm('Sinkronisasi?')">Klik di sini untuk sinkronisasi</a></td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-3">{{ $alumni->links() }}</div>
        </div>
    </div>
</div>
@endsection
