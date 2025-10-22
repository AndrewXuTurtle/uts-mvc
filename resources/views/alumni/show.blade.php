@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail Alumni</h1>
        <div>
            <a href="{{ route('alumni.edit', $alumni->id) }}" class="btn btn-sm btn-warning">
                <i class="fas fa-edit"></i> Edit
            </a>
            <a href="{{ route('alumni.index') }}" class="btn btn-sm btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>

    <div class="row">
        <!-- Left Column - Foto & Info Dasar -->
        <div class="col-lg-4">
            <div class="card shadow mb-4">
                <div class="card-body text-center">
                    @if($alumni->foto)
                        <img src="{{ asset('storage/' . $alumni->foto) }}" alt="{{ $alumni->nama }}" 
                             class="img-fluid rounded mb-3" style="max-width: 100%; height: auto;">
                    @else
                        <img src="https://via.placeholder.com/300x400?text=No+Photo" alt="No Photo" 
                             class="img-fluid rounded mb-3">
                    @endif
                    
                    <h4 class="mb-1">{{ $alumni->nama }}</h4>
                    <p class="text-muted mb-2">{{ $alumni->nim }}</p>
                    
                    @if($alumni->pekerjaan_sekarang)
                        <span class="badge badge-{{ $alumni->pekerjaan_sekarang == 'Bekerja' ? 'success' : ($alumni->pekerjaan_sekarang == 'Wirausaha' ? 'info' : 'warning') }} badge-lg">
                            {{ $alumni->pekerjaan_sekarang }}
                        </span>
                    @endif
                </div>
            </div>

            <!-- Contact Info Card -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-address-card"></i> Informasi Kontak
                    </h6>
                </div>
                <div class="card-body">
                    @if($alumni->email)
                        <div class="mb-2">
                            <i class="fas fa-envelope text-primary"></i>
                            <a href="mailto:{{ $alumni->email }}">{{ $alumni->email }}</a>
                        </div>
                    @endif
                    
                    @if($alumni->telepon)
                        <div class="mb-2">
                            <i class="fas fa-phone text-primary"></i>
                            <a href="tel:{{ $alumni->telepon }}">{{ $alumni->telepon }}</a>
                        </div>
                    @endif
                    
                    @if($alumni->linkedin)
                        <div class="mb-2">
                            <i class="fab fa-linkedin text-primary"></i>
                            <a href="{{ $alumni->linkedin }}" target="_blank">LinkedIn Profile</a>
                        </div>
                    @endif

                    @if(!$alumni->email && !$alumni->telepon && !$alumni->linkedin)
                        <p class="text-muted mb-0">Tidak ada informasi kontak</p>
                    @endif
                </div>
            </div>
        </div>

        <!-- Right Column - Detailed Info -->
        <div class="col-lg-8">
            <!-- Data Akademik -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-graduation-cap"></i> Data Akademik
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <strong>Program Studi:</strong>
                            <p>{{ $alumni->program_studi }}</p>
                        </div>
                        <div class="col-md-3 mb-3">
                            <strong>Tahun Lulus:</strong>
                            <p>{{ $alumni->tahun_lulus }}</p>
                        </div>
                        <div class="col-md-3 mb-3">
                            <strong>IPK:</strong>
                            <p>{{ $alumni->ipk ? number_format($alumni->ipk, 2) : '-' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Data Pekerjaan -->
            @if($alumni->pekerjaan_sekarang || $alumni->nama_perusahaan || $alumni->posisi)
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">
                            <i class="fas fa-briefcase"></i> Informasi Pekerjaan
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @if($alumni->pekerjaan_sekarang)
                                <div class="col-md-6 mb-3">
                                    <strong>Status Saat Ini:</strong>
                                    <p>
                                        <span class="badge badge-{{ $alumni->pekerjaan_sekarang == 'Bekerja' ? 'success' : ($alumni->pekerjaan_sekarang == 'Wirausaha' ? 'info' : 'warning') }}">
                                            {{ $alumni->pekerjaan_sekarang }}
                                        </span>
                                    </p>
                                </div>
                            @endif
                            
                            @if($alumni->nama_perusahaan)
                                <div class="col-md-6 mb-3">
                                    <strong>Perusahaan / Institusi:</strong>
                                    <p>{{ $alumni->nama_perusahaan }}</p>
                                </div>
                            @endif
                            
                            @if($alumni->posisi)
                                <div class="col-md-6 mb-3">
                                    <strong>Posisi / Jabatan:</strong>
                                    <p>{{ $alumni->posisi }}</p>
                                </div>
                            @endif
                            
                            @if($alumni->tanggal_mulai_kerja)
                                <div class="col-md-6 mb-3">
                                    <strong>Mulai Bekerja:</strong>
                                    <p>{{ $alumni->tanggal_mulai_kerja->format('d F Y') }}</p>
                                </div>
                            @endif
                            
                            @if($alumni->alamat_perusahaan)
                                <div class="col-md-12 mb-3">
                                    <strong>Alamat Perusahaan:</strong>
                                    <p>{{ $alumni->alamat_perusahaan }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endif

            <!-- Testimoni -->
            @if($alumni->testimoni)
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">
                            <i class="fas fa-quote-left"></i> Testimoni
                        </h6>
                    </div>
                    <div class="card-body">
                        <p class="text-justify" style="line-height: 1.8;">
                            "{{ $alumni->testimoni }}"
                        </p>
                    </div>
                </div>
            @endif

            <!-- Pencapaian -->
            @if($alumni->pencapaian)
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">
                            <i class="fas fa-trophy"></i> Pencapaian
                        </h6>
                    </div>
                    <div class="card-body">
                        <p class="text-justify" style="line-height: 1.8;">
                            {{ $alumni->pencapaian }}
                        </p>
                    </div>
                </div>
            @endif

            <!-- Action Buttons -->
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('alumni.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Kembali ke Daftar
                        </a>
                        <div>
                            <a href="{{ route('alumni.edit', $alumni->id) }}" class="btn btn-warning">
                                <i class="fas fa-edit"></i> Edit Data
                            </a>
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal">
                                <i class="fas fa-trash"></i> Hapus
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Konfirmasi Hapus</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin menghapus data alumni <strong>{{ $alumni->nama }}</strong>?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <form action="{{ route('alumni.destroy', $alumni->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
