@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Profil Program Studi</h1>
        <a href="{{ route('profil-prodi.create') }}" class="btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Profil Prodi
        </a>
    </div>

    <!-- Data Table -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Profil Program Studi</h6>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-bordered table-striped" width="100%" cellspacing="0">
                    <thead class="thead-light">
                        <tr>
                            <th>Nama Prodi</th>
                            <th>Akreditasi</th>
                            <th>Kontak Email</th>
                            <th>Logo</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($profilProdi as $profil)
                        <tr>
                            <td>{{ $profil->nama_prodi }}</td>
                            <td>{{ $profil->akreditasi ?: '-' }}</td>
                            <td>{{ $profil->kontak_email ?: '-' }}</td>
                            <td class="text-center">
                                @if($profil->logo)
                                    <img src="{{ asset('storage/' . $profil->logo) }}"
                                         alt="Logo {{ $profil->nama_prodi }}"
                                         class="img-profile rounded"
                                         style="width: 50px; height: 50px; object-fit: cover;">
                                @else
                                    <i class="fas fa-image text-gray-300" style="font-size: 24px;"></i>
                                @endif
                            </td>
                            <td class="text-center">
                                <a href="{{ route('profil-prodi.show', $profil->id) }}" class="btn btn-info btn-circle btn-sm">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('profil-prodi.edit', $profil->id) }}" class="btn btn-warning btn-circle btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button type="button" class="btn btn-danger btn-circle btn-sm"
                                        onclick='confirmDelete("{{ route('profil-prodi.destroy', $profil->id) }}", "profil prodi {{ $profil->nama_prodi }}")'>
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center">Tidak ada data profil prodi</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection