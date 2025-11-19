@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail Tracer Study</h1>
        <div>
            <a href="{{ route('tracer-study.edit', $tracerStudy->id) }}" class="btn btn-warning btn-sm">
                <i class="fas fa-edit"></i> Edit
            </a>
            <a href="{{ route('tracer-study.index') }}" class="btn btn-secondary btn-sm">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>

    <div class="row">
        <!-- Alumni Info -->
        <div class="col-lg-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Informasi Alumni</h6>
                </div>
                <div class="card-body">
                    @if($tracerStudy->alumni && $tracerStudy->alumni->mahasiswa)
                    <div class="text-center mb-3">
                        @if($tracerStudy->alumni->mahasiswa->foto)
                        <img src="{{ Storage::url($tracerStudy->alumni->mahasiswa->foto) }}" alt="{{ $tracerStudy->alumni->mahasiswa->nama }}" 
                             class="rounded-circle" style="width: 100px; height: 100px; object-fit: cover;">
                        @else
                        <div class="rounded-circle bg-primary text-white d-inline-flex align-items-center justify-content-center" 
                             style="width: 100px; height: 100px; font-size: 2rem;">
                            {{ substr($tracerStudy->alumni->mahasiswa->nama, 0, 1) }}
                        </div>
                        @endif
                    </div>
                    <h5 class="text-center">{{ $tracerStudy->alumni->mahasiswa->nama }}</h5>
                    <p class="text-center text-muted mb-1">NIM: {{ $tracerStudy->nim }}</p>
                    <p class="text-center text-muted">Tahun Lulus: {{ $tracerStudy->alumni->tahun_lulus ?? '-' }}</p>
                    @else
                    <p class="text-muted">Data alumni tidak tersedia</p>
                    @endif
                </div>
            </div>

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Info Survey</h6>
                </div>
                <div class="card-body">
                    <p><strong>Tahun Survey:</strong> {{ $tracerStudy->tahun_survey }}</p>
                    <p class="mb-0"><strong>Status Pekerjaan:</strong><br>
                    <span class="badge badge-info mt-1">{{ $tracerStudy->status_pekerjaan }}</span></p>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="col-lg-8">
            <!-- Data Pekerjaan -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Data Pekerjaan</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <p><strong>Nama Perusahaan</strong><br>{{ $tracerStudy->nama_perusahaan ?? '-' }}</p>
                        </div>
                        <div class="col-md-4">
                            <p><strong>Posisi/Jabatan</strong><br>{{ $tracerStudy->posisi ?? '-' }}</p>
                        </div>
                        <div class="col-md-4">
                            <p><strong>Bidang Pekerjaan</strong><br>{{ $tracerStudy->bidang_pekerjaan ?? '-' }}</p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Gaji</strong><br>
                            {{ $tracerStudy->gaji ? 'Rp ' . number_format($tracerStudy->gaji, 0, ',', '.') : '-' }}
                            </p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Waktu Tunggu Kerja</strong><br>
                            {{ $tracerStudy->waktu_tunggu_kerja ? $tracerStudy->waktu_tunggu_kerja . ' bulan' : '-' }}
                            </p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <p><strong>Kesesuaian Bidang Studi</strong><br>
                            @if($tracerStudy->kesesuaian_bidang_studi)
                            <span class="badge badge-success">{{ $tracerStudy->kesesuaian_bidang_studi }}</span>
                            @else
                            <span class="text-muted">-</span>
                            @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Kepuasan & Kompetensi -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Penilaian</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <p><strong>Kepuasan terhadap Prodi (Skala 1-5)</strong><br>
                            @if($tracerStudy->kepuasan_prodi)
                            <span class="badge badge-success" style="font-size: 1rem;">{{ $tracerStudy->kepuasan_prodi }}/5</span>
                            @else
                            <span class="text-muted">Belum dinilai</span>
                            @endif
                            </p>
                        </div>
                    </div>
                    <hr>
                    @if($tracerStudy->kompetensi_didapat)
                    <div>
                        <strong>Kompetensi yang Didapat:</strong>
                        <div class="bg-light p-3 rounded mt-2" style="white-space: pre-line;">{{ $tracerStudy->kompetensi_didapat }}</div>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Saran -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Saran & Masukan</h6>
                </div>
                <div class="card-body">
                    @if($tracerStudy->saran_prodi)
                    <div class="mb-3">
                        <strong>Saran untuk Prodi:</strong>
                        <div class="bg-light p-3 rounded mt-2" style="white-space: pre-line;">{{ $tracerStudy->saran_prodi }}</div>
                    </div>
                    @endif

                    @if($tracerStudy->saran_pengembangan)
                    <div>
                        <strong>Saran Pengembangan:</strong>
                        <div class="bg-light p-3 rounded mt-2" style="white-space: pre-line;">{{ $tracerStudy->saran_pengembangan }}</div>
                    </div>
                    @endif

                    @if(!$tracerStudy->saran_prodi && !$tracerStudy->saran_pengembangan)
                    <p class="text-muted mb-0">Tidak ada saran atau masukan.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
