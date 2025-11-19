@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Alumni</h1>
        <a href="{{ route('alumni.index') }}" class="btn btn-sm btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Form Edit Alumni</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('alumni.update', $alumni->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label>NIM</label>
                            <input type="text" class="form-control" value="{{ $alumni->nim }}" readonly>
                        </div>

                        <div class="form-group">
                            <label>Nama Mahasiswa</label>
                            <input type="text" class="form-control" value="{{ $alumni->mahasiswa->nama ?? '-' }}" readonly>
                        </div>

                        <div class="form-group">
                            <label for="tahun_lulus">Tahun Lulus <span class="text-danger">*</span></label>
                            <input type="number" class="form-control @error('tahun_lulus') is-invalid @enderror" 
                                   id="tahun_lulus" name="tahun_lulus" value="{{ old('tahun_lulus', $alumni->tahun_lulus) }}" 
                                   min="2000" max="{{ date('Y') + 10 }}" required>
                            @error('tahun_lulus')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-end">
                            <a href="{{ route('alumni.index') }}" class="btn btn-secondary mr-2"><i class="fas fa-times"></i> Batal</a>
                            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
