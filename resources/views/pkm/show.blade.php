@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail PKM</h1>
        <div>
            <a href="{{ route('pkm.edit', $pkm) }}" class="d-none d-sm-inline-block btn btn-sm btn-warning shadow-sm">
                <i class="fas fa-edit fa-sm text-white-50"></i> Edit
            </a>
            <a href="{{ route('pkm.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
                <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <!-- PKM Information -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Informasi PKM</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="font-weight-bold">Judul PKM</label>
                                <p class="mb-2 h5">{{ $pkm->judul_pkm }}</p>
                            </div>
                        </div>
                    </div>

                    @if($pkm->deskripsi)
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="font-weight-bold">Deskripsi</label>
                                <p class="mb-2">{{ $pkm->deskripsi }}</p>
                            </div>
                        </div>
                    </div>
                    @endif

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bold">Tim Mahasiswa ({{ $pkm->mahasiswas->count() }})</label>
                                <p class="mb-2">
                                    @if($pkm->mahasiswas->count() > 0)
                                        @foreach($pkm->mahasiswas as $mhs)
                                            <span class="badge badge-{{ $mhs->pivot->peran == 'Ketua' ? 'primary' : 'secondary' }}">
                                                {{ $mhs->pivot->peran }}
                                            </span>
                                            {{ $mhs->nama }}
                                            <br><small class="text-muted">NIM: {{ $mhs->nim }}</small>
                                            @if(!$loop->last)
                                                <hr class="my-2">
                                            @endif
                                        @endforeach
                                    @else
                                        <span class="text-muted">Tidak ada mahasiswa</span>
                                    @endif
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bold">Dosen Pembimbing</label>
                                <p class="mb-2">
                                    @if($pkm->dosenPembimbing)
                                        {{ $pkm->dosenPembimbing->nama }}
                                        <br><small class="text-muted">NIDN: {{ $pkm->dosenPembimbing->nidn }}</small>
                                    @else
                                        <span class="text-muted">Tidak ada dosen pembimbing</span>
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="font-weight-bold">Tahun</label>
                                <p class="mb-2">{{ $pkm->tahun }}</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="font-weight-bold">Jenis PKM</label>
                                <p class="mb-2">{{ $pkm->jenis_pkm }}</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="font-weight-bold">Status</label>
                                <p class="mb-2">
                                    <span class="badge badge-{{ $pkm->status_badge }}">
                                        {{ $pkm->status }}
                                    </span>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bold">Dana</label>
                                <p class="mb-2">{{ $pkm->dana ? 'Rp ' . number_format($pkm->dana, 0, ',', '.') : '-' }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bold">Pencapaian</label>
                                <p class="mb-2">{{ $pkm->pencapaian ?? '-' }}</p>
                            </div>
                        </div>
                    </div>

                    @if($pkm->file_dokumen)
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="font-weight-bold">File Dokumen</label>
                                <p class="mb-2">
                                    <a href="{{ asset('storage/' . $pkm->file_dokumen) }}" target="_blank" class="btn btn-sm btn-primary">
                                        <i class="fas fa-download"></i> Download Dokumen
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                    @endif

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bold">Dibuat</label>
                                <p class="mb-2">{{ $pkm->created_at->format('d M Y H:i') }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bold">Terakhir Diupdate</label>
                                <p class="mb-2">{{ $pkm->updated_at->format('d M Y H:i') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <!-- Status Card -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Status PKM</h6>
                </div>
                <div class="card-body text-center">
                    <div class="mb-3">
                        <span class="badge badge-{{ $pkm->status_badge }} badge-lg">
                            {{ $pkm->status }}
                        </span>
                    </div>
                    <div class="progress mb-2">
                        <div class="progress-bar bg-{{ $pkm->status_badge }}"
                             role="progressbar"
                             style="width: {{ $pkm->status == 'Selesai' ? '100' : ($pkm->status == 'Didanai' ? '60' : '30') }}%">
                        </div>
                    </div>
                    <small class="text-muted">
                        @if($pkm->status == 'Selesai')
                            PKM telah selesai
                        @elseif($pkm->status == 'Didanai')
                            PKM sedang didanai
                        @elseif($pkm->status == 'Proposal')
                            Masih tahap proposal
                        @else
                            PKM ditolak
                        @endif
                    </small>
                </div>
            </div>

            <!-- Quick Stats -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Ringkasan</h6>
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-6">
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $pkm->tahun }}</div>
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Tahun</div>
                        </div>
                        <div class="col-6">
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $pkm->mahasiswas->count() }}</div>
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Mahasiswa</div>
                        </div>
                    </div>
                </div>
            </div>
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
                    Apakah Anda yakin ingin menghapus data PKM <strong>{{ $pkm->judul_pkm }}</strong>?
                    <br><small class="text-danger">Tindakan ini tidak dapat dibatalkan.</small>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                    <form action="{{ route('pkm.destroy', $pkm) }}" method="POST" class="d-inline">
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