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

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>Penulis:</strong> {{ $berita->penulis }}
                        </div>
                        <div class="col-md-6 text-md-right">
                            <strong>Tanggal:</strong> {{ $berita->tanggal ? $berita->tanggal->format('d F Y') : $berita->tanggal }}
                        </div>
                    </div>

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