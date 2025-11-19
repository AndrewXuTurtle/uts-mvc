@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tambah Alumni</h1>
        <a href="{{ route('alumni.index') }}" class="btn btn-sm btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Form Tambah Alumni</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('alumni.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="nim">Pilih Mahasiswa (Sudah Lulus) <span class="text-danger">*</span></label>
                            <select class="form-control @error('nim') is-invalid @enderror" id="nim" name="nim" required>
                                <option value="">-- Pilih Mahasiswa --</option>
                                @foreach($mahasiswaLulus as $mhs)
                                    <option value="{{ $mhs->nim }}" {{ old('nim') == $mhs->nim ? 'selected' : '' }}>
                                        {{ $mhs->nim }} - {{ $mhs->nama }}
                                    </option>
                                @endforeach
                            </select>
                            @error('nim')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            @if($mahasiswaLulus->isEmpty())
                                <small class="text-muted">Tidak ada mahasiswa dengan status "Lulus" yang belum menjadi alumni.</small>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="tahun_lulus">Tahun Lulus <span class="text-danger">*</span></label>
                            <input type="number" class="form-control @error('tahun_lulus') is-invalid @enderror" 
                                   id="tahun_lulus" name="tahun_lulus" value="{{ old('tahun_lulus', date('Y')) }}" 
                                   min="2000" max="{{ date('Y') + 10 }}" required>
                            @error('tahun_lulus')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-end">
                            <a href="{{ route('alumni.index') }}" class="btn btn-secondary mr-2"><i class="fas fa-times"></i> Batal</a>
                            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
