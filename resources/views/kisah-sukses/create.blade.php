@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tambah Kisah Sukses</h1>
        <a href="{{ route('kisah-sukses.index') }}" class="btn btn-sm btn-secondary">
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
            <h6 class="m-0 font-weight-bold text-primary">Form Tambah Kisah Sukses</h6>
        </div>
        <div class="card-body">
            <!-- Step 1: NIM Validation -->
            <div id="nimValidationSection">
                <div class="alert alert-info">
                    <i class="fas fa-info-circle"></i> Silakan masukkan NIM alumni terlebih dahulu untuk memvalidasi data.
                </div>
                
                <div class="form-group">
                    <label for="nim_input">NIM Alumni <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <input type="text" id="nim_input" class="form-control" placeholder="Masukkan NIM Alumni">
                        <div class="input-group-append">
                            <button type="button" id="btnValidateNim" class="btn btn-primary">
                                <i class="fas fa-search"></i> Validasi NIM
                            </button>
                        </div>
                    </div>
                    <small class="form-text text-muted">Masukkan NIM alumni yang akan ditambahkan kisah suksesnya</small>
                </div>

                <!-- Alumni Info Display -->
                <div id="alumniInfo" class="alert alert-success d-none mt-3">
                    <h5><i class="fas fa-user-graduate"></i> Data Alumni</h5>
                    <table class="table table-sm table-borderless mb-0">
                        <tr>
                            <td width="150"><strong>NIM</strong></td>
                            <td>: <span id="info_nim"></span></td>
                        </tr>
                        <tr>
                            <td><strong>Nama</strong></td>
                            <td>: <span id="info_nama"></span></td>
                        </tr>
                        <tr>
                            <td><strong>Prodi</strong></td>
                            <td>: <span id="info_prodi"></span></td>
                        </tr>
                        <tr>
                            <td><strong>Email</strong></td>
                            <td>: <span id="info_email"></span></td>
                        </tr>
                    </table>
                    <button type="button" id="btnProceed" class="btn btn-success mt-2">
                        <i class="fas fa-check"></i> Lanjutkan Input Kisah Sukses
                    </button>
                </div>

                <div id="alumniError" class="alert alert-danger d-none mt-3">
                    <i class="fas fa-exclamation-triangle"></i> <span id="error_message"></span>
                </div>
            </div>

            <!-- Step 2: Kisah Sukses Form (Hidden initially) -->
            <form id="kisahSuksesForm" action="{{ route('kisah-sukses.store') }}" method="POST" enctype="multipart/form-data" class="d-none">
                @csrf
                
                <input type="hidden" name="nim" id="nim_hidden">

                <div class="alert alert-success">
                    <strong>Alumni:</strong> <span id="form_alumni_name"></span> (<span id="form_alumni_nim"></span>)
                    <button type="button" id="btnChangeNim" class="btn btn-sm btn-secondary float-right">
                        <i class="fas fa-edit"></i> Ubah NIM
                    </button>
                </div>

                <div class="form-group">
                    <label for="judul">Judul <span class="text-danger">*</span></label>
                    <input type="text" name="judul" id="judul" class="form-control @error('judul') is-invalid @enderror" 
                           value="{{ old('judul') }}" required maxlength="255">
                    @error('judul')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="kisah">Kisah Sukses <span class="text-danger">*</span></label>
                    <textarea name="kisah" id="kisah" rows="10" class="form-control @error('kisah') is-invalid @enderror" required>{{ old('kisah') }}</textarea>
                    <small class="form-text text-muted">Ceritakan perjalanan sukses alumni</small>
                    @error('kisah')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="pencapaian">Pencapaian</label>
                            <input type="text" name="pencapaian" id="pencapaian" class="form-control @error('pencapaian') is-invalid @enderror" 
                                   value="{{ old('pencapaian') }}" maxlength="255" placeholder="Contoh: CEO di Perusahaan X">
                            <small class="form-text text-muted">Posisi/pencapaian saat ini</small>
                            @error('pencapaian')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tahun_pencapaian">Tahun Pencapaian</label>
                            <input type="number" name="tahun_pencapaian" id="tahun_pencapaian" 
                                   class="form-control @error('tahun_pencapaian') is-invalid @enderror" 
                                   value="{{ old('tahun_pencapaian', date('Y')) }}" 
                                   min="2000" max="{{ date('Y') + 1 }}">
                            @error('tahun_pencapaian')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="foto">Foto</label>
                            <input type="file" name="foto" id="foto" class="form-control-file @error('foto') is-invalid @enderror" accept="image/jpeg,image/png,image/jpg">
                            <small class="form-text text-muted">Max 2MB (JPEG, PNG, JPG)</small>
                            @error('foto')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="status">Status <span class="text-danger">*</span></label>
                            <select name="status" id="status" class="form-control @error('status') is-invalid @enderror" required>
                                <option value="Draft" {{ old('status') == 'Draft' ? 'selected' : '' }}>Draft</option>
                                <option value="Published" {{ old('status', 'Published') == 'Published' ? 'selected' : '' }}>Published</option>
                            </select>
                            @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <hr>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Simpan
                    </button>
                    <a href="{{ route('kisah-sukses.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
$(document).ready(function() {
    // Validate NIM
    $('#btnValidateNim').click(function() {
        const nim = $('#nim_input').val();
        
        if (!nim) {
            alert('Silakan masukkan NIM terlebih dahulu');
            return;
        }

        $.ajax({
            url: '{{ route("kisah-sukses.validate-nim") }}',
            method: 'POST',
            data: {
                nim: nim,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                if (response.success) {
                    // Show alumni info
                    $('#info_nim').text(response.data.nim);
                    $('#info_nama').text(response.data.nama);
                    $('#info_prodi').text(response.data.prodi);
                    $('#info_email').text(response.data.email);
                    
                    $('#alumniInfo').removeClass('d-none');
                    $('#alumniError').addClass('d-none');
                } else {
                    $('#error_message').text(response.message);
                    $('#alumniError').removeClass('d-none');
                    $('#alumniInfo').addClass('d-none');
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

    // Proceed to form
    $('#btnProceed').click(function() {
        const nim = $('#nim_input').val();
        const nama = $('#info_nama').text();
        
        $('#nim_hidden').val(nim);
        $('#form_alumni_nim').text(nim);
        $('#form_alumni_name').text(nama);
        
        $('#nimValidationSection').addClass('d-none');
        $('#kisahSuksesForm').removeClass('d-none');
    });

    // Change NIM
    $('#btnChangeNim').click(function() {
        $('#kisahSuksesForm').addClass('d-none');
        $('#nimValidationSection').removeClass('d-none');
        $('#alumniInfo').addClass('d-none');
        $('#nim_input').val('');
    });
});
</script>
@endpush
@endsection
