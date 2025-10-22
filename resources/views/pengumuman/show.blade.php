@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail Pengumuman</h1>
        <div>
            <a href="{{ route('pengumuman.edit', $pengumuman->id) }}" class="btn btn-warning btn-sm">
                <i class="fas fa-edit"></i> Edit
            </a>
            <a href="{{ route('pengumuman.index') }}" class="btn btn-secondary btn-sm">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <h2>{{ $pengumuman->judul }}</h2>
                    <hr>
                </div>
            </div>

            @if($pengumuman->gambar)
            <div class="row mb-3">
                <div class="col-md-12">
                    <img src="{{ asset('storage/' . $pengumuman->gambar) }}" alt="{{ $pengumuman->judul }}" class="img-fluid" style="max-height: 400px;">
                </div>
            </div>
            @endif

            <div class="row">
                <div class="col-md-6 mb-3">
                    <strong>Prioritas:</strong>
                    @if($pengumuman->prioritas == 'tinggi')
                        <span class="badge badge-danger">Tinggi</span>
                    @elseif($pengumuman->prioritas == 'sedang')
                        <span class="badge badge-warning">Sedang</span>
                    @else
                        <span class="badge badge-info">Rendah</span>
                    @endif
                </div>
                <div class="col-md-6 mb-3">
                    <strong>Status:</strong>
                    @if($pengumuman->aktif)
                        <span class="badge badge-success">Aktif</span>
                    @else
                        <span class="badge badge-secondary">Tidak Aktif</span>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <strong>Penulis:</strong> {{ $pengumuman->penulis }}
                </div>
                <div class="col-md-6 mb-3">
                    <strong>Tanggal Mulai:</strong> {{ \Carbon\Carbon::parse($pengumuman->tanggal_mulai)->format('d/m/Y') }}
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 mb-3">
                    <strong>Tanggal Selesai:</strong> {{ $pengumuman->tanggal_selesai ? \Carbon\Carbon::parse($pengumuman->tanggal_selesai)->format('d/m/Y') : 'Tidak ditentukan' }}
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 mb-3">
                    <strong>Isi Pengumuman:</strong>
                    <div class="mt-2">
                        {!! nl2br(e($pengumuman->isi)) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
