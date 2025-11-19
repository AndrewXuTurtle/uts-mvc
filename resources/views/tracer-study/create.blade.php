@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tambah Data Tracer Study</h1>
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
            <h6 class="m-0 font-weight-bold text-primary">Form Tracer Study</h6>
        </div>
        <div class="card-body">
            <!-- Step 1: NIM Validation -->
            <div id="nimValidationSection">
                <div class="alert alert-info">
                    <i class="fas fa-info-circle"></i> Masukkan NIM alumni terlebih dahulu
                </div>
                
                <div class="form-group">
                    <label for="nim_input">NIM Alumni <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <input type="text" id="nim_input" class="form-control" placeholder="Masukkan NIM Alumni">
                        <div class="input-group-append">
                            <button type="button" id="btnValidateNim" class="btn btn-primary">
                                <i class="fas fa-search"></i> Validasi
                            </button>
                        </div>
                    </div>
                </div>

                <div id="alumniInfo" class="alert alert-success d-none mt-3">
                    <h5><i class="fas fa-user-graduate"></i> Data Alumni</h5>
                    <table class="table table-sm table-borderless mb-0">
                        <tr><td width="150"><strong>NIM</strong></td><td>: <span id="info_nim"></span></td></tr>
                        <tr><td><strong>Nama</strong></td><td>: <span id="info_nama"></span></td></tr>
                        <tr><td><strong>Prodi</strong></td><td>: <span id="info_prodi"></span></td></tr>
                    </table>
                    <button type="button" id="btnProceed" class="btn btn-success mt-2">
                        <i class="fas fa-check"></i> Lanjutkan
                    </button>
                </div>

                <div id="alumniError" class="alert alert-danger d-none mt-3">
                    <i class="fas fa-exclamation-triangle"></i> <span id="error_message"></span>
                </div>
            </div>

            <!-- Step 2: Form -->
            <form id="tracerStudyForm" action="{{ route('tracer-study.store') }}" method="POST" class="d-none">
                @csrf
                <input type="hidden" name="nim" id="nim_hidden">

                <div class="alert alert-success">
                    <strong>Alumni:</strong> <span id="form_alumni_name"></span> (<span id="form_alumni_nim"></span>)
                    <button type="button" id="btnChangeNim" class="btn btn-sm btn-secondary float-right">
                        <i class="fas fa-edit"></i> Ubah
                    </button>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tahun_survey">Tahun Survey <span class="text-danger">*</span></label>
                            <input type="number" name="tahun_survey" id="tahun_survey" class="form-control @error('tahun_survey') is-invalid @enderror" 
                                   value="{{ old('tahun_survey', date('Y')) }}" min="2000" max="{{ date('Y') + 1 }}" required>
                            @error('tahun_survey')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="status_pekerjaan">Status Pekerjaan <span class="text-danger">*</span></label>
                            <select name="status_pekerjaan" id="status_pekerjaan" class="form-control @error('status_pekerjaan') is-invalid @enderror" required>
                                <option value="">Pilih Status</option>
                                <option value="Bekerja Full Time">Bekerja Full Time</option>
                                <option value="Bekerja Part Time">Bekerja Part Time</option>
                                <option value="Wiraswasta">Wiraswasta</option>
                                <option value="Melanjutkan Studi">Melanjutkan Studi</option>
                                <option value="Belum Bekerja">Belum Bekerja</option>
                                <option value="Freelancer">Freelancer</option>
                            </select>
                            @error('status_pekerjaan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="nama_perusahaan">Nama Perusahaan</label>
                            <input type="text" name="nama_perusahaan" id="nama_perusahaan" class="form-control" maxlength="255">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="posisi">Posisi/Jabatan</label>
                            <input type="text" name="posisi" id="posisi" class="form-control" maxlength="255">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="bidang_pekerjaan">Bidang Pekerjaan</label>
                            <input type="text" name="bidang_pekerjaan" id="bidang_pekerjaan" class="form-control" maxlength="255">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="gaji">Gaji (Rp)</label>
                            <input type="number" name="gaji" id="gaji" class="form-control" min="0" step="100000">
                            <small class="text-muted">Opsional</small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="waktu_tunggu_kerja">Waktu Tunggu Kerja (Bulan)</label>
                            <input type="number" name="waktu_tunggu_kerja" id="waktu_tunggu_kerja" class="form-control" min="0">
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
                                <option value="Sangat Sesuai">Sangat Sesuai</option>
                                <option value="Sesuai">Sesuai</option>
                                <option value="Cukup Sesuai">Cukup Sesuai</option>
                                <option value="Kurang Sesuai">Kurang Sesuai</option>
                                <option value="Tidak Sesuai">Tidak Sesuai</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="kepuasan_prodi">Kepuasan terhadap Prodi (1-5)</label>
                            <select name="kepuasan_prodi" id="kepuasan_prodi" class="form-control">
                                <option value="">Pilih Rating</option>
                                <option value="1">1 - Sangat Tidak Puas</option>
                                <option value="2">2 - Tidak Puas</option>
                                <option value="3">3 - Cukup</option>
                                <option value="4">4 - Puas</option>
                                <option value="5">5 - Sangat Puas</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="kompetensi_didapat">Kompetensi yang Didapat</label>
                    <textarea name="kompetensi_didapat" id="kompetensi_didapat" rows="3" class="form-control" placeholder="Kompetensi apa yang Anda dapatkan dari prodi"></textarea>
                </div>

                <div class="form-group">
                    <label for="saran_prodi">Saran untuk Prodi</label>
                    <textarea name="saran_prodi" id="saran_prodi" rows="3" class="form-control" placeholder="Saran untuk pengembangan prodi"></textarea>
                </div>

                <div class="form-group">
                    <label for="saran_pengembangan">Saran Pengembangan</label>
                    <textarea name="saran_pengembangan" id="saran_pengembangan" rows="3" class="form-control" placeholder="Saran pengembangan secara umum"></textarea>
                </div>

                <hr>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Simpan
                    </button>
                    <a href="{{ route('tracer-study.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
$(document).ready(function() {
    $('#btnValidateNim').click(function() {
        const nim = $('#nim_input').val();
        if (!nim) {
            alert('Silakan masukkan NIM');
            return;
        }

        $.ajax({
            url: '{{ route("tracer-study.validate-nim") }}',
            method: 'POST',
            data: { nim: nim, _token: '{{ csrf_token() }}' },
            success: function(response) {
                if (response.success) {
                    $('#info_nim').text(response.data.nim);
                    $('#info_nama').text(response.data.nama);
                    $('#info_prodi').text(response.data.prodi);
                    $('#alumniInfo').removeClass('d-none');
                    $('#alumniError').addClass('d-none');
                }
            },
            error: function(xhr) {
                const message = xhr.responseJSON?.message || 'NIM tidak ditemukan';
                $('#error_message').text(message);
                $('#alumniError').removeClass('d-none');
                $('#alumniInfo').addClass('d-none');
            }
        });
    });

    $('#btnProceed').click(function() {
        const nim = $('#nim_input').val();
        const nama = $('#info_nama').text();
        $('#nim_hidden').val(nim);
        $('#form_alumni_nim').text(nim);
        $('#form_alumni_name').text(nama);
        $('#nimValidationSection').addClass('d-none');
        $('#tracerStudyForm').removeClass('d-none');
    });

    $('#btnChangeNim').click(function() {
        $('#tracerStudyForm').addClass('d-none');
        $('#nimValidationSection').removeClass('d-none');
        $('#alumniInfo').addClass('d-none');
        $('#nim_input').val('');
    });
});
</script>
@endpush
@endsection
