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
                                <p class="mb-2 h5">{{ $pkm->judul }}</p>
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
                                <label class="font-weight-bold">Mahasiswa ({{ $pkm->mahasiswa->count() }})</label>
                                <p class="mb-2">
                                    @if($pkm->mahasiswa->count() > 0)
                                        @foreach($pkm->mahasiswa as $mhs)
                                            <a href="{{ route('mahasiswa.show', $mhs) }}">
                                                {{ $mhs->nama }}
                                            </a>
                                            <br><small class="text-muted">{{ $mhs->nim }} - {{ $mhs->jurusan }}</small>
                                            @if(!$loop->last)
                                                <hr class="my-1">
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
                                <label class="font-weight-bold">Dosen Pembimbing ({{ $pkm->dosen->count() }})</label>
                                <p class="mb-2">
                                    @if($pkm->dosen->count() > 0)
                                        @foreach($pkm->dosen as $d)
                                            <a href="{{ route('dosen.show', $d) }}">
                                                {{ $d->nama }}
                                            </a>
                                            <br><small class="text-muted">{{ $d->nidn }}</small>
                                            @if(!$loop->last)
                                                <hr class="my-1">
                                            @endif
                                        @endforeach
                                    @else
                                        <span class="text-muted">Tidak ada dosen pembimbing</span>
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bold">Tahun</label>
                                <p class="mb-2">{{ $pkm->tahun }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bold">Status</label>
                                <p class="mb-2">
                                    <span class="badge badge-{{ $pkm->status_badge }}">
                                        {{ $pkm->status_label }}
                                    </span>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bold">Mitra</label>
                                <p class="mb-2">{{ $pkm->mitra ?? '-' }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bold">Lokasi</label>
                                <p class="mb-2">{{ $pkm->lokasi ?? '-' }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bold">Biaya</label>
                                <p class="mb-2">{{ $pkm->biaya_formatted }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bold">Tanggal Mulai</label>
                                <p class="mb-2">{{ $pkm->tanggal_mulai ? $pkm->tanggal_mulai->format('d M Y') : '-' }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bold">Tanggal Selesai</label>
                                <p class="mb-2">{{ $pkm->tanggal_selesai ? $pkm->tanggal_selesai->format('d M Y') : '-' }}</p>
                            </div>
                        </div>
                    </div>

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

            <!-- Dokumentasi Images -->
            @if($pkm->dokumentasi && count($pkm->dokumentasi) > 0)
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Dokumentasi ({{ count($pkm->dokumentasi) }} gambar)</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        @foreach($pkm->dokumentasi as $image)
                        <div class="col-md-4 mb-3">
                            <div class="card">
                                <img src="{{ asset('storage/' . $image) }}" class="card-img-top" alt="Dokumentasi PKM"
                                     style="height: 200px; object-fit: cover;">
                                <div class="card-body p-2">
                                    <a href="{{ asset('storage/' . $image) }}" target="_blank" class="btn btn-sm btn-primary">
                                        <i class="fas fa-eye"></i> Lihat
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif
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
                            {{ $pkm->status_label }}
                        </span>
                    </div>
                    <div class="progress mb-2">
                        <div class="progress-bar bg-{{ $pkm->status_badge }}"
                             role="progressbar"
                             style="width: {{ $pkm->status == 'completed' ? '100' : ($pkm->status == 'ongoing' ? '60' : '30') }}%">
                        </div>
                    </div>
                    <small class="text-muted">
                        @if($pkm->status == 'completed')
                            PKM telah selesai
                        @elseif($pkm->status == 'ongoing')
                            PKM sedang berlangsung
                        @elseif($pkm->status == 'published')
                            PKM telah dipublikasikan
                        @else
                            PKM dibatalkan
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
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $pkm->biaya_formatted }}</div>
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Biaya</div>
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
                    Apakah Anda yakin ingin menghapus data PKM <strong>{{ $pkm->judul }}</strong>?
                    <br><small class="text-danger">Tindakan ini tidak dapat dibatalkan dan akan menghapus semua dokumentasi gambar.</small>
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