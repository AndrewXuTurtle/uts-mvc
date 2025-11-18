@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Project Mahasiswa</h1>
        <a href="{{ route('project.create') }}" class="btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Project
        </a>
    </div>

    <!-- Data Table -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row justify-content-between align-items-center">
                <div class="col-md-6">
                    <div class="input-group">
                        <input type="text" class="form-control" id="searchInput"
                               placeholder="Cari project..." value="{{ request('search') }}">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button" id="searchButton">
                                <i class="fas fa-search fa-sm"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-md-auto mt-3 mt-md-0">
                    <div class="btn-group">
                        <button class="btn btn-secondary dropdown-toggle" type="button"
                                data-toggle="dropdown">
                            <i class="fas fa-calendar fa-sm"></i> Tahun
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{ route('project.index', ['search' => request('search')]) }}">Semua Tahun</a>
                            @foreach($tahun as $t)
                                <a class="dropdown-item" href="{{ route('project.index', ['tahun' => $t, 'search' => request('search')]) }}">{{ $t }}</a>
                            @endforeach
                        </div>
                    </div>
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
                            <th>Judul Project</th>
                            <th>Mahasiswa</th>
                            <th>NIM</th>
                            <th>Tahun</th>
                            <th>Cover</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($projects as $p)
                        <tr>
                            <td>{{ $p->judul_project }}</td>
                            <td>{{ $p->mahasiswa ? $p->mahasiswa->nama : '-' }}</td>
                            <td>{{ $p->nim }}</td>
                            <td>{{ $p->tahun_selesai ?? $p->tahun }}</td>
                            <td class="text-center">
                                @if($p->cover_image)
                                    <img src="{{ asset('storage/' . $p->cover_image) }}"
                                         alt="Cover {{ $p->judul_project }}"
                                         class="img-profile rounded"
                                         style="width: 50px; height: 50px; object-fit: cover;">
                                @else
                                    <i class="fas fa-image text-gray-300" style="font-size: 24px;"></i>
                                @endif
                                @if($p->galeri && count($p->galeri) > 0)
                                    <br>
                                    <small class="text-muted">
                                        <i class="fas fa-images"></i> +{{ count($p->galeri) }} galeri
                                    </small>
                                @endif
                            </td>
                            <td class="text-center">
                                <a href="{{ route('project.show', $p) }}" class="btn btn-info btn-circle btn-sm">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('project.edit', $p) }}" class="btn btn-warning btn-circle btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button type="button" class="btn btn-danger btn-circle btn-sm"
                                        onclick='confirmDelete({{ $p->id }})'>
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center">Tidak ada data project</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center mt-3">
                {{ $projects->links() }}
            </div>
        </div>
    </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Konfirmasi Hapus</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
        <p>Apakah Anda yakin ingin menghapus data project ini?</p>
    </div>
    <div class="modal-footer">
        <form id="deleteForm" method="POST">
            @csrf
            @method('DELETE')
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-danger">Hapus</button>
        </form>
    </div>
</div>
</div>
@endsection

@push('scripts')
<script>
function confirmDelete(id) {
    const deleteForm = document.getElementById('deleteForm');
    deleteForm.action = `{{ url('project') }}/${id}`;
    $('#deleteModal').modal('show');
}

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