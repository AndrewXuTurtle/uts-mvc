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
                    @if($tracerStudy->alumni)
                    <div class="text-center mb-3">
                        @if($tracerStudy->alumni->foto)
                        <img src="{{ Storage::url($tracerStudy->alumni->foto) }}" alt="{{ $tracerStudy->alumni->nama }}" 
                             class="rounded-circle" style="width: 100px; height: 100px; object-fit: cover;">
                        @else
                        <div class="rounded-circle bg-primary text-white d-inline-flex align-items-center justify-content-center" 
                             style="width: 100px; height: 100px; font-size: 2rem;">
                            {{ substr($tracerStudy->alumni->nama, 0, 1) }}
                        </div>
                        @endif
                    </div>
                    <h5 class="text-center">{{ $tracerStudy->alumni->nama }}</h5>
                    <p class="text-center text-muted mb-1">NIM: {{ $tracerStudy->alumni->nim }}</p>
                    <p class="text-center text-muted">Lulus: {{ $tracerStudy->alumni->tahun_lulus }}</p>
                    @else
                    <p class="text-muted">Data alumni tidak tersedia</p>
                    @endif
                </div>
            </div>

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Status Survey</h6>
                </div>
                <div class="card-body">
                    <p><strong>Tahun Survey:</strong> {{ $tracerStudy->tahun_survey }}</p>
                    <p><strong>Tanggal:</strong> {{ date('d M Y', strtotime($tracerStudy->tanggal_survey)) }}</p>
                    <p><strong>Bulan Sejak Lulus:</strong> {{ $tracerStudy->bulan_sejak_lulus }} bulan</p>
                    <p><strong>Status:</strong> 
                        @if($tracerStudy->status_survey == 'verified')
                        <span class="badge badge-success">Verified</span>
                        @elseif($tracerStudy->status_survey == 'completed')
                        <span class="badge badge-info">Completed</span>
                        @else
                        <span class="badge badge-warning">Draft</span>
                        @endif
                    </p>
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
                        <div class="col-md-6">
                            <p><strong>Status Pekerjaan:</strong><br>
                            <span class="badge badge-info mt-1">{{ ucwords(str_replace('_', ' ', $tracerStudy->status_pekerjaan)) }}</span></p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Waktu Tunggu Kerja:</strong><br>{{ $tracerStudy->waktu_tunggu_kerja ? ucwords(str_replace('_', ' ', $tracerStudy->waktu_tunggu_kerja)) : '-' }}</p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-4">
                            <p><strong>Perusahaan:</strong><br>{{ $tracerStudy->nama_perusahaan ?? '-' }}</p>
                        </div>
                        <div class="col-md-4">
                            <p><strong>Posisi:</strong><br>{{ $tracerStudy->posisi_pekerjaan ?? '-' }}</p>
                        </div>
                        <div class="col-md-4">
                            <p><strong>Bidang:</strong><br>{{ $tracerStudy->bidang_pekerjaan ?? '-' }}</p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-4">
                            <p><strong>Tingkat Pendidikan:</strong><br>{{ $tracerStudy->tingkat_pendidikan_pekerjaan ? strtoupper($tracerStudy->tingkat_pendidikan_pekerjaan) : '-' }}</p>
                        </div>
                        <div class="col-md-4">
                            <p><strong>Gaji Pertama:</strong><br>{{ $tracerStudy->gaji_pertama ? 'Rp ' . number_format($tracerStudy->gaji_pertama, 0, ',', '.') : '-' }}</p>
                        </div>
                        <div class="col-md-4">
                            <p><strong>Gaji Sekarang:</strong><br>{{ $tracerStudy->gaji_sekarang ? 'Rp ' . number_format($tracerStudy->gaji_sekarang, 0, ',', '.') : '-' }}</p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Kesesuaian Pekerjaan:</strong><br>{{ $tracerStudy->kesesuaian_pekerjaan ? ucwords(str_replace('_', ' ', $tracerStudy->kesesuaian_pekerjaan)) : '-' }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Cara Dapat Kerja:</strong><br>{{ $tracerStudy->cara_dapat_kerja ?? '-' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Penilaian Kompetensi -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Penilaian Kompetensi <small class="text-muted">(Skala 1-5)</small></h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <p><strong>Kompetensi Teknis:</strong> {{ $tracerStudy->kompetensi_teknis ?? '-' }}/5</p>
                        </div>
                        <div class="col-md-4">
                            <p><strong>Bahasa Inggris:</strong> {{ $tracerStudy->kompetensi_bahasa_inggris ?? '-' }}/5</p>
                        </div>
                        <div class="col-md-4">
                            <p><strong>Komunikasi:</strong> {{ $tracerStudy->kompetensi_komunikasi ?? '-' }}/5</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Teamwork:</strong> {{ $tracerStudy->kompetensi_teamwork ?? '-' }}/5</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Problem Solving:</strong> {{ $tracerStudy->kompetensi_problem_solving ?? '-' }}/5</p>
                        </div>
                    </div>
                    @if($tracerStudy->average_kompetensi)
                    <hr>
                    <p class="mb-0"><strong>Rata-rata Kompetensi:</strong> <span class="badge badge-success">{{ number_format($tracerStudy->average_kompetensi, 2) }}/5</span></p>
                    @endif
                </div>
            </div>

            <!-- Kepuasan terhadap Prodi -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Kepuasan terhadap Prodi <small class="text-muted">(Skala 1-5)</small></h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <p><strong>Kurikulum:</strong> {{ $tracerStudy->kepuasan_kurikulum ?? '-' }}/5</p>
                        </div>
                        <div class="col-md-4">
                            <p><strong>Dosen:</strong> {{ $tracerStudy->kepuasan_dosen ?? '-' }}/5</p>
                        </div>
                        <div class="col-md-4">
                            <p><strong>Fasilitas:</strong> {{ $tracerStudy->kepuasan_fasilitas ?? '-' }}/5</p>
                        </div>
                    </div>
                    @if($tracerStudy->average_kepuasan)
                    <hr>
                    <p class="mb-0"><strong>Rata-rata Kepuasan:</strong> <span class="badge badge-success">{{ number_format($tracerStudy->average_kepuasan, 2) }}/5</span></p>
                    @endif
                </div>
            </div>

            <!-- Saran dan Pesan -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Saran dan Pesan</h6>
                </div>
                <div class="card-body">
                    @if($tracerStudy->saran_untuk_prodi)
                    <div class="mb-3">
                        <strong>Saran untuk Prodi:</strong>
                        <div class="bg-light p-3 rounded mt-2" style="white-space: pre-line;">{{ $tracerStudy->saran_untuk_prodi }}</div>
                    </div>
                    @endif

                    @if($tracerStudy->pesan_untuk_juniors)
                    <div>
                        <strong>Pesan untuk Junior:</strong>
                        <div class="bg-light p-3 rounded mt-2" style="white-space: pre-line;">{{ $tracerStudy->pesan_untuk_juniors }}</div>
                    </div>
                    @endif

                    @if(!$tracerStudy->saran_untuk_prodi && !$tracerStudy->pesan_untuk_juniors)
                    <p class="text-muted mb-0">Tidak ada saran atau pesan.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
