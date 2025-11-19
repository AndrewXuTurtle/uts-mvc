@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail Mahasiswa</h1>
        <div>
            <a href="{{ route('mahasiswa.edit', $mahasiswa) }}" class="d-none d-sm-inline-block btn btn-sm btn-warning shadow-sm">
                <i class="fas fa-edit fa-sm text-white-50"></i> Edit
            </a>
            <a href="{{ route('mahasiswa.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
                <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4">
            <!-- Profile Picture -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Foto Profil</h6>
                </div>
                <div class="card-body text-center">
                    @if($mahasiswa->foto)
                        <img src="{{ asset('storage/' . $mahasiswa->foto) }}" alt="Foto {{ $mahasiswa->nama }}"
                             class="img-fluid rounded-circle mb-3" style="max-width: 200px; max-height: 200px; object-fit: cover;">
                        <div>
                            <a href="{{ asset('storage/' . $mahasiswa->foto) }}" target="_blank" class="btn btn-sm btn-info">
                                <i class="fas fa-eye"></i> Lihat Foto
                            </a>
                        </div>
                    @else
                        <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                             style="width: 200px; height: 200px;">
                            <i class="fas fa-user fa-4x text-muted"></i>
                        </div>
                        <p class="text-muted">Tidak ada foto profil</p>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <!-- Student Information -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Informasi Mahasiswa</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bold">NIM</label>
                                <p class="mb-2">{{ $mahasiswa->nim }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bold">Nama Lengkap</label>
                                <p class="mb-2">{{ $mahasiswa->nama }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bold">Email</label>
                                <p class="mb-2">
                                    <a href="mailto:{{ $mahasiswa->email }}">{{ $mahasiswa->email }}</a>
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bold">No. HP</label>
                                <p class="mb-2">{{ $mahasiswa->no_hp ?: '-' }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bold">Jenis Kelamin</label>
                                <p class="mb-2">{{ $mahasiswa->jenis_kelamin ?: '-' }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bold">Tempat, Tanggal Lahir</label>
                                <p class="mb-2">
                                    {{ $mahasiswa->tempat_lahir ?: '-' }}{{ $mahasiswa->tempat_lahir && $mahasiswa->tanggal_lahir ? ', ' : '' }}{{ $mahasiswa->tanggal_lahir ? $mahasiswa->tanggal_lahir->format('d M Y') : '' }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="font-weight-bold">Alamat</label>
                                <p class="mb-2">{{ $mahasiswa->alamat ?: '-' }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bold">Program Studi</label>
                                <p class="mb-2">{{ $mahasiswa->prodi ?: 'Teknik Perangkat Lunak' }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bold">Kelas</label>
                                <p class="mb-2">{{ $mahasiswa->kelas ?: '-' }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bold">Tahun Masuk</label>
                                <p class="mb-2">{{ $mahasiswa->tahun_masuk }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bold">Status</label>
                                <p class="mb-2">
                                    <span class="badge badge-{{ $mahasiswa->getStatusBadgeColor() }}">
                                        {{ $mahasiswa->status }}
                                    </span>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bold">Dibuat</label>
                                <p class="mb-2">{{ $mahasiswa->created_at->format('d M Y H:i') }}</p>
                            </div>
                        </div>
                    </div>

                    @if($mahasiswa->updated_at != $mahasiswa->created_at)
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bold">Terakhir Diupdate</label>
                                <p class="mb-2">{{ $mahasiswa->updated_at->format('d M Y H:i') }}</p>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <!-- PKM Participation (if any) -->
            @if($mahasiswa->pkm && $mahasiswa->pkm->count() > 0)
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Partisipasi PKM ({{ $mahasiswa->pkm->count() }})</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Judul PKM</th>
                                    <th>Status</th>
                                    <th>Tahun</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($mahasiswa->pkm as $pkm)
                                <tr>
                                    <td>{{ Str::limit($pkm->judul, 50) }}</td>
                                    <td>
                                        <span class="badge badge-{{ $pkm->status == 'completed' ? 'success' : ($pkm->status == 'ongoing' ? 'primary' : 'secondary') }}">
                                            {{ $pkm->status == 'ongoing' ? 'Sedang Berlangsung' : ($pkm->status == 'completed' ? 'Selesai' : 'Dibatalkan') }}
                                        </span>
                                    </td>
                                    <td>{{ $pkm->tahun }}</td>
                                    <td>
                                        <a href="{{ route('pkm.show', $pkm) }}" class="btn btn-sm btn-info">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus data mahasiswa <strong>{{ $mahasiswa->nama }}</strong>?
                    <br><small class="text-danger">Tindakan ini tidak dapat dibatalkan.</small>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                    <form action="{{ route('mahasiswa.destroy', $mahasiswa) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection