@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Data Tracer Study</h1>
        <a href="{{ route('tracer-study.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali
        </a>
    </div>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Form Edit Tracer Study Alumni</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('tracer-study.update', $tracerStudy->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <!-- Informasi Dasar -->
                <h5 class="border-bottom pb-2 mb-3">Informasi Dasar</h5>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="alumni_id">Alumni <span class="text-danger">*</span></label>
                            <select name="alumni_id" id="alumni_id" class="form-control @error('alumni_id') is-invalid @enderror" required>
                                <option value="">Pilih Alumni</option>
                                @foreach($alumni as $a)
                                <option value="{{ $a->id }}" {{ old('alumni_id', $tracerStudy->alumni_id) == $a->id ? 'selected' : '' }}>
                                    {{ $a->nama }} - {{ $a->nim }} ({{ $a->tahun_lulus }})
                                </option>
                                @endforeach
                            </select>
                            @error('alumni_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="tahun_survey">Tahun Survey <span class="text-danger">*</span></label>
                            <input type="number" name="tahun_survey" id="tahun_survey" class="form-control @error('tahun_survey') is-invalid @enderror" 
                                   value="{{ old('tahun_survey', $tracerStudy->tahun_survey) }}" min="2000" max="{{ date('Y') + 1 }}" required>
                            @error('tahun_survey')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="bulan_sejak_lulus">Bulan Sejak Lulus <span class="text-danger">*</span></label>
                            <input type="number" name="bulan_sejak_lulus" id="bulan_sejak_lulus" class="form-control @error('bulan_sejak_lulus') is-invalid @enderror" 
                                   value="{{ old('bulan_sejak_lulus', $tracerStudy->bulan_sejak_lulus) }}" min="0" required>
                            @error('bulan_sejak_lulus')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                </div>

                <!-- Data Pekerjaan -->
                <h5 class="border-bottom pb-2 mb-3 mt-4">Data Pekerjaan</h5>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="status_pekerjaan">Status Pekerjaan <span class="text-danger">*</span></label>
                            <select name="status_pekerjaan" id="status_pekerjaan" class="form-control @error('status_pekerjaan') is-invalid @enderror" required>
                                <option value="">Pilih Status</option>
                                <option value="bekerja_full_time" {{ old('status_pekerjaan', $tracerStudy->status_pekerjaan) == 'bekerja_full_time' ? 'selected' : '' }}>Bekerja Full Time</option>
                                <option value="bekerja_part_time" {{ old('status_pekerjaan', $tracerStudy->status_pekerjaan) == 'bekerja_part_time' ? 'selected' : '' }}>Bekerja Part Time</option>
                                <option value="wiraswasta" {{ old('status_pekerjaan', $tracerStudy->status_pekerjaan) == 'wiraswasta' ? 'selected' : '' }}>Wiraswasta</option>
                                <option value="melanjutkan_studi" {{ old('status_pekerjaan', $tracerStudy->status_pekerjaan) == 'melanjutkan_studi' ? 'selected' : '' }}>Melanjutkan Studi</option>
                                <option value="tidak_bekerja" {{ old('status_pekerjaan', $tracerStudy->status_pekerjaan) == 'tidak_bekerja' ? 'selected' : '' }}>Tidak Bekerja</option>
                                <option value="freelance" {{ old('status_pekerjaan', $tracerStudy->status_pekerjaan) == 'freelance' ? 'selected' : '' }}>Freelance</option>
                            </select>
                            @error('status_pekerjaan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="waktu_tunggu_kerja">Waktu Tunggu Kerja</label>
                            <select name="waktu_tunggu_kerja" id="waktu_tunggu_kerja" class="form-control @error('waktu_tunggu_kerja') is-invalid @enderror">
                                <option value="">Pilih Waktu Tunggu</option>
                                <option value="kurang_3_bulan" {{ old('waktu_tunggu_kerja', $tracerStudy->waktu_tunggu_kerja) == 'kurang_3_bulan' ? 'selected' : '' }}>Kurang dari 3 Bulan</option>
                                <option value="3_6_bulan" {{ old('waktu_tunggu_kerja', $tracerStudy->waktu_tunggu_kerja) == '3_6_bulan' ? 'selected' : '' }}>3-6 Bulan</option>
                                <option value="6_12_bulan" {{ old('waktu_tunggu_kerja', $tracerStudy->waktu_tunggu_kerja) == '6_12_bulan' ? 'selected' : '' }}>6-12 Bulan</option>
                                <option value="lebih_12_bulan" {{ old('waktu_tunggu_kerja', $tracerStudy->waktu_tunggu_kerja) == 'lebih_12_bulan' ? 'selected' : '' }}>Lebih dari 12 Bulan</option>
                                <option value="belum_bekerja" {{ old('waktu_tunggu_kerja', $tracerStudy->waktu_tunggu_kerja) == 'belum_bekerja' ? 'selected' : '' }}>Belum Bekerja</option>
                            </select>
                            @error('waktu_tunggu_kerja')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="nama_perusahaan">Nama Perusahaan</label>
                            <input type="text" name="nama_perusahaan" id="nama_perusahaan" class="form-control @error('nama_perusahaan') is-invalid @enderror" 
                                   value="{{ old('nama_perusahaan', $tracerStudy->nama_perusahaan) }}" maxlength="255">
                            @error('nama_perusahaan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="posisi_pekerjaan">Posisi Pekerjaan</label>
                            <input type="text" name="posisi_pekerjaan" id="posisi_pekerjaan" class="form-control @error('posisi_pekerjaan') is-invalid @enderror" 
                                   value="{{ old('posisi_pekerjaan', $tracerStudy->posisi_pekerjaan) }}" maxlength="255">
                            @error('posisi_pekerjaan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="bidang_pekerjaan">Bidang Pekerjaan</label>
                            <input type="text" name="bidang_pekerjaan" id="bidang_pekerjaan" class="form-control @error('bidang_pekerjaan') is-invalid @enderror" 
                                   value="{{ old('bidang_pekerjaan', $tracerStudy->bidang_pekerjaan) }}" maxlength="255">
                            @error('bidang_pekerjaan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="tingkat_pendidikan_pekerjaan">Tingkat Pendidikan yang Diperlukan</label>
                            <select name="tingkat_pendidikan_pekerjaan" id="tingkat_pendidikan_pekerjaan" class="form-control @error('tingkat_pendidikan_pekerjaan') is-invalid @enderror">
                                <option value="">Pilih Tingkat</option>
                                <option value="D3" {{ old('tingkat_pendidikan_pekerjaan', $tracerStudy->tingkat_pendidikan_pekerjaan) == 'D3' ? 'selected' : '' }}>D3</option>
                                <option value="S1" {{ old('tingkat_pendidikan_pekerjaan', $tracerStudy->tingkat_pendidikan_pekerjaan) == 'S1' ? 'selected' : '' }}>S1</option>
                                <option value="S2" {{ old('tingkat_pendidikan_pekerjaan', $tracerStudy->tingkat_pendidikan_pekerjaan) == 'S2' ? 'selected' : '' }}>S2</option>
                                <option value="S3" {{ old('tingkat_pendidikan_pekerjaan', $tracerStudy->tingkat_pendidikan_pekerjaan) == 'S3' ? 'selected' : '' }}>S3</option>
                                <option value="tidak_perlu" {{ old('tingkat_pendidikan_pekerjaan', $tracerStudy->tingkat_pendidikan_pekerjaan) == 'tidak_perlu' ? 'selected' : '' }}>Tidak Perlu</option>
                            </select>
                            @error('tingkat_pendidikan_pekerjaan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="gaji_pertama">Gaji Pertama (Rp)</label>
                            <input type="number" name="gaji_pertama" id="gaji_pertama" class="form-control @error('gaji_pertama') is-invalid @enderror" 
                                   value="{{ old('gaji_pertama', $tracerStudy->gaji_pertama) }}" min="0" step="100000">
                            @error('gaji_pertama')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="gaji_sekarang">Gaji Sekarang (Rp)</label>
                            <input type="number" name="gaji_sekarang" id="gaji_sekarang" class="form-control @error('gaji_sekarang') is-invalid @enderror" 
                                   value="{{ old('gaji_sekarang', $tracerStudy->gaji_sekarang) }}" min="0" step="100000">
                            @error('gaji_sekarang')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="kesesuaian_pekerjaan">Kesesuaian Pekerjaan dengan Bidang Studi</label>
                            <select name="kesesuaian_pekerjaan" id="kesesuaian_pekerjaan" class="form-control @error('kesesuaian_pekerjaan') is-invalid @enderror">
                                <option value="">Pilih Kesesuaian</option>
                                <option value="sangat_sesuai" {{ old('kesesuaian_pekerjaan', $tracerStudy->kesesuaian_pekerjaan) == 'sangat_sesuai' ? 'selected' : '' }}>Sangat Sesuai</option>
                                <option value="sesuai" {{ old('kesesuaian_pekerjaan', $tracerStudy->kesesuaian_pekerjaan) == 'sesuai' ? 'selected' : '' }}>Sesuai</option>
                                <option value="cukup_sesuai" {{ old('kesesuaian_pekerjaan', $tracerStudy->kesesuaian_pekerjaan) == 'cukup_sesuai' ? 'selected' : '' }}>Cukup Sesuai</option>
                                <option value="kurang_sesuai" {{ old('kesesuaian_pekerjaan', $tracerStudy->kesesuaian_pekerjaan) == 'kurang_sesuai' ? 'selected' : '' }}>Kurang Sesuai</option>
                                <option value="tidak_sesuai" {{ old('kesesuaian_pekerjaan', $tracerStudy->kesesuaian_pekerjaan) == 'tidak_sesuai' ? 'selected' : '' }}>Tidak Sesuai</option>
                            </select>
                            @error('kesesuaian_pekerjaan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="cara_dapat_kerja">Cara Mendapatkan Pekerjaan</label>
                            <input type="text" name="cara_dapat_kerja" id="cara_dapat_kerja" class="form-control @error('cara_dapat_kerja') is-invalid @enderror" 
                                   value="{{ old('cara_dapat_kerja', $tracerStudy->cara_dapat_kerja) }}" maxlength="255" placeholder="Contoh: LinkedIn, Jobfair, Referensi">
                            @error('cara_dapat_kerja')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                </div>

                <!-- Penilaian Kompetensi -->
                <h5 class="border-bottom pb-2 mb-3 mt-4">Penilaian Kompetensi (Skala 1-5)</h5>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="kompetensi_teknis">Kompetensi Teknis</label>
                            <input type="number" name="kompetensi_teknis" id="kompetensi_teknis" class="form-control @error('kompetensi_teknis') is-invalid @enderror" 
                                   value="{{ old('kompetensi_teknis', $tracerStudy->kompetensi_teknis) }}" min="1" max="5">
                            @error('kompetensi_teknis')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="kompetensi_bahasa_inggris">Bahasa Inggris</label>
                            <input type="number" name="kompetensi_bahasa_inggris" id="kompetensi_bahasa_inggris" class="form-control @error('kompetensi_bahasa_inggris') is-invalid @enderror" 
                                   value="{{ old('kompetensi_bahasa_inggris', $tracerStudy->kompetensi_bahasa_inggris) }}" min="1" max="5">
                            @error('kompetensi_bahasa_inggris')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="kompetensi_komunikasi">Komunikasi</label>
                            <input type="number" name="kompetensi_komunikasi" id="kompetensi_komunikasi" class="form-control @error('kompetensi_komunikasi') is-invalid @enderror" 
                                   value="{{ old('kompetensi_komunikasi', $tracerStudy->kompetensi_komunikasi) }}" min="1" max="5">
                            @error('kompetensi_komunikasi')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="kompetensi_teamwork">Teamwork</label>
                            <input type="number" name="kompetensi_teamwork" id="kompetensi_teamwork" class="form-control @error('kompetensi_teamwork') is-invalid @enderror" 
                                   value="{{ old('kompetensi_teamwork', $tracerStudy->kompetensi_teamwork) }}" min="1" max="5">
                            @error('kompetensi_teamwork')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="kompetensi_problem_solving">Problem Solving</label>
                            <input type="number" name="kompetensi_problem_solving" id="kompetensi_problem_solving" class="form-control @error('kompetensi_problem_solving') is-invalid @enderror" 
                                   value="{{ old('kompetensi_problem_solving', $tracerStudy->kompetensi_problem_solving) }}" min="1" max="5">
                            @error('kompetensi_problem_solving')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                </div>

                <!-- Kepuasan terhadap Prodi -->
                <h5 class="border-bottom pb-2 mb-3 mt-4">Kepuasan terhadap Prodi (Skala 1-5)</h5>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="kepuasan_kurikulum">Kurikulum</label>
                            <input type="number" name="kepuasan_kurikulum" id="kepuasan_kurikulum" class="form-control @error('kepuasan_kurikulum') is-invalid @enderror" 
                                   value="{{ old('kepuasan_kurikulum', $tracerStudy->kepuasan_kurikulum) }}" min="1" max="5">
                            @error('kepuasan_kurikulum')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="kepuasan_dosen">Dosen</label>
                            <input type="number" name="kepuasan_dosen" id="kepuasan_dosen" class="form-control @error('kepuasan_dosen') is-invalid @enderror" 
                                   value="{{ old('kepuasan_dosen', $tracerStudy->kepuasan_dosen) }}" min="1" max="5">
                            @error('kepuasan_dosen')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="kepuasan_fasilitas">Fasilitas</label>
                            <input type="number" name="kepuasan_fasilitas" id="kepuasan_fasilitas" class="form-control @error('kepuasan_fasilitas') is-invalid @enderror" 
                                   value="{{ old('kepuasan_fasilitas', $tracerStudy->kepuasan_fasilitas) }}" min="1" max="5">
                            @error('kepuasan_fasilitas')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                </div>

                <!-- Saran dan Pesan -->
                <h5 class="border-bottom pb-2 mb-3 mt-4">Saran dan Pesan</h5>
                <div class="form-group">
                    <label for="saran_untuk_prodi">Saran untuk Prodi</label>
                    <textarea name="saran_untuk_prodi" id="saran_untuk_prodi" rows="4" class="form-control @error('saran_untuk_prodi') is-invalid @enderror">{{ old('saran_untuk_prodi', $tracerStudy->saran_untuk_prodi) }}</textarea>
                    @error('saran_untuk_prodi')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="form-group">
                    <label for="pesan_untuk_juniors">Pesan untuk Junior</label>
                    <textarea name="pesan_untuk_juniors" id="pesan_untuk_juniors" rows="4" class="form-control @error('pesan_untuk_juniors') is-invalid @enderror">{{ old('pesan_untuk_juniors', $tracerStudy->pesan_untuk_juniors) }}</textarea>
                    @error('pesan_untuk_juniors')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <!-- Status Survey -->
                <h5 class="border-bottom pb-2 mb-3 mt-4">Status</h5>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tanggal_survey">Tanggal Survey <span class="text-danger">*</span></label>
                            <input type="date" name="tanggal_survey" id="tanggal_survey" class="form-control @error('tanggal_survey') is-invalid @enderror" 
                                   value="{{ old('tanggal_survey', $tracerStudy->tanggal_survey) }}" required>
                            @error('tanggal_survey')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="status_survey">Status Survey <span class="text-danger">*</span></label>
                            <select name="status_survey" id="status_survey" class="form-control @error('status_survey') is-invalid @enderror" required>
                                <option value="draft" {{ old('status_survey', $tracerStudy->status_survey) == 'draft' ? 'selected' : '' }}>Draft</option>
                                <option value="completed" {{ old('status_survey', $tracerStudy->status_survey) == 'completed' ? 'selected' : '' }}>Completed</option>
                                <option value="verified" {{ old('status_survey', $tracerStudy->status_survey) == 'verified' ? 'selected' : '' }}>Verified</option>
                            </select>
                            @error('status_survey')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                </div>

                <div class="form-group mt-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Simpan
                    </button>
                    <a href="{{ route('tracer-study.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
