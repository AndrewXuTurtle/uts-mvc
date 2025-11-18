@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tracer Study Alumni</h1>
        <a href="{{ route('tracer-study.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Data
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

    <!-- Filter -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Filter Data</h6>
        </div>
        <div class="card-body">
            <form method="GET" class="form-inline">
                <div class="form-group mr-3">
                    <label for="tahun_survey" class="mr-2">Tahun Survey:</label>
                    <select name="tahun_survey" id="tahun_survey" class="form-control">
                        <option value="">Semua Tahun</option>
                        @for($year = date('Y'); $year >= 2020; $year--)
                        <option value="{{ $year }}" {{ request('tahun_survey') == $year ? 'selected' : '' }}>{{ $year }}</option>
                        @endfor
                    </select>
                </div>
                <div class="form-group mr-3">
                    <label for="status_pekerjaan" class="mr-2">Status Pekerjaan:</label>
                    <select name="status_pekerjaan" id="status_pekerjaan" class="form-control">
                        <option value="">Semua Status</option>
                        <option value="bekerja_full_time" {{ request('status_pekerjaan') == 'bekerja_full_time' ? 'selected' : '' }}>Bekerja Full Time</option>
                        <option value="bekerja_part_time" {{ request('status_pekerjaan') == 'bekerja_part_time' ? 'selected' : '' }}>Bekerja Part Time</option>
                        <option value="wiraswasta" {{ request('status_pekerjaan') == 'wiraswasta' ? 'selected' : '' }}>Wiraswasta</option>
                        <option value="melanjutkan_studi" {{ request('status_pekerjaan') == 'melanjutkan_studi' ? 'selected' : '' }}>Melanjutkan Studi</option>
                        <option value="tidak_bekerja" {{ request('status_pekerjaan') == 'tidak_bekerja' ? 'selected' : '' }}>Tidak Bekerja</option>
                        <option value="freelance" {{ request('status_pekerjaan') == 'freelance' ? 'selected' : '' }}>Freelance</option>
                    </select>
                </div>
                <div class="form-group mr-3">
                    <label for="status_survey" class="mr-2">Status Survey:</label>
                    <select name="status_survey" id="status_survey" class="form-control">
                        <option value="">Semua Status</option>
                        <option value="draft" {{ request('status_survey') == 'draft' ? 'selected' : '' }}>Draft</option>
                        <option value="completed" {{ request('status_survey') == 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="verified" {{ request('status_survey') == 'verified' ? 'selected' : '' }}>Verified</option>
                    </select>
                </div>
                <div class="form-group mr-3">
                    <input type="text" name="search" class="form-control" placeholder="Cari perusahaan/alumni..." value="{{ request('search') }}">
                </div>
                <button type="submit" class="btn btn-primary">Filter</button>
                <a href="{{ route('tracer-study.index') }}" class="btn btn-secondary ml-2">Reset</a>
            </form>
        </div>
    </div>

    <!-- Data Table -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Tracer Study</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Alumni</th>
                            <th>Tahun Survey</th>
                            <th>Status Pekerjaan</th>
                            <th>Perusahaan</th>
                            <th>Posisi</th>
                            <th>Gaji</th>
                            <th>Status Survey</th>
                            <th>Tanggal Survey</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($tracerStudy as $item)
                        <tr>
                            <td>{{ $loop->iteration + ($tracerStudy->currentPage() - 1) * $tracerStudy->perPage() }}</td>
                            <td>
                                <strong>{{ $item->alumni->nama ?? '-' }}</strong><br>
                                <small class="text-muted">{{ $item->alumni->nim ?? '-' }}</small>
                            </td>
                            <td>{{ $item->tahun_survey }}</td>
                            <td>
                                <span class="badge badge-info">
                                    {{ ucwords(str_replace('_', ' ', $item->status_pekerjaan)) }}
                                </span>
                            </td>
                            <td>{{ $item->nama_perusahaan ?? '-' }}</td>
                            <td>{{ $item->posisi_pekerjaan ?? '-' }}</td>
                            <td>
                                @if($item->gaji_sekarang)
                                Rp {{ number_format($item->gaji_sekarang, 0, ',', '.') }}
                                @else
                                -
                                @endif
                            </td>
                            <td>
                                @if($item->status_survey == 'verified')
                                <span class="badge badge-success">Verified</span>
                                @elseif($item->status_survey == 'completed')
                                <span class="badge badge-info">Completed</span>
                                @else
                                <span class="badge badge-warning">Draft</span>
                                @endif
                            </td>
                            <td>{{ date('d M Y', strtotime($item->tanggal_survey)) }}</td>
                            <td class="text-nowrap">
                                <a href="{{ route('tracer-study.show', $item->id) }}" class="btn btn-info btn-sm" title="Detail">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('tracer-study.edit', $item->id) }}" class="btn btn-warning btn-sm" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('tracer-study.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="10" class="text-center">Tidak ada data</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-3">
                {{ $tracerStudy->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
