@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-white py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Detail Mata Kuliah</h5>
                        <a href="{{ route('matakuliah.index') }}" class="btn btn-outline-secondary btn-sm">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th width="30%" class="bg-light">Kode MK</th>
                            <td>{{ $matakuliah->kode_mk }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light">Nama MK</th>
                            <td>{{ $matakuliah->nama_mk }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light">SKS</th>
                            <td>{{ $matakuliah->sks }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light">Semester</th>
                            <td>{{ $matakuliah->semester }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light">Program Studi</th>
                            <td>{{ $matakuliah->program_studi }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light">Kurikulum Tahun</th>
                            <td>{{ $matakuliah->kurikulum_tahun }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light">Deskripsi Singkat</th>
                            <td>{{ $matakuliah->deskripsi_singkat ?: '-' }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light">Status</th>
                            <td>
                                <span class="badge badge-{{ $matakuliah->status_wajib == 'Wajib' ? 'primary' : 'secondary' }}">
                                    {{ $matakuliah->status_wajib }}
                                </span>
                            </td>
                        </tr>
                    </table>

                    <div class="mt-4 d-flex justify-content-end gap-2">
                        <a href="{{ route('matakuliah.edit', $matakuliah->mk_id) }}" class="btn btn-warning">
                            <i class="fas fa-edit fa-sm"></i> Edit
                        </a>
                        <form action="{{ route('matakuliah.destroy', $matakuliah->mk_id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">
                                <i class="fas fa-trash fa-sm"></i> Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection