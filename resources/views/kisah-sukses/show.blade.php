@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail Kisah Sukses</h1>
        <div>
            <a href="{{ route('kisah-sukses.edit', $kisahSukses->id) }}" class="btn btn-warning btn-sm">
                <i class="fas fa-edit"></i> Edit
            </a>
            <a href="{{ route('kisah-sukses.index') }}" class="btn btn-secondary btn-sm">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>

    <div class="row">
        <!-- Main Content -->
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-body">
                    @if($kisahSukses->foto)
                    <img src="{{ asset('storage/' . $kisahSukses->foto) }}" alt="{{ $kisahSukses->judul }}" 
                         class="img-fluid rounded mb-4" style="width: 100%; max-height: 400px; object-fit: cover;">
                    @endif

                    <h2 class="mb-3">{{ $kisahSukses->judul }}</h2>

                    <div class="mb-3">
                        @if($kisahSukses->status == 'Published')
                        <span class="badge badge-success mr-2">Published</span>
                        @else
                        <span class="badge badge-warning mr-2">Draft</span>
                        @endif
                    </div>

                    <div class="mb-4" style="white-space: pre-line;">{{ $kisahSukses->kisah }}</div>

                    @if($kisahSukses->pencapaian)
                    <div class="alert alert-info">
                        <strong><i class="fas fa-trophy mr-2"></i>Pencapaian:</strong> {{ $kisahSukses->pencapaian }}
                        @if($kisahSukses->tahun_pencapaian)
                        <span class="float-right">{{ $kisahSukses->tahun_pencapaian }}</span>
                        @endif
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Alumni Info -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Informasi Mahasiswa</h6>
                </div>
                <div class="card-body">
                    @if($kisahSukses->mahasiswa)
                    <div class="text-center mb-3">
                        @if($kisahSukses->mahasiswa->foto)
                        <img src="{{ Storage::url($kisahSukses->mahasiswa->foto) }}" alt="{{ $kisahSukses->mahasiswa->nama }}" 
                             class="rounded-circle" style="width: 100px; height: 100px; object-fit: cover;">
                        @else
                        <div class="rounded-circle bg-primary text-white d-inline-flex align-items-center justify-content-center" 
                             style="width: 100px; height: 100px; font-size: 2rem;">
                            {{ substr($kisahSukses->mahasiswa->nama, 0, 1) }}
                        </div>
                        @endif
                    </div>
                    <h5 class="text-center">{{ $kisahSukses->mahasiswa->nama }}</h5>
                    <p class="text-center text-muted">NIM: {{ $kisahSukses->mahasiswa->nim }}</p>
                    
                    @if($kisahSukses->mahasiswa->tahun_lulus)
                    <p class="mb-1"><strong>Tahun Lulus:</strong> {{ $kisahSukses->mahasiswa->tahun_lulus }}</p>
                    @endif
                    
                    @if($kisahSukses->mahasiswa->prodi)
                    <p class="mb-1"><strong>Program Studi:</strong> {{ $kisahSukses->mahasiswa->prodi }}</p>
                    @endif
                    
                    @if($kisahSukses->mahasiswa->kelas)
                    <p class="mb-1"><strong>Kelas:</strong> {{ $kisahSukses->mahasiswa->kelas }}</p>
                    @endif
                    
                    @if($kisahSukses->mahasiswa->email)
                    <p class="mb-1"><strong>Email:</strong> <a href="mailto:{{ $kisahSukses->mahasiswa->email }}">{{ $kisahSukses->mahasiswa->email }}</a></p>
                    @endif
                    @else
                    <p class="text-muted">Data mahasiswa tidak tersedia</p>
                    @endif
                </div>
            </div>

            <!-- Info -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Informasi</h6>
                </div>
                <div class="card-body">
                    <p class="mb-2"><strong>Status:</strong> 
                        @if($kisahSukses->status == 'Published')
                        <span class="badge badge-success">Published</span>
                        @else
                        <span class="badge badge-warning">Draft</span>
                        @endif
                    </p>
                    @if($kisahSukses->pencapaian)
                    <p class="mb-2"><strong>Pencapaian:</strong> {{ $kisahSukses->pencapaian }}</p>
                    @endif
                    @if($kisahSukses->tahun_pencapaian)
                    <p class="mb-2"><strong>Tahun:</strong> {{ $kisahSukses->tahun_pencapaian }}</p>
                    @endif
                    <p class="mb-0"><strong>Dibuat:</strong> {{ $kisahSukses->created_at->format('d M Y H:i') }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
