@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Data Tracer Study</h1>
        <a href="{{ route('tracer-study.index') }}" class="btn btn-sm btn-secondary">
            <i class="fas fa-arrow-left"></i> Kembali
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
            <h6 class="m-0 font-weight-bold text-primary">Form Edit Tracer Study</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('tracer-study.update', $tracerStudy->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="alert alert-info">
                    <strong>Alumni:</strong> {{ $tracerStudy->alumni->mahasiswa->nama ?? 'N/A' }} ({{ $tracerStudy->nim }})
                </div>

                <input type="hidden" name="nim" value="{{ $tracerStudy->nim }}">

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tahun_survey">Tahun Survey <span class="text-danger">*</span></label>
                            <input type="number" name="tahun_survey" id="tahun_survey" class="form-control @error('tahun_survey') is-invalid @enderror" 
                                   value="{{ old('tahun_survey', $tracerStudy->tahun_survey) }}" min="2000" max="{{ date('Y') + 1 }}" required>
                            @error('tahun_survey')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="status_pekerjaan">Status Pekerjaan <span class="text-danger">*</span></label>
                            <select name="status_pekerjaan" id="status_pekerjaan" class="form-control @error('status_pekerjaan') is-invalid @enderror" required>
                                <option value="">Pilih Status</option>
                                <option value="Bekerja Full Time" {{ old('status_pekerjaan', $tracerStudy->status_pekerjaan) == 'Bekerja Full Time' ? 'selected' : '' }}>Bekerja Full Time</option>
                                <option value="Bekerja Part Time" {{ old('status_pekerjaan', $tracerStudy->status_pekerjaan) == 'Bekerja Part Time' ? 'selected' : '' }}>Bekerja Part Time</option>
                                <option value="Wiraswasta" {{ old('status_pekerjaan', $tracerStudy->status_pekerjaan) == 'Wiraswasta' ? 'selected' : '' }}>Wiraswasta</option>
                                <option value="Melanjutkan Studi" {{ old('status_pekerjaan', $tracerStudy->status_pekerjaan) == 'Melanjutkan Studi' ? 'selected' : '' }}>Melanjutkan Studi</option>
                                <option value="Belum Bekerja" {{ old('status_pekerjaan', $tracerStudy->status_pekerjaan) == 'Belum Bekerja' ? 'selected' : '' }}>Belum Bekerja</option>
                                <option value="Freelancer" {{ old('status_pekerjaan', $tracerStudy->status_pekerjaan) == 'Freelancer' ? 'selected' : '' }}>Freelancer</option>
                            </select>
                            @error('status_pekerjaan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="nama_perusahaan">Nama Perusahaan</label>
                            <input type="text" name="nama_perusahaan" id="nama_perusahaan" class="form-control" value="{{ old('nama_perusahaan', $tracerStudy->nama_perusahaan) }}" maxlength="255">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="posisi">Posisi/Jabatan</label>
                            <input type="text" name="posisi" id="posisi" class="form-control" value="{{ old('posisi', $tracerStudy->posisi) }}" maxlength="255">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="bidang_pekerjaan">Bidang Pekerjaan</label>
                            <input type="text" name="bidang_pekerjaan" id="bidang_pekerjaan" class="form-control" value="{{ old('bidang_pekerjaan', $tracerStudy->bidang_pekerjaan) }}" maxlength="255">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="gaji">Gaji (Rp)</label>
                            <input type="number" name="gaji" id="gaji" class="form-control" value="{{ old('gaji', $tracerStudy->gaji) }}" min="0" step="100000">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="waktu_tunggu_kerja">Waktu Tunggu Kerja (Bulan)</label>
                            <input type="number" name="waktu_tunggu_kerja" id="waktu_tunggu_kerja" class="form-control" value="{{ old('waktu_tunggu_kerja', $tracerStudy->waktu_tunggu_kerja) }}" min="0">
                            <small class="text-muted">Berapa bulan sejak lulus hingga mendapat pekerjaan</small>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="kesesuaian_bidang_studi">Kesesuaian Bidang Studi</label>
                            <select name="kesesuaian_bidang_studi" id="kesesuaian_bidang_studi" class="form-control">
                                <option value="">Pilih Kesesuaian</option>
                                <option value="Sangat Sesuai" {{ old('kesesuaian_bidang_studi', $tracerStudy->kesesuaian_bidang_studi) == 'Sangat Sesuai' ? 'selected' : '' }}>Sangat Sesuai</option>
                                <option value="Sesuai" {{ old('kesesuaian_bidang_studi', $tracerStudy->kesesuaian_bidang_studi) == 'Sesuai' ? 'selected' : '' }}>Sesuai</option>
                                <option value="Cukup Sesuai" {{ old('kesesuaian_bidang_studi', $tracerStudy->kesesuaian_bidang_studi) == 'Cukup Sesuai' ? 'selected' : '' }}>Cukup Sesuai</option>
                                <option value="Kurang Sesuai" {{ old('kesesuaian_bidang_studi', $tracerStudy->kesesuaian_bidang_studi) == 'Kurang Sesuai' ? 'selected' : '' }}>Kurang Sesuai</option>
                                <option value="Tidak Sesuai" {{ old('kesesuaian_bidang_studi', $tracerStudy->kesesuaian_bidang_studi) == 'Tidak Sesuai' ? 'selected' : '' }}>Tidak Sesuai</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="kepuasan_prodi">Kepuasan terhadap Prodi (1-5)</label>
                            <select name="kepuasan_prodi" id="kepuasan_prodi" class="form-control">
                                <option value="">Pilih Rating</option>
                                <option value="1" {{ old('kepuasan_prodi', $tracerStudy->kepuasan_prodi) == 1 ? 'selected' : '' }}>1 - Sangat Tidak Puas</option>
                                <option value="2" {{ old('kepuasan_prodi', $tracerStudy->kepuasan_prodi) == 2 ? 'selected' : '' }}>2 - Tidak Puas</option>
                                <option value="3" {{ old('kepuasan_prodi', $tracerStudy->kepuasan_prodi) == 3 ? 'selected' : '' }}>3 - Cukup</option>
                                <option value="4" {{ old('kepuasan_prodi', $tracerStudy->kepuasan_prodi) == 4 ? 'selected' : '' }}>4 - Puas</option>
                                <option value="5" {{ old('kepuasan_prodi', $tracerStudy->kepuasan_prodi) == 5 ? 'selected' : '' }}>5 - Sangat Puas</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="kompetensi_didapat">Kompetensi yang Didapat</label>
                    <textarea name="kompetensi_didapat" id="kompetensi_didapat" rows="3" class="form-control">{{ old('kompetensi_didapat', $tracerStudy->kompetensi_didapat) }}</textarea>
                </div>

                <div class="form-group">
                    <label for="saran_prodi">Saran untuk Prodi</label>
                    <textarea name="saran_prodi" id="saran_prodi" rows="3" class="form-control">{{ old('saran_prodi', $tracerStudy->saran_prodi) }}</textarea>
                </div>

                <div class="form-group">
                    <label for="saran_pengembangan">Saran Pengembangan</label>
                    <textarea name="saran_pengembangan" id="saran_pengembangan" rows="3" class="form-control">{{ old('saran_pengembangan', $tracerStudy->saran_pengembangan) }}</textarea>
                </div>

                <hr>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Update
                    </button>
                    <a href="{{ route('tracer-study.show', $tracerStudy->id) }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
