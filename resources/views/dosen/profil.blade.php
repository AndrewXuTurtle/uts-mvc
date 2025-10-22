<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Dosen - {{ $dosen->nama_lengkap }}</title>

    {{-- Bootstrap 5 CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    {{-- Font Awesome untuk Ikon --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>
        body {
            background-color: #f8f9fa;
        }
        .profile-card {
            border-radius: 15px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        .profile-img {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border: 4px solid #fff;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }
        .card-title-icon {
            color: #0d6efd;
        }
    </style>
</head>
<body>

<div class="container my-5">
    <div class="row">
        {{-- Kolom Kiri: Foto dan Info Kontak --}}
        <div class="col-lg-4 mb-4">
            <div class="card profile-card text-center p-4">
                <img src="{{ $dosen->foto ?? 'https://via.placeholder.com/150' }}" 
                     alt="Foto Profil {{ $dosen->nama_lengkap }}" 
                     class="rounded-circle mx-auto profile-img">
                <div class="card-body">
                    <h3 class="card-title mt-3">{{ $dosen->nama_lengkap }}</h3>
                    <p class="text-muted">{{ $dosen->jabatan }}</p>
                    <span class="badge bg-primary-subtle border border-primary-subtle text-primary-emphasis rounded-pill mb-3">{{ $dosen->program_studi }}</span>
                    
                    <div class="d-flex justify-content-center flex-wrap gap-2">
                         <a href="{{ $dosen->link_google_scholar ?? '#' }}" class="btn btn-sm btn-outline-dark" target="_blank"><i class="fas fa-graduation-cap"></i> Scholar</a>
                         <a href="{{ $dosen->link_sinta ?? '#' }}" class="btn btn-sm btn-outline-success" target="_blank"><i class="fas fa-database"></i> SINTA</a>
                         <a href="{{ $dosen->link_linkedin ?? '#' }}" class="btn btn-sm btn-outline-primary" target="_blank"><i class="fab fa-linkedin"></i> LinkedIn</a>
                    </div>
                </div>
                <ul class="list-group list-group-flush text-start">
                    <li class="list-group-item"><i class="fa-solid fa-id-card fa-fw me-2 text-muted"></i><strong>NIDN:</strong> {{ $dosen->nidn }}</li>
                    <li class="list-group-item"><i class="fa-solid fa-envelope fa-fw me-2 text-muted"></i><a href="mailto:{{ $dosen->email }}" class="text-decoration-none">{{ $dosen->email }}</a></li>
                    <li class="list-group-item"><i class="fa-solid fa-map-marker-alt fa-fw me-2 text-muted"></i><strong>Kantor:</strong> {{ $dosen->ruang_kantor }}</li>
                </ul>
            </div>
        </div>

        {{-- Kolom Kanan: Detail Informasi --}}
        <div class="col-lg-8">
            {{-- Biografi --}}
            <div class="card profile-card mb-4">
                <div class="card-body p-4">
                    <h5 class="mb-3"><i class="fas fa-user-circle fa-fw card-title-icon me-2"></i>Biografi</h5>
                    <p class="text-muted">{{ $dosen->biografi }}</p>
                </div>
            </div>

            {{-- Riwayat Pendidikan --}}
            <div class="card profile-card mb-4">
                <div class="card-body p-4">
                    <h5 class="mb-3"><i class="fas fa-university fa-fw card-title-icon me-2"></i>Riwayat Pendidikan</h5>
                    <ul class="list-unstyled">
                        @forelse ($dosen->pendidikan as $item)
                        <li class="mb-3">
                            <div class="d-flex justify-content-between">
                                <strong class="text-primary">{{ $item->gelar }} {{ $item->jurusan }}</strong>
                                <span class="text-muted">{{ $item->tahun_lulus }}</span>
                            </div>
                            <div>{{ $item->universitas }}</div>
                        </li>
                        @empty
                        <p class="text-muted">Data riwayat pendidikan belum tersedia.</p>
                        @endforelse
                    </ul>
                </div>
            </div>

            {{-- Publikasi Terbaru --}}
            <div class="card profile-card">
                <div class="card-body p-4">
                    <h5 class="mb-3"><i class="fas fa-book-open fa-fw card-title-icon me-2"></i>Publikasi Terbaru</h5>
                    <div class="list-group list-group-flush">
                        @forelse ($dosen->publikasi as $item)
                        <a href="{{ $item->link ?? '#' }}" target="_blank" class="list-group-item list-group-item-action px-0">
                            <div class="d-flex w-100 justify-content-between">
                                <p class="mb-1 fw-bold">{{ $item->judul }}</p>
                                <small class="text-muted">{{ $item->tahun }}</small>
                            </div>
                            <small class="text-muted">{{ $item->jurnal }}</small>
                        </a>
                        @empty
                        <p class="text-muted">Belum ada data publikasi.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Bootstrap 5 JS --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>