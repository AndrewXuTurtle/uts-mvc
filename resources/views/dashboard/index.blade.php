@extends('layouts.app')

@push('styles')
<style>
    .recent-activity-item {
        padding: 12px;
        border-left: 3px solid #e3e6f0;
        margin-bottom: 10px;
        transition: all 0.3s ease;
    }
    
    .recent-activity-item:hover {
        border-left-color: #667eea;
        background: #f8f9fc;
        transform: translateX(5px);
    }
    
    .news-card {
        transition: all 0.3s ease;
        cursor: pointer;
    }
    
    .news-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 0.5rem 1.5rem rgba(0,0,0,0.15);
    }
    
    .news-img {
        height: 150px;
        object-fit: cover;
        border-radius: 0.5rem;
    }
    
    .agenda-item {
        padding: 10px;
        border-radius: 0.5rem;
        background: #f8f9fc;
        margin-bottom: 8px;
        transition: all 0.3s ease;
    }
    
    .agenda-item:hover {
        background: #e3e6f0;
        transform: translateX(5px);
    }
</style>
@endpush

@section('content')
<div class="animate-fade-in">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <i class="fas fa-home mr-2"></i>Dashboard Admin TPL
        </h1>
        <div>
            <span class="d-none d-sm-inline-block badge badge-primary px-3 py-2 mr-2">
                <i class="fas fa-clock mr-1"></i>
                {{ now()->format('H:i') }}
            </span>
            <span class="d-none d-sm-inline-block badge badge-info px-3 py-2">
                <i class="fas fa-calendar-alt mr-1"></i>
                {{ now()->format('d M Y') }}
            </span>
        </div>
    </div>

    <!-- Welcome Card -->
    <div class="card border-left-primary shadow mb-4">
        <div class="card-body">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <h5 class="font-weight-bold text-primary mb-2">
                        <i class="fas fa-hand-sparkles mr-2"></i>Selamat Datang, {{ auth()->user()->name }}!
                    </h5>
                    <p class="text-muted mb-0">
                        Kelola seluruh data sistem informasi TPL dengan mudah dan efisien. 
                        Dashboard ini dibangun menggunakan Laravel 12 dengan modern UI design.
                    </p>
                </div>
                <div class="col-lg-4 text-right d-none d-lg-block">
                    <div class="text-muted">
                        <small>Last Login:</small><br>
                        <strong>{{ auth()->user()->updated_at->diffForHumans() }}</strong>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Cards Row -->
    <div class="row">
        <!-- Dosen Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="stats-card" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                <div class="position-relative">
                    <div class="text-xs font-weight-bold text-uppercase mb-1">Total Dosen</div>
                    <div class="h5 mb-0 font-weight-bold">
                        {{ App\Models\Dosen::count() }}
                    </div>
                    <i class="fas fa-chalkboard-teacher icon"></i>
                </div>
            </div>
        </div>

        <!-- Mahasiswa Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="stats-card" style="background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);">
                <div class="position-relative">
                    <div class="text-xs font-weight-bold text-uppercase mb-1">Total Mahasiswa</div>
                    <div class="h5 mb-0 font-weight-bold">
                        {{ App\Models\Mahasiswa::count() }}
                    </div>
                    <i class="fas fa-user-graduate icon"></i>
                </div>
            </div>
        </div>

        <!-- Alumni Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="stats-card" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
                <div class="position-relative">
                    <div class="text-xs font-weight-bold text-uppercase mb-1">Total Alumni</div>
                    <div class="h5 mb-0 font-weight-bold">
                        {{ DB::table('alumni')->count() }}
                    </div>
                    <i class="fas fa-user-tie icon"></i>
                </div>
            </div>
        </div>

        <!-- Berita Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="stats-card" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">
                <div class="position-relative">
                    <div class="text-xs font-weight-bold text-uppercase mb-1">Total Berita</div>
                    <div class="h5 mb-0 font-weight-bold">
                        {{ App\Models\Berita::count() }}
                    </div>
                    <i class="fas fa-newspaper icon"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Access Row -->
    <div class="row">
        <!-- Charts Section -->
        <div class="col-lg-8 mb-4">
            <!-- Data Overview Chart -->
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold">
                        <i class="fas fa-chart-bar mr-2"></i>Data Overview
                    </h6>
                </div>
                <div class="card-body">
                    <canvas id="dataOverviewChart" height="100"></canvas>
                </div>
            </div>

            <!-- Recent Berita -->
            <div class="card shadow mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold">
                        <i class="fas fa-newspaper mr-2"></i>Berita Terbaru
                    </h6>
                    <a href="{{ route('berita.index') }}" class="btn btn-sm btn-primary">
                        Lihat Semua <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                </div>
                <div class="card-body">
                    @php
                        $latestBerita = App\Models\Berita::latest()->take(3)->get();
                    @endphp
                    
                    @if($latestBerita->count() > 0)
                        <div class="row">
                            @foreach($latestBerita as $berita)
                            <div class="col-md-4 mb-3">
                                <div class="news-card card border-0">
                                    @if($berita->gambar)
                                        <img src="{{ asset('storage/' . $berita->gambar) }}" 
                                             class="news-img" 
                                             alt="{{ $berita->judul }}"
                                             onerror="this.src='https://via.placeholder.com/400x150?text=No+Image'">
                                    @else
                                        <img src="https://via.placeholder.com/400x150?text=No+Image" 
                                             class="news-img" 
                                             alt="No Image">
                                    @endif
                                    <div class="card-body p-2">
                                        <h6 class="font-weight-bold mb-1 text-truncate">{{ $berita->judul }}</h6>
                                        <small class="text-muted">
                                            <i class="fas fa-calendar mr-1"></i>{{ $berita->tanggal }}
                                        </small>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center text-muted py-3">
                            <i class="fas fa-inbox fa-3x mb-2"></i>
                            <p>Belum ada berita</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Right Sidebar -->
        <div class="col-lg-4 mb-4">
            <!-- Recent Activity -->
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold">
                        <i class="fas fa-history mr-2"></i>Aktivitas Terbaru
                    </h6>
                </div>
                <div class="card-body" style="max-height: 400px; overflow-y: auto;">
                    @php
                        $activities = [];
                        
                        // Berita terbaru
                        $recentBerita = App\Models\Berita::latest()->take(2)->get();
                        foreach($recentBerita as $item) {
                            $activities[] = [
                                'icon' => 'newspaper',
                                'color' => 'primary',
                                'text' => 'Berita baru: ' . Str::limit($item->judul, 40),
                                'time' => $item->created_at->diffForHumans()
                            ];
                        }
                        
                        // Mahasiswa terbaru
                        $recentMahasiswa = App\Models\Mahasiswa::latest()->take(2)->get();
                        foreach($recentMahasiswa as $item) {
                            $activities[] = [
                                'icon' => 'user-graduate',
                                'color' => 'success',
                                'text' => 'Mahasiswa baru: ' . $item->nama,
                                'time' => $item->created_at->diffForHumans()
                            ];
                        }
                        
                        // Sort by time
                        usort($activities, function($a, $b) {
                            return strtotime($b['time']) <=> strtotime($a['time']);
                        });
                        
                        $activities = array_slice($activities, 0, 5);
                    @endphp
                    
                    @if(count($activities) > 0)
                        @foreach($activities as $activity)
                        <div class="recent-activity-item">
                            <div class="d-flex align-items-start">
                                <div class="mr-3">
                                    <div class="icon-circle bg-{{ $activity['color'] }}">
                                        <i class="fas fa-{{ $activity['icon'] }} text-white"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <div class="small font-weight-bold">{{ $activity['text'] }}</div>
                                    <div class="small text-muted">
                                        <i class="fas fa-clock mr-1"></i>{{ $activity['time'] }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @else
                        <div class="text-center text-muted py-3">
                            <i class="fas fa-inbox fa-2x mb-2"></i>
                            <p>Tidak ada aktivitas</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Upcoming Agenda -->
            <div class="card shadow mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold">
                        <i class="fas fa-calendar-alt mr-2"></i>Agenda Mendatang
                    </h6>
                    <a href="{{ route('agenda.index') }}" class="btn btn-sm btn-outline-primary">
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
                <div class="card-body">
                    @php
                        $upcomingAgenda = DB::table('agenda')
                            ->where('aktif', 1)
                            ->where('tanggal_mulai', '>=', now())
                            ->orderBy('tanggal_mulai')
                            ->take(5)
                            ->get();
                    @endphp
                    
                    @if($upcomingAgenda->count() > 0)
                        @foreach($upcomingAgenda as $agenda)
                        <div class="agenda-item">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <div class="font-weight-bold small">{{ Str::limit($agenda->judul, 35) }}</div>
                                    <div class="text-muted" style="font-size: 0.75rem;">
                                        <i class="fas fa-calendar mr-1"></i>
                                        {{ \Carbon\Carbon::parse($agenda->tanggal_mulai)->format('d M Y') }}
                                    </div>
                                </div>
                                <span class="badge badge-info">{{ $agenda->kategori }}</span>
                            </div>
                        </div>
                        @endforeach
                    @else
                        <div class="text-center text-muted py-3">
                            <i class="fas fa-calendar-times fa-2x mb-2"></i>
                            <p class="mb-0">Tidak ada agenda</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Quick Stats -->
            <div class="card shadow">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold">
                        <i class="fas fa-chart-pie mr-2"></i>Statistik Cepat
                    </h6>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="text-sm"><i class="fas fa-project-diagram text-primary"></i> Project</span>
                            <span class="font-weight-bold">{{ DB::table('projects')->count() }}</span>
                        </div>
                        <div class="progress" style="height: 8px;">
                            <div class="progress-bar bg-gradient-primary" role="progressbar" style="width: 75%"></div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="text-sm"><i class="fas fa-microscope text-success"></i> Penelitian</span>
                            <span class="font-weight-bold">{{ DB::table('penelitian')->count() }}</span>
                        </div>
                        <div class="progress" style="height: 8px;">
                            <div class="progress-bar bg-gradient-success" role="progressbar" style="width: 60%"></div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="text-sm"><i class="fas fa-lightbulb text-warning"></i> PKM</span>
                            <span class="font-weight-bold">{{ DB::table('pkm')->count() }}</span>
                        </div>
                        <div class="progress" style="height: 8px;">
                            <div class="progress-bar bg-gradient-warning" role="progressbar" style="width: 50%"></div>
                        </div>
                    </div>

                    <div class="mb-0">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="text-sm"><i class="fas fa-images text-info"></i> Galeri</span>
                            <span class="font-weight-bold">{{ DB::table('galeri')->count() }}</span>
                        </div>
                        <div class="progress" style="height: 8px;">
                            <div class="progress-bar bg-gradient-info" role="progressbar" style="width: 85%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Info Cards -->
    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card border-left-primary shadow h-100">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Pengumuman Aktif</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ DB::table('pengumuman')->where('aktif', 1)->count() }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-bullhorn fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card border-left-success shadow h-100">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Agenda Bulan Ini</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ DB::table('agenda')->where('aktif', 1)->whereMonth('tanggal_mulai', now()->month)->count() }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar-check fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card border-left-info shadow h-100">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Tracer Study</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ DB::table('tracer_study')->count() }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-chart-line fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="row">
        <div class="col-12 mb-4">
            <div class="card shadow">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold">
                        <i class="fas fa-bolt mr-2"></i>Quick Actions
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-lg-2 col-md-4 col-6 mb-3">
                            <a href="{{ route('dosen.index') }}" class="text-decoration-none">
                                <div class="p-3 rounded hover-shadow">
                                    <i class="fas fa-chalkboard-teacher fa-2x text-primary mb-2"></i>
                                    <div class="small font-weight-bold">Dosen</div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-2 col-md-4 col-6 mb-3">
                            <a href="{{ route('mahasiswa.index') }}" class="text-decoration-none">
                                <div class="p-3 rounded hover-shadow">
                                    <i class="fas fa-user-graduate fa-2x text-success mb-2"></i>
                                    <div class="small font-weight-bold">Mahasiswa</div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-2 col-md-4 col-6 mb-3">
                            <a href="{{ route('berita.index') }}" class="text-decoration-none">
                                <div class="p-3 rounded hover-shadow">
                                    <i class="fas fa-newspaper fa-2x text-info mb-2"></i>
                                    <div class="small font-weight-bold">Berita</div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-2 col-md-4 col-6 mb-3">
                            <a href="{{ route('penelitian.index') }}" class="text-decoration-none">
                                <div class="p-3 rounded hover-shadow">
                                    <i class="fas fa-microscope fa-2x text-warning mb-2"></i>
                                    <div class="small font-weight-bold">Penelitian</div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-2 col-md-4 col-6 mb-3">
                            <a href="{{ route('pkm.index') }}" class="text-decoration-none">
                                <div class="p-3 rounded hover-shadow">
                                    <i class="fas fa-lightbulb fa-2x text-danger mb-2"></i>
                                    <div class="small font-weight-bold">PKM</div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-2 col-md-4 col-6 mb-3">
                            <a href="{{ route('galeri.index') }}" class="text-decoration-none">
                                <div class="p-3 rounded hover-shadow">
                                    <i class="fas fa-images fa-2x text-secondary mb-2"></i>
                                    <div class="small font-weight-bold">Galeri</div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
<script>
    // Data Overview Chart
    const ctx = document.getElementById('dataOverviewChart');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Dosen', 'Mahasiswa', 'Alumni', 'Project', 'Penelitian', 'PKM', 'Berita', 'Galeri'],
            datasets: [{
                label: 'Total Data',
                data: [
                    {{ App\Models\Dosen::count() }},
                    {{ App\Models\Mahasiswa::count() }},
                    {{ DB::table('alumni')->count() }},
                    {{ DB::table('projects')->count() }},
                    {{ DB::table('penelitian')->count() }},
                    {{ DB::table('pkm')->count() }},
                    {{ App\Models\Berita::count() }},
                    {{ DB::table('galeri')->count() }}
                ],
                backgroundColor: [
                    'rgba(102, 126, 234, 0.8)',
                    'rgba(17, 153, 142, 0.8)',
                    'rgba(240, 147, 251, 0.8)',
                    'rgba(79, 172, 254, 0.8)',
                    'rgba(253, 126, 20, 0.8)',
                    'rgba(245, 87, 108, 0.8)',
                    'rgba(56, 239, 125, 0.8)',
                    'rgba(0, 242, 254, 0.8)'
                ],
                borderColor: [
                    'rgba(102, 126, 234, 1)',
                    'rgba(17, 153, 142, 1)',
                    'rgba(240, 147, 251, 1)',
                    'rgba(79, 172, 254, 1)',
                    'rgba(253, 126, 20, 1)',
                    'rgba(245, 87, 108, 1)',
                    'rgba(56, 239, 125, 1)',
                    'rgba(0, 242, 254, 1)'
                ],
                borderWidth: 2,
                borderRadius: 8
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    backgroundColor: 'rgba(0, 0, 0, 0.8)',
                    padding: 12,
                    titleFont: {
                        size: 14,
                        weight: 'bold'
                    },
                    bodyFont: {
                        size: 13
                    },
                    cornerRadius: 8
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(0, 0, 0, 0.05)'
                    },
                    ticks: {
                        font: {
                            size: 12
                        }
                    }
                },
                x: {
                    grid: {
                        display: false
                    },
                    ticks: {
                        font: {
                            size: 11
                        }
                    }
                }
            }
        }
    });
</script>
@endpush
@endsection