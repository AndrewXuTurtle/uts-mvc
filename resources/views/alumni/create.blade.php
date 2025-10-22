@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tambah Data Alumni</h1>
        <a href="{{ route('alumni.index') }}" class="btn btn-sm btn-secondary">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Form Tambah Alumni</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('alumni.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Data Pribadi Section -->
                        <div class="card mb-3">
                            <div class="card-header bg-light">
                                <h6 class="mb-0">Data Pribadi</h6>
                            </div>
                            <div class="card-body">
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="nama">Nama Lengkap <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('nama') is-invalid @enderror" 
                                               id="nama" name="nama" value="{{ old('nama') }}" required>
                                        @error('nama')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="nim">NIM <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('nim') is-invalid @enderror" 
                                               id="nim" name="nim" value="{{ old('nim') }}" required>
                                        @error('nim')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="program_studi">Program Studi <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('program_studi') is-invalid @enderror" 
                                               id="program_studi" name="program_studi" value="{{ old('program_studi') }}" required>
                                        @error('program_studi')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="tahun_lulus">Tahun Lulus <span class="text-danger">*</span></label>
                                        <input type="number" class="form-control @error('tahun_lulus') is-invalid @enderror" 
                                               id="tahun_lulus" name="tahun_lulus" value="{{ old('tahun_lulus') }}" 
                                               min="1900" max="2050" required>
                                        @error('tahun_lulus')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="ipk">IPK</label>
                                        <input type="number" class="form-control @error('ipk') is-invalid @enderror" 
                                               id="ipk" name="ipk" value="{{ old('ipk') }}" 
                                               min="0" max="4" step="0.01">
                                        @error('ipk')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                               id="email" name="email" value="{{ old('email') }}">
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="telepon">Telepon</label>
                                        <input type="text" class="form-control @error('telepon') is-invalid @enderror" 
                                               id="telepon" name="telepon" value="{{ old('telepon') }}">
                                        @error('telepon')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="linkedin">LinkedIn URL</label>
                                        <input type="url" class="form-control @error('linkedin') is-invalid @enderror" 
                                               id="linkedin" name="linkedin" value="{{ old('linkedin') }}" 
                                               placeholder="https://linkedin.com/in/username">
                                        @error('linkedin')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="foto">Foto Alumni</label>
                                    <input type="file" class="form-control-file @error('foto') is-invalid @enderror" 
                                           id="foto" name="foto" accept="image/*">
                                    <small class="form-text text-muted">Format: JPG, PNG, GIF. Max: 2MB</small>
                                    @error('foto')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Data Pekerjaan Section -->
                        <div class="card mb-3">
                            <div class="card-header bg-light">
                                <h6 class="mb-0">Data Pekerjaan / Studi Lanjut</h6>
                            </div>
                            <div class="card-body">
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="pekerjaan_sekarang">Status Saat Ini</label>
                                        <select class="form-control @error('pekerjaan_sekarang') is-invalid @enderror" 
                                                id="pekerjaan_sekarang" name="pekerjaan_sekarang">
                                            <option value="">Pilih Status</option>
                                            <option value="Bekerja" {{ old('pekerjaan_sekarang') == 'Bekerja' ? 'selected' : '' }}>Bekerja</option>
                                            <option value="Wirausaha" {{ old('pekerjaan_sekarang') == 'Wirausaha' ? 'selected' : '' }}>Wirausaha</option>
                                            <option value="Melanjutkan Studi" {{ old('pekerjaan_sekarang') == 'Melanjutkan Studi' ? 'selected' : '' }}>Melanjutkan Studi</option>
                                            <option value="Belum Bekerja" {{ old('pekerjaan_sekarang') == 'Belum Bekerja' ? 'selected' : '' }}>Belum Bekerja</option>
                                        </select>
                                        @error('pekerjaan_sekarang')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="nama_perusahaan">Nama Perusahaan / Institusi</label>
                                        <input type="text" class="form-control @error('nama_perusahaan') is-invalid @enderror" 
                                               id="nama_perusahaan" name="nama_perusahaan" value="{{ old('nama_perusahaan') }}">
                                        @error('nama_perusahaan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="posisi">Posisi / Jabatan</label>
                                        <input type="text" class="form-control @error('posisi') is-invalid @enderror" 
                                               id="posisi" name="posisi" value="{{ old('posisi') }}">
                                        @error('posisi')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="tanggal_mulai_kerja">Tanggal Mulai Bekerja</label>
                                        <input type="date" class="form-control @error('tanggal_mulai_kerja') is-invalid @enderror" 
                                               id="tanggal_mulai_kerja" name="tanggal_mulai_kerja" value="{{ old('tanggal_mulai_kerja') }}">
                                        @error('tanggal_mulai_kerja')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="alamat_perusahaan">Alamat Perusahaan</label>
                                    <textarea class="form-control @error('alamat_perusahaan') is-invalid @enderror" 
                                              id="alamat_perusahaan" name="alamat_perusahaan" rows="2">{{ old('alamat_perusahaan') }}</textarea>
                                    @error('alamat_perusahaan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="gaji_range">Range Gaji (Optional, untuk keperluan statistik)</label>
                                    <input type="number" class="form-control @error('gaji_range') is-invalid @enderror" 
                                           id="gaji_range" name="gaji_range" value="{{ old('gaji_range') }}" 
                                           placeholder="Contoh: 5000000">
                                    <small class="form-text text-muted">Data ini bersifat rahasia dan hanya untuk statistik internal</small>
                                    @error('gaji_range')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Testimoni & Pencapaian Section -->
                        <div class="card mb-3">
                            <div class="card-header bg-light">
                                <h6 class="mb-0">Testimoni & Pencapaian</h6>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="testimoni">Testimoni / Kesan Pesan</label>
                                    <textarea class="form-control @error('testimoni') is-invalid @enderror" 
                                              id="testimoni" name="testimoni" rows="4" 
                                              placeholder="Ceritakan pengalaman Anda selama kuliah dan setelah lulus...">{{ old('testimoni') }}</textarea>
                                    @error('testimoni')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="pencapaian">Pencapaian Setelah Lulus</label>
                                    <textarea class="form-control @error('pencapaian') is-invalid @enderror" 
                                              id="pencapaian" name="pencapaian" rows="4" 
                                              placeholder="Ceritakan pencapaian dan prestasi Anda setelah lulus...">{{ old('pencapaian') }}</textarea>
                                    @error('pencapaian')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end">
                            <a href="{{ route('alumni.index') }}" class="btn btn-secondary mr-2">
                                <i class="fas fa-times"></i> Batal
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Simpan Data Alumni
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
