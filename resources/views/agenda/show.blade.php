@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail Agenda</h1>
        <div>
            <a href="{{ route('agenda.edit', $agenda->id) }}" class="btn btn-warning btn-sm">
                <i class="fas fa-edit"></i> Edit
            </a>
            <a href="{{ route('agenda.index') }}" class="btn btn-secondary btn-sm">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <h2>{{ $agenda->judul }}</h2>
                    <hr>
                </div>
            </div>

            @if($agenda->gambar)
            <div class="row mb-3">
                <div class="col-md-12">
                    <img src="{{ asset('storage/' . $agenda->gambar) }}" alt="{{ $agenda->judul }}" class="img-fluid" style="max-height: 400px;">
                </div>
            </div>
            @endif

            <div class="row">
                <div class="col-md-6 mb-3">
                    <strong>Kategori:</strong>
                    <span class="badge badge-primary">{{ ucfirst($agenda->kategori) }}</span>
                </div>
                <div class="col-md-6 mb-3">
                    <strong>Status:</strong>
                    @if($agenda->aktif)
                        <span class="badge badge-success">Aktif</span>
                    @else
                        <span class="badge badge-secondary">Tidak Aktif</span>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <strong>Tanggal & Waktu Mulai:</strong> {{ \Carbon\Carbon::parse($agenda->tanggal_mulai)->format('d/m/Y H:i') }} WIB
                </div>
                <div class="col-md-6 mb-3">
                    <strong>Tanggal & Waktu Selesai:</strong> {{ $agenda->tanggal_selesai ? \Carbon\Carbon::parse($agenda->tanggal_selesai)->format('d/m/Y H:i') . ' WIB' : 'Tidak ditentukan' }}
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <strong>Lokasi:</strong> {{ $agenda->lokasi ?? '-' }}
                </div>
                <div class="col-md-6 mb-3">
                    <strong>Penyelenggara:</strong> {{ $agenda->penyelenggara ?? '-' }}
                </div>
            </div>

            @if($agenda->deskripsi)
            <div class="row">
                <div class="col-md-12 mb-3">
                    <strong>Deskripsi:</strong>
                    <div class="mt-2">
                        {!! nl2br(e($agenda->deskripsi)) !!}
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
