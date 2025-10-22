@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-sm">
                <div class="card-header bg-white py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Detail Berita</h5>
                        <a href="{{ route('berita.index') }}" class="btn btn-outline-secondary btn-sm">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    @if($berita->gambar)
                        <div class="text-center mb-4">
                            <img src="{{ asset('storage/' . $berita->gambar) }}" alt="{{ $berita->judul }}" 
                                 class="img-fluid rounded" style="max-height: 400px;">
                        </div>
                    @endif

                    <h2 class="mb-3">{{ $berita->judul }}</h2>

                    @if($berita->is_prestasi)
                        <div class="alert alert-success mb-3">
                            <i class="fas fa-trophy"></i> <strong>Prestasi Mahasiswa</strong>
                        </div>
                    @endif

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>Penulis:</strong> {{ $berita->penulis }}
                        </div>
                        <div class="col-md-6 text-md-right">
                            <strong>Tanggal:</strong> {{ $berita->tanggal ? $berita->tanggal->format('d F Y') : $berita->tanggal }}
                        </div>
                    </div>

                    @if($berita->is_prestasi)
                        <hr>
                        <div class="card bg-light mb-3">
                            <div class="card-body">
                                <h6 class="card-title mb-3"><i class="fas fa-award"></i> Data Prestasi</h6>
                                <div class="row">
                                    <div class="col-md-6 mb-2">
                                        <strong>Nama Mahasiswa:</strong><br>
                                        {{ $berita->nama_mahasiswa }}
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <strong>NIM:</strong><br>
                                        {{ $berita->nim }}
                                    </div>
                                    @if($berita->program_studi)
                                        <div class="col-md-6 mb-2">
                                            <strong>Program Studi:</strong><br>
                                            {{ $berita->program_studi }}
                                        </div>
                                    @endif
                                    @if($berita->tingkat_prestasi)
                                        <div class="col-md-6 mb-2">
                                            <strong>Tingkat Prestasi:</strong><br>
                                            <span class="badge badge-{{ $berita->tingkat_prestasi == 'Internasional' ? 'danger' : ($berita->tingkat_prestasi == 'Nasional' ? 'warning' : 'info') }}">
                                                {{ $berita->tingkat_prestasi }}
                                            </span>
                                        </div>
                                    @endif
                                    @if($berita->jenis_prestasi)
                                        <div class="col-md-6 mb-2">
                                            <strong>Jenis Prestasi:</strong><br>
                                            {{ $berita->jenis_prestasi }}
                                        </div>
                                    @endif
                                    @if($berita->penyelenggara)
                                        <div class="col-md-6 mb-2">
                                            <strong>Penyelenggara:</strong><br>
                                            {{ $berita->penyelenggara }}
                                        </div>
                                    @endif
                                    @if($berita->tanggal_prestasi)
                                        <div class="col-md-6 mb-2">
                                            <strong>Tanggal Prestasi:</strong><br>
                                            {{ $berita->tanggal_prestasi->format('d F Y') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif

                    <hr>

                    <div class="berita-content">
                        {!! nl2br(e($berita->isi)) !!}
                    </div>

                    <hr>

                    <div class="mt-4 d-flex justify-content-end gap-2">
                        <a href="{{ route('berita.edit', $berita->id) }}" class="btn btn-warning">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <form action="{{ route('berita.destroy', $berita->id) }}" method="POST" class="d-inline">
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

@push('styles')
<style>
    .berita-content {
        line-height: 1.6;
        text-align: justify;
    }
</style>
@endpush