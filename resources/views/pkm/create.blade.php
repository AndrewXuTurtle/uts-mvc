@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tambah Data PKM</h1>
        <a href="{{ route('pkm.index') }}" class="btn btn-sm btn-secondary">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Form Tambah PKM</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('pkm.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="judul_pkm">Judul PKM <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('judul_pkm') is-invalid @enderror" 
                                   id="judul_pkm" name="judul_pkm" value="{{ old('judul_pkm') }}" required>
                            @error('judul_pkm')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="deskripsi">Deskripsi <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('deskripsi') is-invalid @enderror" 
                                      id="deskripsi" name="deskripsi" rows="4" required>{{ old('deskripsi') }}</textarea>
                            @error('deskripsi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="tahun">Tahun <span class="text-danger">*</span></label>
                            <input type="number" class="form-control @error('tahun') is-invalid @enderror" 
                                   id="tahun" name="tahun" value="{{ old('tahun', date('Y')) }}" 
                                   min="2000" max="{{ date('Y') + 1 }}" required>
                            @error('tahun')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="jenis_pkm">Jenis PKM <span class="text-danger">*</span></label>
                            <select class="form-control @error('jenis_pkm') is-invalid @enderror" 
                                    id="jenis_pkm" name="jenis_pkm" required>
                                <option value="">-- Pilih Jenis --</option>
                                <option value="PKM-R" {{ old('jenis_pkm') == 'PKM-R' ? 'selected' : '' }}>PKM-R (Riset)</option>
                                <option value="PKM-K" {{ old('jenis_pkm') == 'PKM-K' ? 'selected' : '' }}>PKM-K (Kewirausahaan)</option>
                                <option value="PKM-M" {{ old('jenis_pkm') == 'PKM-M' ? 'selected' : '' }}>PKM-M (Pengabdian Masyarakat)</option>
                                <option value="PKM-T" {{ old('jenis_pkm') == 'PKM-T' ? 'selected' : '' }}>PKM-T (Karsa Cipta)</option>
                                <option value="PKM-KC" {{ old('jenis_pkm') == 'PKM-KC' ? 'selected' : '' }}>PKM-KC (Karya Inovatif)</option>
                                <option value="PKM-AI" {{ old('jenis_pkm') == 'PKM-AI' ? 'selected' : '' }}>PKM-AI (Artikel Ilmiah)</option>
                                <option value="PKM-GT" {{ old('jenis_pkm') == 'PKM-GT' ? 'selected' : '' }}>PKM-GT (Gagasan Tertulis)</option>
                            </select>
                            @error('jenis_pkm')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="status">Status <span class="text-danger">*</span></label>
                            <select class="form-control @error('status') is-invalid @enderror" 
                                    id="status" name="status" required>
                                <option value="">-- Pilih Status --</option>
                                <option value="Proposal" {{ old('status') == 'Proposal' ? 'selected' : '' }}>Proposal</option>
                                <option value="Didanai" {{ old('status') == 'Didanai' ? 'selected' : '' }}>Didanai</option>
                                <option value="Selesai" {{ old('status') == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                                <option value="Ditolak" {{ old('status') == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
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
                            <label for="dosen_pembimbing_id">Dosen Pembimbing <span class="text-danger">*</span></label>
                            <select class="form-control select2 @error('dosen_pembimbing_id') is-invalid @enderror" 
                                    id="dosen_pembimbing_id" name="dosen_pembimbing_id" required>
                                <option value="">-- Pilih Dosen --</option>
                                @foreach($dosen as $d)
                                    <option value="{{ $d->id }}" {{ old('dosen_pembimbing_id') == $d->id ? 'selected' : '' }}>
                                        {{ $d->nama }} - {{ $d->nidn }}
                                    </option>
                                @endforeach
                            </select>
                            @error('dosen_pembimbing_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="dana">Dana (Rp)</label>
                            <input type="number" class="form-control @error('dana') is-invalid @enderror" 
                                   id="dana" name="dana" value="{{ old('dana') }}" min="0" step="0.01">
                            @error('dana')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="pencapaian">Pencapaian</label>
                            <input type="text" class="form-control @error('pencapaian') is-invalid @enderror" 
                                   id="pencapaian" name="pencapaian" value="{{ old('pencapaian') }}" 
                                   placeholder="Lolos Dikti, Juara, dll">
                            @error('pencapaian')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="file_dokumen">File Dokumen (PDF/DOC/DOCX, Max: 5MB)</label>
                    <input type="file" class="form-control-file @error('file_dokumen') is-invalid @enderror" 
                           id="file_dokumen" name="file_dokumen" accept=".pdf,.doc,.docx">
                    @error('file_dokumen')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <hr>

                <h5>Tim Mahasiswa <span class="text-danger">*</span></h5>
                <p class="text-muted small">Minimal 1 mahasiswa. Klik tombol "Tambah Mahasiswa" untuk menambah anggota tim.</p>

                <div id="mahasiswa-container">
                    <div class="mahasiswa-item mb-3">
                        <div class="row align-items-end">
                            <div class="col-md-8">
                                <label>Mahasiswa</label>
                                <select class="form-control select2-mahasiswa @error('mahasiswa_nim.0') is-invalid @enderror" 
                                        name="mahasiswa_nim[]" required>
                                    <option value="">-- Pilih Mahasiswa --</option>
                                    @foreach($mahasiswa as $mhs)
                                        <option value="{{ $mhs->nim }}">{{ $mhs->nim }} - {{ $mhs->nama }}</option>
                                    @endforeach
                                </select>
                                @error('mahasiswa_nim.0')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <label>Peran</label>
                                <select class="form-control" name="mahasiswa_peran[]">
                                    <option value="Ketua">Ketua</option>
                                    <option value="Anggota" selected>Anggota</option>
                                </select>
                            </div>
                            <div class="col-md-1">
                                <button type="button" class="btn btn-danger btn-sm remove-mahasiswa" disabled>
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <button type="button" class="btn btn-sm btn-success mb-3" id="add-mahasiswa">
                    <i class="fas fa-plus"></i> Tambah Mahasiswa
                </button>

                <hr>

                <div class="d-flex justify-content-end">
                    <a href="{{ route('pkm.index') }}" class="btn btn-secondary mr-2">
                        <i class="fas fa-times"></i> Batal
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/select2-bootstrap-theme@0.1.0-beta.10/dist/select2-bootstrap.min.css" rel="stylesheet" />
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
$(document).ready(function() {
    // Initialize Select2 for dosen
    $('.select2').select2({
        theme: 'bootstrap',
        placeholder: '-- Pilih Dosen --',
        allowClear: true
    });

    // Initialize Select2 for mahasiswa
    function initMahasiswaSelect2() {
        $('.select2-mahasiswa').select2({
            theme: 'bootstrap',
            placeholder: '-- Pilih Mahasiswa --',
            allowClear: true
        });
    }
    initMahasiswaSelect2();

    // Add mahasiswa
    let mahasiswaIndex = 1;
    $('#add-mahasiswa').on('click', function() {
        const newItem = `
            <div class="mahasiswa-item mb-3">
                <div class="row align-items-end">
                    <div class="col-md-8">
                        <label>Mahasiswa</label>
                        <select class="form-control select2-mahasiswa" name="mahasiswa_nim[]" required>
                            <option value="">-- Pilih Mahasiswa --</option>
                            @foreach($mahasiswa as $mhs)
                                <option value="{{ $mhs->nim }}">{{ $mhs->nim }} - {{ $mhs->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label>Peran</label>
                        <select class="form-control" name="mahasiswa_peran[]">
                            <option value="Ketua">Ketua</option>
                            <option value="Anggota" selected>Anggota</option>
                        </select>
                    </div>
                    <div class="col-md-1">
                        <button type="button" class="btn btn-danger btn-sm remove-mahasiswa">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
            </div>
        `;
        $('#mahasiswa-container').append(newItem);
        initMahasiswaSelect2();
        updateRemoveButtons();
        mahasiswaIndex++;
    });

    // Remove mahasiswa
    $(document).on('click', '.remove-mahasiswa', function() {
        $(this).closest('.mahasiswa-item').remove();
        updateRemoveButtons();
    });

    // Update remove buttons state
    function updateRemoveButtons() {
        const itemCount = $('.mahasiswa-item').length;
        $('.remove-mahasiswa').prop('disabled', itemCount === 1);
    }
});
</script>
@endpush
@endsection
