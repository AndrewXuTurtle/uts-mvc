@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>

    @php
        use Illuminate\Support\Str;
    @endphp

    <!-- Content Row -->
    <div class="row">
        <!-- Data Dosen Card -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Data Dosen</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalDosen }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-chalkboard-teacher fa-lg text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Data Project Card -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Total Data Project</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalProjects }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-project-diagram fa-lg text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Data Mata Kuliah Card -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Total Data Mata Kuliah</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalMatakuliah }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-book fa-lg text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Row -->
    <div class="row">
        <!-- Recent Dosen -->
        <div class="col-lg-4 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Data Dosen Terbaru</h6>
                </div>
                <div class="card-body">
                    @forelse($recentDosen as $dosen)
                        <div class="d-flex align-items-center mb-3">
                            <div class="mr-3">
                                @if($dosen->foto)
                                    <img class="rounded-circle" src="{{ asset('storage/' . $dosen->foto) }}" alt="Foto {{ $dosen->nama }}" style="width: 40px; height: 40px; object-fit: cover;">
                                @else
                                    <img class="rounded-circle" src="{{ asset('template/img/undraw_profile.svg') }}" alt="Default" style="width: 40px; height: 40px;">
                                @endif
                            </div>
                            <div>
                                <div class="font-weight-bold text-gray-800">{{ $dosen->nama }}</div>
                                <div class="text-xs text-muted">{{ $dosen->jabatan }}</div>
                            </div>
                        </div>
                    @empty
                        <p class="text-muted">Belum ada data dosen</p>
                    @endforelse
                    <a href="{{ route('dosen.index') }}" class="btn btn-primary btn-sm btn-block">Lihat Semua Dosen</a>
                </div>
            </div>
        </div>

        <!-- Recent Projects -->
        <div class="col-lg-4 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-success">Data Project Terbaru</h6>
                </div>
                <div class="card-body">
                    @forelse($recentProjects as $project)
                        <div class="mb-3">
                            <div class="font-weight-bold text-gray-800">{{ Str::limit($project->judul_proyek, 30) }}</div>
                            <div class="text-xs text-muted">{{ $project->nama_mahasiswa }} - {{ $project->tahun_selesai }}</div>
                        </div>
                    @empty
                        <p class="text-muted">Belum ada data project</p>
                    @endforelse
                    <a href="{{ route('project.index') }}" class="btn btn-success btn-sm btn-block">Lihat Semua Project</a>
                </div>
            </div>
        </div>

        <!-- Recent Mata Kuliah -->
        <div class="col-lg-4 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-info">Data Mata Kuliah Terbaru</h6>
                </div>
                <div class="card-body">
                    @forelse($recentMatakuliah as $matakuliah)
                        <div class="mb-3">
                            <div class="font-weight-bold text-gray-800">{{ $matakuliah->nama_mk }}</div>
                            <div class="text-xs text-muted">{{ $matakuliah->kode_mk }} - Semester {{ $matakuliah->semester }}</div>
                        </div>
                    @empty
                        <p class="text-muted">Belum ada data mata kuliah</p>
                    @endforelse
                    <a href="{{ route('matakuliah.index') }}" class="btn btn-info btn-sm btn-block">Lihat Semua Mata Kuliah</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
