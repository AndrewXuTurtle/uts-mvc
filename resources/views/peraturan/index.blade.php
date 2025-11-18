@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Peraturan & Dokumen</h1>
        <a href="{{ route('peraturan.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Peraturan
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <!-- Tabs -->
    <ul class="nav nav-tabs mb-3" id="kategoriTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="akademik-tab" data-toggle="tab" href="#akademik" role="tab">
                <i class="fas fa-graduation-cap"></i> Akademik
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="kemahasiswaan-tab" data-toggle="tab" href="#kemahasiswaan" role="tab">
                <i class="fas fa-users"></i> Kemahasiswaan
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="administratif-tab" data-toggle="tab" href="#administratif" role="tab">
                <i class="fas fa-file-alt"></i> Administratif
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="keuangan-tab" data-toggle="tab" href="#keuangan" role="tab">
                <i class="fas fa-coins"></i> Keuangan
            </a>
        </li>
    </ul>

    <!-- Tab Content -->
    <div class="tab-content" id="kategoriTabContent">
        <!-- Akademik Tab -->
        <div class="tab-pane fade show active" id="akademik" role="tabpanel">
            <div class="row">
                @php
                    $akademikPeraturan = $peraturan->where('kategori', 'Akademik');
                @endphp
                @forelse($akademikPeraturan as $p)
                <div class="col-md-6 mb-4">
                    <div class="card shadow-sm h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <h5 class="card-title mb-0">{{ $p->judul }}</h5>
                                <span class="badge badge-primary">{{ $p->jenis }}</span>
                            </div>
                            <p class="card-text text-muted small">{{ Str::limit($p->deskripsi, 100) }}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <small class="text-muted">
                                    <i class="fas fa-file-pdf text-danger"></i> {{ $p->file_size_formatted }}
                                </small>
                                <div>
                                    <a href="{{ Storage::url($p->file_path) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-download"></i> Download
                                    </a>
                                    <a href="{{ route('peraturan.edit', $p) }}" class="btn btn-sm btn-outline-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('peraturan.destroy', $p) }}" method="POST" class="d-inline" 
                                          onsubmit="return confirm('Yakin ingin menghapus peraturan ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12">
                    <div class="alert alert-info">Belum ada peraturan akademik.</div>
                </div>
                @endforelse
            </div>
        </div>

        <!-- Kemahasiswaan Tab -->
        <div class="tab-pane fade" id="kemahasiswaan" role="tabpanel">
            <div class="row">
                @php
                    $kemahasiswaanPeraturan = $peraturan->where('kategori', 'Kemahasiswaan');
                @endphp
                @forelse($kemahasiswaanPeraturan as $p)
                <div class="col-md-6 mb-4">
                    <div class="card shadow-sm h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <h5 class="card-title mb-0">{{ $p->judul }}</h5>
                                <span class="badge badge-success">{{ $p->jenis }}</span>
                            </div>
                            <p class="card-text text-muted small">{{ Str::limit($p->deskripsi, 100) }}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <small class="text-muted">
                                    <i class="fas fa-file-pdf text-danger"></i> {{ $p->file_size_formatted }}
                                </small>
                                <div>
                                    <a href="{{ Storage::url($p->file_path) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-download"></i> Download
                                    </a>
                                    <a href="{{ route('peraturan.edit', $p) }}" class="btn btn-sm btn-outline-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('peraturan.destroy', $p) }}" method="POST" class="d-inline" 
                                          onsubmit="return confirm('Yakin ingin menghapus peraturan ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12">
                    <div class="alert alert-info">Belum ada peraturan kemahasiswaan.</div>
                </div>
                @endforelse
            </div>
        </div>

        <!-- Administratif Tab -->
        <div class="tab-pane fade" id="administratif" role="tabpanel">
            <div class="row">
                @php
                    $administratifPeraturan = $peraturan->where('kategori', 'Administratif');
                @endphp
                @forelse($administratifPeraturan as $p)
                <div class="col-md-6 mb-4">
                    <div class="card shadow-sm h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <h5 class="card-title mb-0">{{ $p->judul }}</h5>
                                <span class="badge badge-info">{{ $p->jenis }}</span>
                            </div>
                            <p class="card-text text-muted small">{{ Str::limit($p->deskripsi, 100) }}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <small class="text-muted">
                                    <i class="fas fa-file-pdf text-danger"></i> {{ $p->file_size_formatted }}
                                </small>
                                <div>
                                    <a href="{{ Storage::url($p->file_path) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-download"></i> Download
                                    </a>
                                    <a href="{{ route('peraturan.edit', $p) }}" class="btn btn-sm btn-outline-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('peraturan.destroy', $p) }}" method="POST" class="d-inline" 
                                          onsubmit="return confirm('Yakin ingin menghapus peraturan ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12">
                    <div class="alert alert-info">Belum ada peraturan administratif.</div>
                </div>
                @endforelse
            </div>
        </div>

        <!-- Keuangan Tab -->
        <div class="tab-pane fade" id="keuangan" role="tabpanel">
            <div class="row">
                @php
                    $keuanganPeraturan = $peraturan->where('kategori', 'Keuangan');
                @endphp
                @forelse($keuanganPeraturan as $p)
                <div class="col-md-6 mb-4">
                    <div class="card shadow-sm h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <h5 class="card-title mb-0">{{ $p->judul }}</h5>
                                <span class="badge badge-warning">{{ $p->jenis }}</span>
                            </div>
                            <p class="card-text text-muted small">{{ Str::limit($p->deskripsi, 100) }}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <small class="text-muted">
                                    <i class="fas fa-file-pdf text-danger"></i> {{ $p->file_size_formatted }}
                                </small>
                                <div>
                                    <a href="{{ Storage::url($p->file_path) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-download"></i> Download
                                    </a>
                                    <a href="{{ route('peraturan.edit', $p) }}" class="btn btn-sm btn-outline-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('peraturan.destroy', $p) }}" method="POST" class="d-inline" 
                                          onsubmit="return confirm('Yakin ingin menghapus peraturan ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12">
                    <div class="alert alert-info">Belum ada peraturan keuangan.</div>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
