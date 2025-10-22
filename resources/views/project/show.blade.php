@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-sm">
                <div class="card-header bg-white py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Detail Project</h5>
                        <a href="{{ route('project.index') }}" class="btn btn-outline-secondary btn-sm">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    @if($project->path_foto_utama)
                        <div class="text-center mb-4">
                            <img src="{{ asset('storage/' . $project->path_foto_utama) }}" alt="{{ $project->judul_proyek }}"
                                 class="img-fluid rounded" style="max-height: 300px;">
                        </div>
                    @endif

                    <table class="table table-bordered">
                        <tr>
                            <th width="30%" class="bg-light">Judul Proyek</th>
                            <td>{{ $project->judul_proyek }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light">Deskripsi Singkat</th>
                            <td>{{ $project->deskripsi_singkat ?: '-' }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light">Nama Mahasiswa</th>
                            <td>{{ $project->nama_mahasiswa }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light">NIM Mahasiswa</th>
                            <td>{{ $project->nim_mahasiswa }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light">Program Studi</th>
                            <td>{{ $project->program_studi }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light">Dosen Pembimbing</th>
                            <td>{{ $project->dosen_pembimbing ?: '-' }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light">Tahun Selesai</th>
                            <td>{{ $project->tahun_selesai }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light">Keywords</th>
                            <td>{{ $project->keywords ?: '-' }}</td>
                        </tr>
                    </table>

                    @if($project->path_foto_galeri)
                        <div class="mt-4">
                            <h6>Galeri Foto:</h6>
                            <div class="row">
                                @foreach(explode(',', $project->path_foto_galeri) as $galeri)
                                    <div class="col-md-3 mb-3">
                                        <img src="{{ asset('storage/' . trim($galeri)) }}" alt="Galeri"
                                             class="img-fluid rounded">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <div class="mt-4 d-flex justify-content-end gap-2">
                        <a href="{{ route('project.edit', $project->project_id) }}" class="btn btn-warning">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <form action="{{ route('project.destroy', $project->project_id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection