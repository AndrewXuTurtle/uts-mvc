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
                    @if($project->cover_image)
                        <div class="text-center mb-4">
                            <img src="{{ Storage::url($project->cover_image) }}" alt="{{ $project->judul_project }}"
                                 class="img-fluid rounded" style="max-height: 300px;">
                        </div>
                    @endif

                    <table class="table table-bordered">
                        <tr>
                            <th width="30%" class="bg-light">Judul Project</th>
                            <td>{{ $project->judul_project }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light">Deskripsi</th>
                            <td>{{ $project->deskripsi ?: '-' }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light">Mahasiswa</th>
                            <td>{{ $project->mahasiswa ? $project->mahasiswa->nama : '-' }} ({{ $project->nim }})</td>
                        </tr>
                        <tr>
                            <th class="bg-light">Kategori</th>
                            <td>{{ $project->kategori ?: '-' }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light">Teknologi</th>
                            <td>{{ $project->teknologi ?: '-' }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light">Dosen Pembimbing</th>
                            <td>{{ $project->dosen_pembimbing ?: '-' }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light">Tahun</th>
                            <td>{{ $project->tahun }} {{ $project->tahun_selesai ? '- ' . $project->tahun_selesai : '' }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light">Link GitHub</th>
                            <td>
                                @if($project->link_github)
                                    <a href="{{ $project->link_github }}" target="_blank">{{ $project->link_github }}</a>
                                @else
                                    -
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th class="bg-light">Link Demo</th>
                            <td>
                                @if($project->link_demo)
                                    <a href="{{ $project->link_demo }}" target="_blank">{{ $project->link_demo }}</a>
                                @else
                                    -
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th class="bg-light">Status</th>
                            <td>
                                <span class="badge badge-{{ $project->status == 'Published' ? 'success' : 'secondary' }}">
                                    {{ $project->status }}
                                </span>
                            </td>
                        </tr>
                    </table>

                    @if($project->galeri && count($project->galeri) > 0)
                        <div class="mt-4">
                            <h6>Galeri Foto:</h6>
                            <div class="row">
                                @foreach($project->galeri as $galeri)
                                    <div class="col-md-3 mb-3">
                                        <img src="{{ Storage::url($galeri) }}" alt="Galeri"
                                             class="img-fluid rounded">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <div class="mt-4 d-flex justify-content-end gap-2">
                        <a href="{{ route('project.edit', $project) }}" class="btn btn-warning">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <form action="{{ route('project.destroy', $project) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus project ini?')">
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