@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Data PKM</h1>
        <a href="{{ route('pkm.show', $pkm) }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali
        </a>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Form Edit PKM</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('pkm.update', $pkm) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="judul">Judul PKM *</label>
                            <input type="text" class="form-control @error('judul') is-invalid @enderror"
                                   id="judul" name="judul" value="{{ old('judul', $pkm->judul) }}" required>
                            @error('judul')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="deskripsi">Deskripsi PKM</label>
                            <textarea class="form-control @error('deskripsi') is-invalid @enderror"
                                      id="deskripsi" name="deskripsi" rows="3">{{ old('deskripsi', $pkm->deskripsi) }}</textarea>
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
                                            <option value="{{ $mhs->id }}" {{ in_array($mhs->id, old('mahasiswa_id', $pkm->mahasiswa->pluck('id')->toArray())) ? 'selected' : '' }}>
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
                                            <option value="{{ $d->id }}" {{ in_array($d->id, old('dosen_id', $pkm->dosen->pluck('id')->toArray())) ? 'selected' : '' }}>
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
                                           id="tahun" name="tahun" value="{{ old('tahun', $pkm->tahun) }}"
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
                                        <option value="ongoing" {{ old('status', $pkm->status) == 'ongoing' ? 'selected' : '' }}>Sedang Berlangsung</option>
                                        <option value="completed" {{ old('status', $pkm->status) == 'completed' ? 'selected' : '' }}>Selesai</option>
                                        <option value="published" {{ old('status', $pkm->status) == 'published' ? 'selected' : '' }}>Dipublikasikan</option>
                                        <option value="cancelled" {{ old('status', $pkm->status) == 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
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
                                           id="mitra" name="mitra" value="{{ old('mitra', $pkm->mitra) }}">
                                    @error('mitra')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="lokasi">Lokasi</label>
                                    <input type="text" class="form-control @error('lokasi') is-invalid @enderror"
                                           id="lokasi" name="lokasi" value="{{ old('lokasi', $pkm->lokasi) }}">
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
                                           id="biaya" name="biaya" value="{{ old('biaya', $pkm->biaya) }}" min="0">
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
                                           id="tanggal_mulai" name="tanggal_mulai" value="{{ old('tanggal_mulai', $pkm->tanggal_mulai ? $pkm->tanggal_mulai->format('Y-m-d') : '') }}">
                                    @error('tanggal_mulai')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tanggal_selesai">Tanggal Selesai</label>
                                    <input type="date" class="form-control @error('tanggal_selesai') is-invalid @enderror"
                                           id="tanggal_selesai" name="tanggal_selesai" value="{{ old('tanggal_selesai', $pkm->tanggal_selesai ? $pkm->tanggal_selesai->format('Y-m-d') : '') }}">
                                    @error('tanggal_selesai')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="dokumentasi">Dokumentasi - Kosongkan jika tidak ingin mengubah</label>
                            <input type="file" class="form-control @error('dokumentasi.*') is-invalid @enderror"
                                   id="dokumentasi" name="dokumentasi[]" multiple accept="image/*">
                            <small class="form-text text-muted">Format: JPG, PNG, GIF. Maksimal 2MB per gambar. Kosongkan jika tidak ingin mengubah dokumentasi.</small>
                            @error('dokumentasi.*')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                            @if($pkm->dokumentasi && count($pkm->dokumentasi) > 0)
                            <div class="mt-3">
                                <small class="text-muted">Dokumentasi saat ini ({{ count($pkm->dokumentasi) }} gambar):</small>
                                <div class="row mt-2">
                                    @foreach($pkm->dokumentasi as $image)
                                    <div class="col-md-3 mb-2">
                                        <img src="{{ asset('storage/' . $image) }}" alt="Dokumentasi"
                                             class="img-thumbnail" style="width: 100%; height: 80px; object-fit: cover;">
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Perbarui
                            </button>
                            <a href="{{ route('pkm.show', $pkm) }}" class="btn btn-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <!-- Current Info -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Informasi Saat Ini</h6>
                </div>
                <div class="card-body">
                    <div class="text-center mb-3">
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ Str::limit($pkm->judul, 30) }}</div>
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Judul PKM</div>
                    </div>

                    <div class="text-center mb-3">
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            @if($pkm->mahasiswa->count() > 0)
                                {{ $pkm->mahasiswa->pluck('nama')->join(', ') }}
                            @else
                                N/A
                            @endif
                        </div>
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Mahasiswa ({{ $pkm->mahasiswa->count() }})</div>
                    </div>

                    <div class="text-center mb-3">
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            @if($pkm->dosen->count() > 0)
                                {{ $pkm->dosen->pluck('nama')->join(', ') }}
                            @else
                                N/A
                            @endif
                        </div>
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Dosen Pembimbing ({{ $pkm->dosen->count() }})</div>
                    </div>

                    <div class="text-center">
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $pkm->tahun }}</div>
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Tahun</div>
                    </div>
                </div>
            </div>

            <!-- Guidelines -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Panduan Edit</h6>
                </div>
                <div class="card-body">
                    <ul class="small mb-0">
                        <li>Kosongkan field dokumentasi jika tidak ingin mengubah gambar</li>
                        <li>Jika upload gambar baru, gambar lama akan diganti</li>
                        <li>Pastikan data mahasiswa dan dosen sudah benar</li>
                        <li>Biaya dalam Rupiah tanpa tanda titik/koma</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection