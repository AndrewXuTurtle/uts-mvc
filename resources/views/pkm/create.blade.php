@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tambah Data PKM</h1>
        <a href="{{ route('pkm.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali
        </a>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Form Tambah PKM</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('pkm.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="judul">Judul PKM *</label>
                            <input type="text" class="form-control @error('judul') is-invalid @enderror"
                                   id="judul" name="judul" value="{{ old('judul') }}" required>
                            @error('judul')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="deskripsi">Deskripsi PKM</label>
                            <textarea class="form-control @error('deskripsi') is-invalid @enderror"
                                      id="deskripsi" name="deskripsi" rows="3">{{ old('deskripsi') }}</textarea>
                            @error('deskripsi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="mahasiswa_id">Mahasiswa * (Bisa pilih lebih dari satu)</label>
                                    <select class="form-control @error('mahasiswa_id') is-invalid @enderror"
                                            id="mahasiswa_id" name="mahasiswa_id[]" multiple required>
                                        @foreach($mahasiswa as $mhs)
                                            <option value="{{ $mhs->id }}" {{ in_array($mhs->id, old('mahasiswa_id', [])) ? 'selected' : '' }}>
                                                {{ $mhs->nama }} ({{ $mhs->nim }})
                                            </option>
                                        @endforeach
                                    </select>
                                    <small class="form-text text-muted">Tekan Ctrl (Windows) atau Cmd (Mac) untuk memilih lebih dari satu mahasiswa</small>
                                    @error('mahasiswa_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    @error('mahasiswa_id.*')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="dosen_id">Dosen Pembimbing * (Bisa pilih lebih dari satu)</label>
                                    <select class="form-control @error('dosen_id') is-invalid @enderror"
                                            id="dosen_id" name="dosen_id[]" multiple required>
                                        @foreach($dosen as $d)
                                            <option value="{{ $d->id }}" {{ in_array($d->id, old('dosen_id', [])) ? 'selected' : '' }}>
                                                {{ $d->nama }} ({{ $d->nidn }})
                                            </option>
                                        @endforeach
                                    </select>
                                    <small class="form-text text-muted">Tekan Ctrl (Windows) atau Cmd (Mac) untuk memilih lebih dari satu dosen</small>
                                    @error('dosen_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    @error('dosen_id.*')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
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
                                        <option value="ongoing" {{ old('status', 'ongoing') == 'ongoing' ? 'selected' : '' }}>Sedang Berlangsung</option>
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

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="mitra">Mitra (Partner)</label>
                                    <input type="text" class="form-control @error('mitra') is-invalid @enderror"
                                           id="mitra" name="mitra" value="{{ old('mitra') }}">
                                    @error('mitra')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="lokasi">Lokasi</label>
                                    <input type="text" class="form-control @error('lokasi') is-invalid @enderror"
                                           id="lokasi" name="lokasi" value="{{ old('lokasi') }}">
                                    @error('lokasi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="biaya">Biaya (Rp)</label>
                                    <input type="number" class="form-control @error('biaya') is-invalid @enderror"
                                           id="biaya" name="biaya" value="{{ old('biaya') }}" min="0">
                                    @error('biaya')
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
                            <label for="dokumentasi">Dokumentasi (Multiple Images)</label>
                            <input type="file" class="form-control @error('dokumentasi.*') is-invalid @enderror"
                                   id="dokumentasi" name="dokumentasi[]" multiple accept="image/*">
                            <small class="form-text text-muted">Format: JPG, PNG, GIF. Maksimal 2MB per gambar. Bisa pilih multiple gambar.</small>
                            @error('dokumentasi.*')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Simpan
                            </button>
                            <a href="{{ route('pkm.index') }}" class="btn btn-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <!-- Info Panel -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Informasi</h6>
                </div>
                <div class="card-body">
                    <h5>Tambah Data PKM</h5>
                    <p class="mb-0">Form ini digunakan untuk menambahkan data Program Kreativitas Mahasiswa baru ke dalam sistem.</p>
                </div>
            </div>

            <!-- Guidelines -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Panduan</h6>
                </div>
                <div class="card-body">
                    <ul class="small mb-0">
                        <li>Judul PKM harus unik dan deskriptif</li>
                        <li>Pilih mahasiswa dan dosen pembimbing dengan benar</li>
                        <li>Biaya dalam Rupiah, kosongkan jika belum ada</li>
                        <li>Dokumentasi bisa upload multiple gambar sekaligus</li>
                        <li>Format gambar: JPG, PNG, GIF (maks 2MB)</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection