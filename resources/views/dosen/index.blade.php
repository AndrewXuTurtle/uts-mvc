@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Dosen</h1>
        <a href="{{ route('dosen.create') }}" class="btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Dosen
        </a>
    </div>

    <!-- Data Table -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row justify-content-between align-items-center">
                <div class="col-md-6">
                    <div class="input-group">
                        <input type="text" class="form-control" id="searchInput" 
                               placeholder="Cari dosen..." value="{{ request('search') }}">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button" id="searchButton">
                                <i class="fas fa-search fa-sm"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-md-auto mt-3 mt-md-0">
                </div>
            </div>
        </div>
        <div class="card-body">
            @php
                use Illuminate\Support\Facades\Storage;
            @endphp
            
            <div class="table-responsive">
                <table class="table table-bordered table-striped" width="100%" cellspacing="0">
                    <thead class="thead-light">
                        <tr>
                            <th>NIDN</th>
                            <th>Foto</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Program Studi</th>
                            <th>Jabatan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($dosen as $d)
                        <tr>
                            <td>{{ $d->nidn }}</td>
                            <td class="text-center">
                                @if($d->foto)
                                    <img src="{{ asset('storage/' . $d->foto) }}" 
                                         alt="Foto {{ $d->nama }}"
                                         class="img-profile rounded-circle"
                                         style="width: 40px; height: 40px; object-fit: cover;">
                                @else
                                    <img src="{{ asset('template/img/undraw_profile.svg') }}"
                                         alt="Default Profile"
                                         class="img-profile rounded-circle"
                                         style="width: 40px; height: 40px;">
                                @endif
                            </td>
                            <td>{{ $d->nama }}</td>
                            <td>{{ $d->email }}</td>
                            <td>{{ $d->program_studi }}</td>
                            <td>{{ $d->jabatan }}</td>
                            <td class="text-center">
                                <a href="{{ route('dosen.show', $d->id) }}" class="btn btn-info btn-circle btn-sm">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('dosen.edit', $d->id) }}" class="btn btn-warning btn-circle btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button type="button" class="btn btn-danger btn-circle btn-sm" 
                                        onclick="confirmDelete('{{ route('dosen.destroy', $d->id) }}', 'dosen {{ $d->nama }}')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center">Tidak ada data dosen</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center mt-3">
                {{ $dosen->links() }}
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