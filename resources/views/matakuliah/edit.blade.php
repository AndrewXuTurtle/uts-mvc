@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-white py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Edit Mata Kuliah</h5>
                        <a href="{{ route('matakuliah.index') }}" class="btn btn-outline-secondary btn-sm">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('matakuliah.update', $matakuliah->mk_id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group mb-3">
                            <label for="kode_mk">Kode Mata Kuliah</label>
                            <input type="text" class="form-control @error('kode_mk') is-invalid @enderror"
                                   id="kode_mk" name="kode_mk" value="{{ old('kode_mk', $matakuliah->kode_mk) }}" required>
                            @error('kode_mk')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="nama_mk">Nama Mata Kuliah</label>
                            <input type="text" class="form-control @error('nama_mk') is-invalid @enderror"
                                   id="nama_mk" name="nama_mk" value="{{ old('nama_mk', $matakuliah->nama_mk) }}" required>
                            @error('nama_mk')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="sks">SKS</label>
                            <input type="number" class="form-control @error('sks') is-invalid @enderror"
                                   id="sks" name="sks" value="{{ old('sks', $matakuliah->sks) }}" required min="1" max="6">
                            @error('sks')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="semester">Semester</label>
                            <select class="form-control @error('semester') is-invalid @enderror"
                                    id="semester" name="semester" required>
                                <option value="">Pilih Semester</option>
                                @for($i = 1; $i <= 8; $i++)
                                    <option value="{{ $i }}" {{ old('semester', $matakuliah->semester) == $i ? 'selected' : '' }}>{{ $i }}</option>
                                @endfor
                            </select>
                            @error('semester')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="program_studi">Program Studi</label>
                            <input type="hidden" name="program_studi" value="Teknik Perangkat Lunak">
                            <div class="form-control bg-light">Teknik Perangkat Lunak</div>
                        </div>

                        <div class="form-group mb-3">
                            <label for="kurikulum_tahun">Tahun Kurikulum</label>
                            <input type="number" class="form-control @error('kurikulum_tahun') is-invalid @enderror"
                                   id="kurikulum_tahun" name="kurikulum_tahun" value="{{ old('kurikulum_tahun', $matakuliah->kurikulum_tahun) }}" required min="2000" max="{{ date('Y') + 1 }}">
                            @error('kurikulum_tahun')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="deskripsi_singkat">Deskripsi Singkat</label>
                            <textarea class="form-control @error('deskripsi_singkat') is-invalid @enderror"
                                      id="deskripsi_singkat" name="deskripsi_singkat" rows="3">{{ old('deskripsi_singkat', $matakuliah->deskripsi_singkat) }}</textarea>
                            @error('deskripsi_singkat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-4">
                            <label for="status_wajib">Status</label>
                            <select class="form-control @error('status_wajib') is-invalid @enderror"
                                    id="status_wajib" name="status_wajib" required>
                                <option value="Wajib" {{ old('status_wajib', $matakuliah->status_wajib) == 'Wajib' ? 'selected' : '' }}>Wajib</option>
                                <option value="Pilihan" {{ old('status_wajib', $matakuliah->status_wajib) == 'Pilihan' ? 'selected' : '' }}>Pilihan</option>
                            </select>
                            @error('status_wajib')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Update Data
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection