@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Mata Kuliah</h1>
        <a href="{{ route('matakuliah.create') }}" class="btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-plus fa-sm mr-1"></i> Tambah Mata Kuliah
        </a>
    </div>

    @php
        use Illuminate\Support\Str;
    @endphp

    <!-- Data Table -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row justify-content-between align-items-center">
                <div class="col-md-6">
                    <div class="input-group">
                        <input type="text" class="form-control" id="searchInput"
                               placeholder="Cari mata kuliah..." value="{{ request('search') }}">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button" id="searchButton">
                                <i class="fas fa-search fa-sm"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-md-auto mt-3 mt-md-0">
                    <div class="btn-group mr-2">
                        <button class="btn btn-secondary dropdown-toggle" type="button"
                                data-toggle="dropdown">
                            <i class="fas fa-calendar fa-sm mr-1"></i> Semester
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{ route('matakuliah.index', ['search' => request('search'), 'kurikulum_tahun' => request('kurikulum_tahun')]) }}">Semua Semester</a>
                            @foreach($semester as $s)
                                <a class="dropdown-item" href="{{ route('matakuliah.index', ['semester' => $s, 'search' => request('search'), 'kurikulum_tahun' => request('kurikulum_tahun')]) }}">{{ $s }}</a>
                            @endforeach
                        </div>
                    </div>
                    <div class="btn-group">
                        <button class="btn btn-info dropdown-toggle" type="button"
                                data-toggle="dropdown">
                            <i class="fas fa-graduation-cap fa-sm mr-1"></i> Kurikulum
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{ route('matakuliah.index', ['search' => request('search'), 'semester' => request('semester')]) }}">Semua Tahun</a>
                            @foreach($kurikulum_tahun as $kt)
                                <a class="dropdown-item" href="{{ route('matakuliah.index', ['kurikulum_tahun' => $kt, 'search' => request('search'), 'semester' => request('semester')]) }}">{{ $kt }}</a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped" width="100%" cellspacing="0">
                    <thead class="thead-light">
                        <tr>
                            <th width="10%">Kode MK</th>
                            <th width="25%">Nama MK</th>
                            <th width="5%">SKS</th>
                            <th width="8%">Semester</th>
                            <th width="20%">Program Studi</th>
                            <th width="10%">Kurikulum</th>
                            <th width="10%">Status</th>
                            <th width="12%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($matakuliah as $mk)
                        <tr>
                            <td><code>{{ $mk->kode_mk }}</code></td>
                            <td>
                                <div style="max-width: 200px;" title="{{ $mk->nama_mk }}">
                                    {{ Str::limit($mk->nama_mk, 30) }}
                                </div>
                            </td>
                            <td class="text-center"><strong>{{ $mk->sks }}</strong></td>
                            <td class="text-center">{{ $mk->semester }}</td>
                            <td>
                                <div style="max-width: 150px;" title="{{ $mk->program_studi }}">
                                    {{ Str::limit($mk->program_studi, 20) }}
                                </div>
                            </td>
                            <td class="text-center">{{ $mk->kurikulum_tahun }}</td>
                            <td class="text-center">
                                <span class="badge badge-{{ strtolower($mk->status_wajib) == 'wajib' ? 'primary' : 'secondary' }}">
                                    {{ ucfirst($mk->status_wajib) }}
                                </span>
                            </td>
                            <td class="text-center">
                                <div class="btn-group" role="group">
                                    <a href="{{ route('matakuliah.show', $mk->mk_id) }}" class="btn btn-info btn-circle btn-sm" title="Lihat Detail">
                                        <i class="fas fa-eye" style="font-size: 12px;"></i>
                                    </a>
                                    <a href="{{ route('matakuliah.edit', $mk->mk_id) }}" class="btn btn-warning btn-circle btn-sm" title="Edit">
                                        <i class="fas fa-edit" style="font-size: 12px;"></i>
                                    </a>
                                    <button type="button" class="btn btn-danger btn-circle btn-sm" title="Hapus"
                                            onclick='confirmDelete("{{ route('matakuliah.destroy', $mk->mk_id) }}", "matakuliah {{ $mk->nama_mk }}")'>
                                        <i class="fas fa-trash" style="font-size: 12px;"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center py-4">
                                <i class="fas fa-book-open fa-3x text-gray-300 mb-3"></i>
                                <p class="text-muted">Tidak ada data mata kuliah</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center mt-3">
                {{ $matakuliah->links() }}
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.getElementById('searchInput').addEventListener('keyup', function(e) {
    if (e.key === 'Enter') {
        const url = new URL(window.location);
        url.searchParams.set('search', this.value);
        url.searchParams.delete('page');
        window.location = url;
    }
});

document.getElementById('searchButton').addEventListener('click', function() {
    const searchValue = document.getElementById('searchInput').value;
    const url = new URL(window.location);
    url.searchParams.set('search', searchValue);
    url.searchParams.delete('page');
    window.location = url;
});
</script>
@endpush