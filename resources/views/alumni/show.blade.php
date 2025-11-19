@extends('layouts.app')

@section('content')
<div class="container-fluid">
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
        <!-- Left Column -->
        <div class="col-lg-4">
            <div class="card shadow mb-4">
                <div class="card-body text-center">
                    @if($alumni->mahasiswa && $alumni->mahasiswa->foto)
                        <img src="{{ asset('storage/' . $alumni->mahasiswa->foto) }}" alt="{{ $alumni->mahasiswa->nama }}" 
                             class="img-fluid rounded-circle mb-3" style="max-width: 200px; height: 200px; object-fit: cover;">
                    @else
                        <div class="rounded-circle bg-primary text-white d-inline-flex align-items-center justify-content-center mb-3" 
                             style="width: 200px; height: 200px; font-size: 80px;">
                            {{ substr($alumni->mahasiswa->nama ?? 'A', 0, 1) }}
                        </div>
                    @endif
                    
                    <h4 class="mb-1">{{ $alumni->mahasiswa->nama ?? '-' }}</h4>
                    <p class="text-muted mb-2">{{ $alumni->nim }}</p>
                    <span class="badge badge-primary badge-lg">Alumni {{ $alumni->tahun_lulus ?? '-' }}</span>
                </div>
            </div>

            <!-- Contact Info -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-address-card"></i> Informasi Kontak
                    </h6>
                </div>
                <div class="card-body">
                    @if($alumni->mahasiswa)
                        <div class="mb-2">
                            <i class="fas fa-envelope text-primary"></i>
                            <a href="mailto:{{ $alumni->mahasiswa->email }}">{{ $alumni->mahasiswa->email ?? '-' }}</a>
                        </div>
                        <div class="mb-2">
                            <i class="fas fa-phone text-primary"></i>
                            <span>{{ $alumni->mahasiswa->no_telp ?? '-' }}</span>
                        </div>
                        <div>
                            <i class="fas fa-map-marker-alt text-primary"></i>
                            <span>{{ $alumni->mahasiswa->alamat ?? '-' }}</span>
                        </div>
                    @else
                        <p class="text-muted mb-0">Data mahasiswa tidak ditemukan</p>
                    @endif
                </div>
            </div>
        </div>

        <!-- Right Column -->
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
                            <strong>NIM:</strong>
                            <p>{{ $alumni->nim }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <strong>Nama Lengkap:</strong>
                            <p>{{ $alumni->mahasiswa->nama ?? '-' }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <strong>Program Studi:</strong>
                            <p>{{ $alumni->mahasiswa->prodi ?? 'Teknik Perangkat Lunak' }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <strong>Tahun Lulus:</strong>
                            <p><span class="badge badge-primary">{{ $alumni->tahun_lulus ?? '-' }}</span></p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <strong>Status Mahasiswa:</strong>
                            <p><span class="badge badge-success">{{ $alumni->mahasiswa->status ?? 'Lulus' }}</span></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tracer Study -->
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-briefcase"></i> Tracer Study
                    </h6>
                    <a href="{{ route('tracer-study.create', ['nim' => $alumni->nim]) }}" class="btn btn-sm btn-primary">
                        <i class="fas fa-plus"></i> Tambah
                    </a>
                </div>
                <div class="card-body">
                    @if($alumni->tracerStudies && $alumni->tracerStudies->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-bordered table-sm">
                                <thead>
                                    <tr>
                                        <th>Status</th>
                                        <th>Perusahaan</th>
                                        <th>Posisi</th>
                                        <th>Mulai Kerja</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($alumni->tracerStudies as $tracer)
                                    <tr>
                                        <td><span class="badge badge-success">{{ $tracer->status_pekerjaan ?? '-' }}</span></td>
                                        <td>{{ $tracer->nama_perusahaan ?? '-' }}</td>
                                        <td>{{ $tracer->posisi ?? '-' }}</td>
                                        <td>{{ $tracer->tanggal_mulai ? \Carbon\Carbon::parse($tracer->tanggal_mulai)->format('M Y') : '-' }}</td>
                                        <td>
                                            <a href="{{ route('tracer-study.show', $tracer->id) }}" class="btn btn-info btn-sm">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-muted mb-0">Belum ada data tracer study. 
                            <a href="{{ route('tracer-study.create', ['nim' => $alumni->nim]) }}">Tambah data tracer study</a>
                        </p>
                    @endif
                </div>
            </div>

            <!-- Kisah Sukses -->
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-star"></i> Kisah Sukses
                    </h6>
                    <a href="{{ route('kisah-sukses.create', ['nim' => $alumni->nim]) }}" class="btn btn-sm btn-primary">
                        <i class="fas fa-plus"></i> Tambah
                    </a>
                </div>
                <div class="card-body">
                    @if($alumni->kisahSukses && $alumni->kisahSukses->count() > 0)
                        <div class="row">
                            @foreach($alumni->kisahSukses as $kisah)
                            <div class="col-md-12 mb-3">
                                <div class="card border-left-success shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <h5 class="font-weight-bold text-success mb-1">{{ $kisah->judul ?? 'Tanpa Judul' }}</h5>
                                                <p class="mb-2">{{ Str::limit($kisah->cerita ?? '', 150) }}</p>
                                                <small class="text-muted">
                                                    <i class="fas fa-calendar"></i> {{ $kisah->created_at ? $kisah->created_at->format('d M Y') : '-' }}
                                                </small>
                                            </div>
                                            <div>
                                                <a href="{{ route('kisah-sukses.show', $kisah->id) }}" class="btn btn-success btn-sm">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-muted mb-0">Belum ada kisah sukses. 
                            <a href="{{ route('kisah-sukses.create', ['nim' => $alumni->nim]) }}">Tambah kisah sukses</a>
                        </p>
                    @endif
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('alumni.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                        <div>
                            <a href="{{ route('alumni.edit', $alumni->id) }}" class="btn btn-warning">
                                <i class="fas fa-edit"></i> Edit
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
                Apakah Anda yakin ingin menghapus data alumni <strong>{{ $alumni->mahasiswa->nama ?? $alumni->nim }}</strong>?
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
