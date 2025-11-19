@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tambah Data Penelitian</h1>
        <a href="{{ route('penelitian.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali
        </a>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Form Tambah Penelitian</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('penelitian.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="judul_penelitian">Judul Penelitian *</label>
                            <input type="text" class="form-control @error('judul_penelitian') is-invalid @enderror"
                                   id="judul_penelitian" name="judul_penelitian" value="{{ old('judul_penelitian') }}" required>
                            @error('judul_penelitian')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="deskripsi">Deskripsi Penelitian</label>
                            <textarea class="form-control @error('deskripsi') is-invalid @enderror"
                                      id="deskripsi" name="deskripsi" rows="3">{{ old('deskripsi') }}</textarea>
                            @error('deskripsi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="ketua_peneliti_id">Ketua Peneliti (Dosen) *</label>
                            <select class="form-control @error('ketua_peneliti_id') is-invalid @enderror"
                                    id="ketua_peneliti_id" name="ketua_peneliti_id" required>
                                <option value="">Pilih Dosen</option>
                                @foreach($dosen as $d)
                                    <option value="{{ $d->id }}" {{ old('ketua_peneliti_id') == $d->id ? 'selected' : '' }}>
                                        {{ $d->nama }} ({{ $d->nidn }})
                                    </option>
                                @endforeach
                            </select>
                            @error('ketua_peneliti_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tahun">Tahun *</label>
                                    <input type="number" class="form-control @error('tahun') is-invalid @enderror"
                                           id="tahun" name="tahun" value="{{ old('tahun', date('Y')) }}"
                                           min="2000" max="{{ date('Y') + 1 }}" required>
                                    @error('tahun')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="status">Status *</label>
                                    <select class="form-control @error('status') is-invalid @enderror"
                                            id="status" name="status" required>
                                        <option value="Draft" {{ old('status') == 'Draft' ? 'selected' : '' }}>Draft</option>
                                        <option value="Sedang Berjalan" {{ old('status', 'Sedang Berjalan') == 'Sedang Berjalan' ? 'selected' : '' }}>Sedang Berjalan</option>
                                        <option value="Selesai" {{ old('status') == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="jenis_penelitian">Jenis Penelitian</label>
                            <input type="text" class="form-control @error('jenis_penelitian') is-invalid @enderror"
                                   id="jenis_penelitian" name="jenis_penelitian" value="{{ old('jenis_penelitian') }}" 
                                   placeholder="Mandiri, Hibah, Kolaborasi, dll">
                            @error('jenis_penelitian')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="sumber_dana">Sumber Dana</label>
                                    <input type="text" class="form-control @error('sumber_dana') is-invalid @enderror"
                                           id="sumber_dana" name="sumber_dana" value="{{ old('sumber_dana') }}">
                                    @error('sumber_dana')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="dana">Jumlah Dana (Rp)</label>
                                    <input type="number" class="form-control @error('dana') is-invalid @enderror"
                                           id="dana" name="dana" value="{{ old('dana') }}" min="0" step="0.01">
                                    @error('dana')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tanggal_mulai">Tanggal Mulai</label>
                                    <input type="date" class="form-control @error('tanggal_mulai') is-invalid @enderror"
                                           id="tanggal_mulai" name="tanggal_mulai" value="{{ old('tanggal_mulai') }}">
                                    @error('tanggal_mulai')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tanggal_selesai">Tanggal Selesai</label>
                                    <input type="date" class="form-control @error('tanggal_selesai') is-invalid @enderror"
                                           id="tanggal_selesai" name="tanggal_selesai" value="{{ old('tanggal_selesai') }}">
                                    @error('tanggal_selesai')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="output">Output Penelitian</label>
                            <textarea class="form-control @error('output') is-invalid @enderror"
                                      id="output" name="output" rows="2" 
                                      placeholder="Jurnal, Prosiding, Paten, HKI, dll">{{ old('output') }}</textarea>
                            @error('output')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="file_dokumen">File Dokumen Penelitian</label>
                            <input type="file" class="form-control-file @error('file_dokumen') is-invalid @enderror"
                                   id="file_dokumen" name="file_dokumen" accept=".pdf,.doc,.docx">
                            <small class="form-text text-muted">Upload proposal atau laporan penelitian. Format: PDF, DOC, DOCX. Maksimal 5MB</small>
                            @error('file_dokumen')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Simpan
                            </button>
                            <a href="{{ route('penelitian.index') }}" class="btn btn-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <!-- Info -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Informasi</h6>
                </div>
                <div class="card-body">
                    <h6>Status Penelitian:</h6>
                    <ul class="small mb-3">
                        <li><strong>Draft:</strong> Proposal masih dalam tahap penyusunan</li>
                        <li><strong>Sedang Berjalan:</strong> Penelitian sedang dilaksanakan</li>
                        <li><strong>Selesai:</strong> Penelitian telah selesai</li>
                    </ul>

                    <h6>Jenis Penelitian:</h6>
                    <p class="small">Contoh: Mandiri, Hibah Internal, Hibah Dikti, Kolaborasi, dll.</p>

                    <h6>Output Penelitian:</h6>
                    <p class="small">Contoh: Jurnal Nasional, Jurnal Internasional, Prosiding, Paten, HKI, dll.</p>

                    <h6>File Upload:</h6>
                    <ul class="small">
                        <li>Upload proposal atau laporan penelitian</li>
                        <li>Format: PDF, DOC, DOCX</li>
                        <li>Maksimal: 5MB</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection