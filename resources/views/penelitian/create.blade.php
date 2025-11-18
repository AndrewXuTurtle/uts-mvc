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
                            <label for="judul">Judul Penelitian *</label>
                            <input type="text" class="form-control @error('judul') is-invalid @enderror"
                                   id="judul" name="judul" value="{{ old('judul') }}" required>
                            @error('judul')
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
                            <label for="dosen_id">Ketua Peneliti (Dosen) *</label>
                            <select class="form-control @error('dosen_id') is-invalid @enderror"
                                    id="dosen_id" name="dosen_id" required>
                                <option value="">Pilih Dosen</option>
                                @foreach($dosen as $d)
                                                                            <option value="{{ $d->id }}" {{ old('dosen_id') == $d->id ? 'selected' : '' }}>
                                            {{ $d->nama }} ({{ $d->nidn }})
                                        </option>
                                @endforeach
                            </select>
                            @error('dosen_id')
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
                                        <option value="ongoing" {{ old('status') == 'ongoing' ? 'selected' : '' }}>Sedang Berlangsung</option>
                                        <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Selesai</option>
                                        <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Dipublikasikan</option>
                                        <option value="cancelled" {{ old('status') == 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="bidang_penelitian">Bidang Penelitian *</label>
                            <input type="text" class="form-control @error('bidang_penelitian') is-invalid @enderror"
                                   id="bidang_penelitian" name="bidang_penelitian" value="{{ old('bidang_penelitian') }}" required>
                            @error('bidang_penelitian')
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
                                    <label for="jumlah_dana">Jumlah Dana (Rp)</label>
                                    <input type="number" class="form-control @error('jumlah_dana') is-invalid @enderror"
                                           id="jumlah_dana" name="jumlah_dana" value="{{ old('jumlah_dana') }}" min="0">
                                    @error('jumlah_dana')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tanggal_mulai">Tanggal Mulai *</label>
                                    <input type="date" class="form-control @error('tanggal_mulai') is-invalid @enderror"
                                           id="tanggal_mulai" name="tanggal_mulai" value="{{ old('tanggal_mulai') }}" required>
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

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="file_proposal">File Proposal</label>
                                    <input type="file" class="form-control @error('file_proposal') is-invalid @enderror"
                                           id="file_proposal" name="file_proposal" accept=".pdf,.doc,.docx">
                                    <small class="form-text text-muted">Format: PDF, DOC, DOCX. Maksimal 5MB</small>
                                    @error('file_proposal')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="file_laporan">File Laporan</label>
                                    <input type="file" class="form-control @error('file_laporan') is-invalid @enderror"
                                           id="file_laporan" name="file_laporan" accept=".pdf,.doc,.docx">
                                    <small class="form-text text-muted">Format: PDF, DOC, DOCX. Maksimal 5MB</small>
                                    @error('file_laporan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
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
                        <li><strong>Ongoing:</strong> Penelitian sedang berlangsung</li>
                        <li><strong>Completed:</strong> Penelitian selesai</li>
                        <li><strong>Published:</strong> Hasil penelitian dipublikasikan</li>
                        <li><strong>Cancelled:</strong> Penelitian dibatalkan</li>
                    </ul>

                    <h6>Bidang Penelitian:</h6>
                    <p class="small">Contoh: Artificial Intelligence, Data Science, Software Engineering, dll.</p>

                    <h6>File Upload:</h6>
                    <ul class="small">
                        <li>Proposal: Dokumen proposal penelitian</li>
                        <li>Laporan: Dokumen laporan akhir penelitian</li>
                        <li>Format: PDF, DOC, DOCX</li>
                        <li>Maksimal: 5MB per file</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection