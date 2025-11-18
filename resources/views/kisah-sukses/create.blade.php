@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tambah Kisah Sukses</h1>
        <a href="{{ route('kisah-sukses.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
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

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="kategori">Kategori <span class="text-danger">*</span></label>
                            <select name="kategori" id="kategori" class="form-control @error('kategori') is-invalid @enderror" required>
                                <option value="">Pilih Kategori</option>
                                <option value="karir" {{ old('kategori') == 'karir' ? 'selected' : '' }}>Karir</option>
                                <option value="wirausaha" {{ old('kategori') == 'wirausaha' ? 'selected' : '' }}>Wirausaha</option>
                                <option value="prestasi" {{ old('kategori') == 'prestasi' ? 'selected' : '' }}>Prestasi</option>
                                <option value="melanjutkan_studi" {{ old('kategori') == 'melanjutkan_studi' ? 'selected' : '' }}>Melanjutkan Studi</option>
                            </select>
                            @error('kategori')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
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
                    <label for="cerita">Cerita <span class="text-danger">*</span></label>
                    <textarea name="cerita" id="cerita" rows="10" class="form-control @error('cerita') is-invalid @enderror" required>{{ old('cerita') }}</textarea>
                    @error('cerita')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="quote">Quote</label>
                    <textarea name="quote" id="quote" rows="3" class="form-control @error('quote') is-invalid @enderror">{{ old('quote') }}</textarea>
                    @error('quote')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="foto_utama">Foto Utama</label>
                            <input type="file" name="foto_utama" id="foto_utama" class="form-control-file @error('foto_utama') is-invalid @enderror" accept="image/jpeg,image/png,image/jpg">
                            <small class="form-text text-muted">Max 2MB (JPEG, PNG, JPG)</small>
                            @error('foto_utama')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="galeri_foto">Galeri Foto (Multiple)</label>
                            <input type="file" name="galeri_foto[]" id="galeri_foto" class="form-control-file @error('galeri_foto') is-invalid @enderror" 
                                   accept="image/jpeg,image/png,image/jpg" multiple>
                            <small class="form-text text-muted">Max 2MB per foto (JPEG, PNG, JPG)</small>
                            @error('galeri_foto')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="video_url">Video URL (YouTube/Vimeo)</label>
                    <input type="url" name="video_url" id="video_url" class="form-control @error('video_url') is-invalid @enderror" 
                           value="{{ old('video_url') }}" placeholder="https://youtube.com/watch?v=...">
                    @error('video_url')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="tags">Tags (pisahkan dengan koma)</label>
                    <input type="text" name="tags" id="tags" class="form-control @error('tags') is-invalid @enderror" 
                           value="{{ old('tags') }}" placeholder="startup, international, tech-company">
                    <small class="form-text text-muted">Contoh: startup, international, tech-company</small>
                    @error('tags')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="tanggal_publish">Tanggal Publish <span class="text-danger">*</span></label>
                            <input type="date" name="tanggal_publish" id="tanggal_publish" 
                                   class="form-control @error('tanggal_publish') is-invalid @enderror" 
                                   value="{{ old('tanggal_publish', date('Y-m-d')) }}" required>
                            @error('tanggal_publish')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="status">Status <span class="text-danger">*</span></label>
                            <select name="status" id="status" class="form-control @error('status') is-invalid @enderror" required>
                                <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                                <option value="published" {{ old('status', 'published') == 'published' ? 'selected' : '' }}>Published</option>
                                <option value="archived" {{ old('status') == 'archived' ? 'selected' : '' }}>Archived</option>
                            </select>
                            @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>&nbsp;</label>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" name="is_featured" id="is_featured" class="custom-control-input" 
                                       value="1" {{ old('is_featured') ? 'checked' : '' }}>
                                <label class="custom-control-label" for="is_featured">
                                    <i class="fas fa-star text-warning"></i> Featured Story
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group mt-4">
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
    let alumniData = null;

    // Validate NIM button click
    $('#btnValidateNim').click(function() {
        const nim = $('#nim_input').val().trim();
        
        if (!nim) {
            alert('Silakan masukkan NIM terlebih dahulu');
            return;
        }

        // Show loading
        $(this).html('<i class="fas fa-spinner fa-spin"></i> Validating...').prop('disabled', true);
        $('#alumniInfo').addClass('d-none');
        $('#alumniError').addClass('d-none');

        // AJAX request
        $.ajax({
            url: '{{ route("kisah-sukses.validate-nim") }}',
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                nim: nim
            },
            success: function(response) {
                if (response.success) {
                    alumniData = response.data;
                    
                    // Display alumni info
                    $('#info_nim').text(response.data.nim);
                    $('#info_nama').text(response.data.nama);
                    $('#info_prodi').text(response.data.prodi);
                    $('#info_email').text(response.data.email);
                    
                    $('#alumniInfo').removeClass('d-none');
                    $('#alumniError').addClass('d-none');
                }
            },
            error: function(xhr) {
                const response = xhr.responseJSON;
                $('#error_message').text(response.message || 'Terjadi kesalahan saat validasi NIM');
                $('#alumniError').removeClass('d-none');
                $('#alumniInfo').addClass('d-none');
            },
            complete: function() {
                $('#btnValidateNim').html('<i class="fas fa-search"></i> Validasi NIM').prop('disabled', false);
            }
        });
    });

    // Proceed to form
    $('#btnProceed').click(function() {
        if (alumniData) {
            // Fill hidden field
            $('#nim_hidden').val(alumniData.nim);
            $('#form_alumni_name').text(alumniData.nama);
            $('#form_alumni_nim').text(alumniData.nim);
            
            // Show form, hide validation
            $('#nimValidationSection').addClass('d-none');
            $('#kisahSuksesForm').removeClass('d-none');
        }
    });

    // Change NIM button
    $('#btnChangeNim').click(function() {
        $('#nimValidationSection').removeClass('d-none');
        $('#kisahSuksesForm').addClass('d-none');
        $('#nim_input').val('').focus();
        $('#alumniInfo').addClass('d-none');
        $('#alumniError').addClass('d-none');
        alumniData = null;
    });

    // Enter key on NIM input
    $('#nim_input').keypress(function(e) {
        if (e.which === 13) {
            e.preventDefault();
            $('#btnValidateNim').click();
        }
    });
});
</script>
@endpush
@endsection
