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
                    @if($kisahSukses->foto_utama)
                    <img src="{{ Storage::url($kisahSukses->foto_utama) }}" alt="{{ $kisahSukses->judul }}" 
                         class="img-fluid rounded mb-4" style="width: 100%; max-height: 400px; object-fit: cover;">
                    @endif

                    <h2 class="mb-3">{{ $kisahSukses->judul }}</h2>

                    <div class="mb-3">
                        <span class="badge badge-info mr-2">{{ ucwords(str_replace('_', ' ', $kisahSukses->kategori)) }}</span>
                        @if($kisahSukses->status == 'published')
                        <span class="badge badge-success mr-2">Published</span>
                        @elseif($kisahSukses->status == 'draft')
                        <span class="badge badge-warning mr-2">Draft</span>
                        @else
                        <span class="badge badge-secondary mr-2">Archived</span>
                        @endif
                        @if($kisahSukses->is_featured)
                        <span class="badge badge-warning"><i class="fas fa-star"></i> Featured</span>
                        @endif
                    </div>

                    @if($kisahSukses->quote)
                    <blockquote class="blockquote bg-light p-3 rounded mb-4">
                        <p class="mb-0"><i class="fas fa-quote-left mr-2"></i>{{ $kisahSukses->quote }}</p>
                    </blockquote>
                    @endif

                    <div class="mb-4" style="white-space: pre-line;">{{ $kisahSukses->cerita }}</div>

                    @if($kisahSukses->video_url)
                    <div class="mb-4">
                        <h5>Video</h5>
                        <div class="embed-responsive embed-responsive-16by9">
                            @php
                                $videoUrl = $kisahSukses->video_url;
                                if (strpos($videoUrl, 'youtube.com') !== false || strpos($videoUrl, 'youtu.be') !== false) {
                                    preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/)([^\&\?\/]+)/', $videoUrl, $matches);
                                    $videoId = $matches[1] ?? '';
                                    $embedUrl = "https://www.youtube.com/embed/{$videoId}";
                                } else {
                                    $embedUrl = $videoUrl;
                                }
                            @endphp
                            <iframe class="embed-responsive-item" src="{{ $embedUrl }}" allowfullscreen></iframe>
                        </div>
                    </div>
                    @endif

                    @if($kisahSukses->galeri_foto && count($kisahSukses->galeri_foto) > 0)
                    <div class="mb-4">
                        <h5>Galeri Foto</h5>
                        <div class="row">
                            @foreach($kisahSukses->galeri_foto as $foto)
                            <div class="col-md-4 mb-3">
                                <img src="{{ Storage::url($foto) }}" alt="Galeri" class="img-fluid rounded" style="width: 100%; height: 200px; object-fit: cover;">
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    @if($kisahSukses->tags && count($kisahSukses->tags) > 0)
                    <div class="mb-3">
                        <strong>Tags:</strong>
                        @foreach($kisahSukses->tags as $tag)
                        <span class="badge badge-secondary">{{ $tag }}</span>
                        @endforeach
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

            <!-- Statistics -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Statistik</h6>
                </div>
                <div class="card-body">
                    <p class="mb-2"><i class="fas fa-eye mr-2"></i><strong>Views:</strong> {{ number_format($kisahSukses->views) }}</p>
                    <p class="mb-2"><i class="fas fa-calendar mr-2"></i><strong>Publish:</strong> {{ date('d M Y', strtotime($kisahSukses->tanggal_publish)) }}</p>
                    <p class="mb-0"><i class="fas fa-clock mr-2"></i><strong>Dibuat:</strong> {{ $kisahSukses->created_at->format('d M Y H:i') }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
