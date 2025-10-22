@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-white py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Detail Dosen</h5>
                        <a href="{{ route('dosen.index') }}" class="btn btn-outline-secondary btn-sm">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="text-center mb-4">
                        @if($dosen->foto)
                            <img src="{{ asset('storage/' . $dosen->foto) }}" alt="{{ $dosen->nama }}" 
                                 class="rounded-circle img-thumbnail" style="width: 150px; height: 150px; object-fit: cover;">
                        @else
                            <div class="rounded-circle bg-secondary text-white d-flex align-items-center justify-content-center mx-auto"
                                 style="width: 150px; height: 150px;">
                                <i class="fas fa-user fa-4x"></i>
                            </div>
                        @endif
                    </div>

                    <table class="table table-bordered">
                        <tr>
                            <th width="30%" class="bg-light">NIDN</th>
                            <td>{{ $dosen->nidn }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light">Nama Lengkap</th>
                            <td>{{ $dosen->nama }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light">Email</th>
                            <td>{{ $dosen->email }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light">Program Studi</th>
                            <td>{{ $dosen->program_studi }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light">Jabatan</th>
                            <td>{{ $dosen->jabatan }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light">Bidang Keahlian</th>
                            <td>{{ $dosen->bidang_keahlian ?: '-' }}</td>
                        </tr>
                    </table>

                    <div class="mt-4 d-flex justify-content-end gap-2">
                        <a href="{{ route('dosen.edit', $dosen->id) }}" class="btn btn-warning">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <form action="{{ route('dosen.destroy', $dosen->id) }}" method="POST" class="d-inline">
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