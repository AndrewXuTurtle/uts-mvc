@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800" id="page-title">Profil Program Studi</h1>
    </div>

    <!-- Profile Content -->
    <div class="row">
        <div class="col-lg-8">
            <!-- Profile Card -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Informasi Program Studi</h6>
                </div>
                <div class="card-body" id="profile-content">
                    <!-- Loading spinner -->
                    <div class="text-center" id="loading">
                        <div class="spinner-border text-primary" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                        <p class="mt-2">Memuat data profil...</p>
                    </div>

                    <!-- Profile content will be loaded here -->
                    <div id="profile-data" style="display: none;">
                        <div class="row">
                            <div class="col-md-3">
                                <img id="logo" src="" alt="Logo Program Studi" class="img-fluid rounded mb-3" style="max-width: 150px;">
                            </div>
                            <div class="col-md-9">
                                <h4 id="nama-prodi" class="text-primary"></h4>
                                <p class="text-muted mb-3">
                                    <i class="fas fa-award"></i>
                                    Akreditasi: <span id="akreditasi" class="badge badge-success"></span>
                                </p>
                            </div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-md-6">
                                <h5><i class="fas fa-eye"></i> Visi</h5>
                                <p id="visi"></p>
                            </div>
                            <div class="col-md-6">
                                <h5><i class="fas fa-bullseye"></i> Misi</h5>
                                <p id="misi"></p>
                            </div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-12">
                                <h5><i class="fas fa-info-circle"></i> Deskripsi</h5>
                                <p id="deskripsi"></p>
                            </div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-md-6">
                                <h5><i class="fas fa-envelope"></i> Kontak</h5>
                                <p>
                                    <strong>Email:</strong> <span id="kontak-email"></span><br>
                                    <strong>Telepon:</strong> <span id="kontak-telepon"></span>
                                </p>
                            </div>
                            <div class="col-md-6">
                                <h5><i class="fas fa-map-marker-alt"></i> Alamat</h5>
                                <p id="alamat"></p>
                            </div>
                        </div>
                    </div>

                    <!-- Error message -->
                    <div id="error-message" style="display: none;" class="alert alert-danger">
                        <i class="fas fa-exclamation-triangle"></i>
                        Gagal memuat data profil. Silakan coba lagi nanti.
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <!-- Quick Actions -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Aksi Cepat</h6>
                </div>
                <div class="card-body">
                    <a href="{{ route('profil-prodi.index') }}" class="btn btn-primary btn-block mb-2">
                        <i class="fas fa-edit"></i> Kelola Profil
                    </a>
                    <a href="{{ route('dashboard') }}" class="btn btn-secondary btn-block">
                        <i class="fas fa-tachometer-alt"></i> Kembali ke Dashboard
                    </a>
                </div>
            </div>

            <!-- Statistics Card -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Statistik</h6>
                </div>
                <div class="card-body">
                    <div class="text-center">
                        <div class="h5 mb-0 font-weight-bold text-gray-800" id="stats-count">1</div>
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Program Studi</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    fetchProfileData();
});

function fetchProfileData() {
    fetch('/api/profil-prodi', {
        method: 'GET',
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        }
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        if (data && data.length > 0) {
            displayProfileData(data[0]); // Display first profile
            updateStats(data.length);
        } else {
            showError();
        }
    })
    .catch(error => {
        console.error('Error fetching profile data:', error);
        showError();
    });
}

function displayProfileData(profile) {
    // Hide loading
    document.getElementById('loading').style.display = 'none';

    // Show profile data
    document.getElementById('profile-data').style.display = 'block';

    // Update page title
    document.getElementById('page-title').textContent = `Profil ${profile.nama_prodi}`;

    // Update profile information
    document.getElementById('nama-prodi').textContent = profile.nama_prodi;
    document.getElementById('visi').textContent = profile.visi;
    document.getElementById('misi').textContent = profile.misi.replace(/\\n/g, '\n');
    document.getElementById('deskripsi').textContent = profile.deskripsi;
    document.getElementById('akreditasi').textContent = profile.akreditasi;

    // Update contact information
    document.getElementById('kontak-email').textContent = profile.kontak_email;
    document.getElementById('kontak-telepon').textContent = profile.kontak_telepon;
    document.getElementById('alamat').textContent = profile.alamat.replace(/\\n/g, '\n');

    // Update logo if available
    if (profile.logo_url) {
        document.getElementById('logo').src = profile.logo_url;
        document.getElementById('logo').style.display = 'block';
    } else {
        document.getElementById('logo').style.display = 'none';
    }

    // Update accreditation badge color
    const akreditasiBadge = document.getElementById('akreditasi');
    akreditasiBadge.className = 'badge';
    if (profile.akreditasi === 'A') {
        akreditasiBadge.classList.add('badge-success');
    } else if (profile.akreditasi === 'B') {
        akreditasiBadge.classList.add('badge-warning');
    } else {
        akreditasiBadge.classList.add('badge-secondary');
    }
}

function updateStats(count) {
    document.getElementById('stats-count').textContent = count;
}

function showError() {
    document.getElementById('loading').style.display = 'none';
    document.getElementById('error-message').style.display = 'block';
}
</script>
@endsection