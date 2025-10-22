@extends('layouts.app')

                    </button>
                </div>
                <div class="col-md-auto mt-3 mt-md-0">
                </div>
            </div>('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Berita</h1>
        <a href="{{ route('berita.create') }}" class="btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Berita
        </a>
    </div>

    <!-- Data Table -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row justify-content-between align-items-center">
                <div class="col-md-6">
                    <div class="input-group">
                        <input type="text" class="form-control" id="searchInput" 
                               placeholder="Cari berita..." value="{{ request('search') }}">
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
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Judul</th>
                            <th>Gambar</th>
                            <th>Penulis</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($berita as $b)
                        <tr>
                            <td>{{ $b->judul }}</td>
                            <td class="text-center">
                                @if($b->gambar)
                                    <img src="{{ asset('storage/' . $b->gambar) }}" 
                                         alt="Gambar {{ $b->judul }}"
                                         class="img-profile rounded"
                                         style="width: 60px; height: 40px; object-fit: cover;">
                                @else
                                    <img src="{{ asset('template/img/undraw_profile.svg') }}"
                                         alt="Default"
                                         class="img-profile rounded"
                                         style="width: 60px; height: 40px;">
                                @endif
                            </td>
                            <td>{{ $b->penulis }}</td>
                            <td>{{ $b->tanggal ? $b->tanggal->format('d/m/Y') : $b->tanggal }}</td>
                            <td class="text-center">
                                <a href="{{ route('berita.show', $b->id) }}" class="btn btn-info btn-circle btn-sm">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('berita.edit', $b->id) }}" class="btn btn-warning btn-circle btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button type="button" class="btn btn-danger btn-circle btn-sm" 
                                        onclick="confirmDelete({{ $b->id }})">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center">Tidak ada data berita</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{ $berita->links() }}
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
                <p>Apakah Anda yakin ingin menghapus berita ini?</p>
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
</div>
@endsection

@push('scripts')
<script>
function confirmDelete(id) {
    const deleteForm = document.getElementById('deleteForm');
    deleteForm.action = `{{ url('berita') }}/${id}`;
    $('#deleteModal').modal('show');
}

document.getElementById('searchInput').addEventListener('keyup', function(e) {
    if (e.key === 'Enter') {
        window.location.href = '{{ route('berita.index') }}?search=' + this.value;
    }
});

document.getElementById('searchButton').addEventListener('click', function() {
    const searchValue = document.getElementById('searchInput').value;
    window.location.href = '{{ route('berita.index') }}?search=' + searchValue;
});
</script>
@endpush