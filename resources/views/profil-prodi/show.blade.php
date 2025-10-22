@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-sm">
                <div class="card-header bg-white py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Detail Profil Program Studi</h5>
                        <a href="{{ route('profil-prodi.index') }}" class="btn btn-outline-secondary btn-sm">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    @if($profilProdi->logo)
                        <div class="text-center mb-4">
                            <img src="{{ asset('storage/' . $profilProdi->logo) }}" alt="Logo {{ $profilProdi->nama_prodi }}"
                                 class="img-fluid rounded" style="max-height: 150px;">
                        </div>
                    @endif

                    <table class="table table-bordered">
                        <tr>
                            <th width="30%" class="bg-light">Nama Program Studi</th>
                            <td>{{ $profilProdi->nama_prodi }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light">Akreditasi</th>
                            <td>{{ $profilProdi->akreditasi ?: '-' }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light">Email Kontak</th>
                            <td>{{ $profilProdi->kontak_email ?: '-' }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light">Telepon Kontak</th>
                            <td>{{ $profilProdi->kontak_telepon ?: '-' }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light">Alamat</th>
                            <td>{{ $profilProdi->alamat ?: '-' }}</td>
                        </tr>
                    </table>

                    @if($profilProdi->visi)
                        <div class="mt-4">
                            <h6>Visi</h6>
                            <p class="text-muted">{{ $profilProdi->visi }}</p>
                        </div>
                    @endif

                    @if($profilProdi->misi)
                        <div class="mt-4">
                            <h6>Misi</h6>
                            <p class="text-muted">{{ $profilProdi->misi }}</p>
                        </div>
                    @endif

                    @if($profilProdi->deskripsi)
                        <div class="mt-4">
                            <h6>Deskripsi</h6>
                            <p class="text-muted">{{ $profilProdi->deskripsi }}</p>
                        </div>
                    @endif

                    <div class="mt-4 d-flex justify-content-end gap-2">
                        <a href="{{ route('profil-prodi.edit', $profilProdi->id) }}" class="btn btn-warning">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <form action="{{ route('profil-prodi.destroy', $profilProdi->id) }}" method="POST" class="d-inline">
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