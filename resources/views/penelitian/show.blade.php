@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail Penelitian</h1>
        <div>
            <a href="{{ route('penelitian.edit', $penelitian->id) }}" class="d-none d-sm-inline-block btn btn-sm btn-warning shadow-sm">
                <i class="fas fa-edit fa-sm text-white-50"></i> Edit
            </a>
            <a href="{{ route('penelitian.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
                <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <!-- Penelitian Details -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Informasi Penelitian</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <h4 class="font-weight-bold text-primary"><i class="fas fa-book"></i> {{ $penelitian->judul_penelitian }}</h4>
                            <hr>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <h5><i class="fas fa-user"></i> Ketua Peneliti</h5>
                            <p class="text-muted">{{ $penelitian->ketuaPeneliti->nama ?? 'N/A' }}</p>
                            @if($penelitian->ketuaPeneliti)
                                <small class="text-muted">NIDN: {{ $penelitian->ketuaPeneliti->nidn }}</small>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <h5><i class="fas fa-calendar"></i> Tahun</h5>
                            <p class="text-muted">{{ $penelitian->tahun }}</p>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-md-6">
                            <h5><i class="fas fa-flask"></i> Jenis Penelitian</h5>
                            <p class="text-muted">{{ $penelitian->jenis_penelitian ?? 'N/A' }}</p>
                        </div>
                        <div class="col-md-6">
                            <h5><i class="fas fa-info-circle"></i> Status</h5>
                            <p class="text-muted">
                                <span class="badge badge-{{ $penelitian->status == 'Selesai' ? 'success' : ($penelitian->status == 'Sedang Berjalan' ? 'primary' : 'secondary') }}">
                                    {{ $penelitian->status }}
                                </span>
                            </p>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-md-6">
                            <h5><i class="fas fa-calendar-check"></i> Tanggal Mulai</h5>
                            <p class="text-muted">{{ $penelitian->tanggal_mulai ? $penelitian->tanggal_mulai->format('d F Y') : 'N/A' }}</p>
                        </div>
                        <div class="col-md-6">
                            <h5><i class="fas fa-calendar-times"></i> Tanggal Selesai</h5>
                            <p class="text-muted">{{ $penelitian->tanggal_selesai ? $penelitian->tanggal_selesai->format('d F Y') : 'Belum selesai' }}</p>
                        </div>
                    </div>

                    @if($penelitian->sumber_dana || $penelitian->dana)
                    <hr>

                    <div class="row">
                        <div class="col-md-6">
                            <h5><i class="fas fa-money-bill"></i> Sumber Dana</h5>
                            <p class="text-muted">{{ $penelitian->sumber_dana ?? 'N/A' }}</p>
                        </div>
                        <div class="col-md-6">
                            <h5><i class="fas fa-dollar-sign"></i> Jumlah Dana</h5>
                            <p class="text-muted">{{ $penelitian->dana ? 'Rp ' . number_format($penelitian->dana, 0, ',', '.') : 'N/A' }}</p>
                        </div>
                    </div>
                    @endif

                    @if($penelitian->output)
                    <hr>
                    <div class="row">
                        <div class="col-12">
                            <h5><i class="fas fa-trophy"></i> Output Penelitian</h5>
                            <p class="text-muted">{{ $penelitian->output }}</p>
                        </div>
                    </div>
                    @endif

                    <hr>

                    <div class="row">
                        <div class="col-12">
                            <h5><i class="fas fa-align-left"></i> Deskripsi Penelitian</h5>
                            <p class="text-muted">{{ $penelitian->deskripsi ?? 'Tidak ada deskripsi' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <!-- Actions -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Aksi</h6>
                </div>
                <div class="card-body">
                    <a href="{{ route('penelitian.edit', $penelitian->id) }}" class="btn btn-warning btn-block mb-2">
                        <i class="fas fa-edit"></i> Edit Penelitian
                    </a>
                    <form action="{{ route('penelitian.destroy', $penelitian->id) }}" method="POST" class="d-inline w-100">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-block"
                                onclick="return confirm('Apakah Anda yakin ingin menghapus data penelitian ini? Semua file terkait akan dihapus.')">
                            <i class="fas fa-trash"></i> Hapus Penelitian
                        </button>
                    </form>
                </div>
            </div>

            <!-- Files -->
            @if($penelitian->file_dokumen)
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">File Dokumen</h6>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <h6><i class="fas fa-file-pdf"></i> Dokumen Penelitian</h6>
                        <a href="{{ asset('storage/' . $penelitian->file_dokumen) }}"
                           target="_blank" class="btn btn-primary btn-sm">
                            <i class="fas fa-download"></i> Download Dokumen
                        </a>
                    </div>
                </div>
            </div>
            @endif

            <!-- File Info -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Informasi Tambahan</h6>
                </div>
                <div class="card-body">
                    <div class="text-center">
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $penelitian->status }}</div>
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Status Penelitian</div>
                    </div>
                    <hr>
                    <p class="text-muted small">
                        <strong>Dibuat:</strong><br>
                        {{ $penelitian->created_at->format('d F Y H:i') }}
                    </p>
                    @if($penelitian->updated_at != $penelitian->created_at)
                    <p class="text-muted small">
                        <strong>Diubah:</strong><br>
                        {{ $penelitian->updated_at->format('d F Y H:i') }}
                    </p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection