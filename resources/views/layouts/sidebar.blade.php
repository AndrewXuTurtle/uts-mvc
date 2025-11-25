 <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-start" href="{{ route('dashboard') }}">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-code"></i>
                </div>
                <div class="sidebar-brand-text mx-3">TPL</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href={{ route('dashboard') }}>
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Interface
            </div>

            <!-- Nav Item - Dosen -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('dosen.index') }}">
                    <i class="fas fa-fw fa-chalkboard-teacher"></i>
                    <span>Data Dosen</span>
                </a>
            </li>

            <!-- Nav Item - Mahasiswa -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('mahasiswa.index') }}">
                    <i class="fas fa-fw fa-user-graduate"></i>
                    <span>Data Mahasiswa</span>
                </a>
            </li>

            <!-- Nav Item - Project -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('project.index') }}">
                    <i class="fas fa-fw fa-project-diagram"></i>
                    <span>Data Project</span>
                </a>
            </li>

            <!-- Nav Item - Matakuliah -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('matakuliah.index') }}">
                    <i class="fas fa-fw fa-book-open"></i>
                    <span>Data Mata Kuliah</span>
                </a>
            </li>

            <!-- Nav Item - Profil Prodi -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('profil-prodi.index') }}">
                    <i class="fas fa-fw fa-graduation-cap"></i>
                    <span>Profil Prodi</span>
                </a>
            </li>

            <!-- Nav Item - Profil Page -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('profil') }}">
                    <i class="fas fa-fw fa-eye"></i>
                    <span>Lihat Profil</span>
                </a>
            </li>

            <!-- Nav Item - Penelitian -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('penelitian.index') }}">
                    <i class="fas fa-fw fa-microscope"></i>
                    <span>Data Penelitian</span>
                </a>
            </li>

            <!-- Nav Item - PKM -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('pkm.index') }}">
                    <i class="fas fa-fw fa-lightbulb"></i>
                    <span>Data PKM</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Publikasi
            </div>

            <!-- Nav Item - Berita -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('berita.index') }}">
                    <i class="fas fa-fw fa-newspaper"></i>
                    <span>Berita</span>
                </a>
            </li>

            <!-- Nav Item - Pengumuman -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('pengumuman.index') }}">
                    <i class="fas fa-fw fa-bullhorn"></i>
                    <span>Pengumuman</span>
                </a>
            </li>

            <!-- Nav Item - Agenda -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('agenda.index') }}">
                    <i class="fas fa-fw fa-calendar-check"></i>
                    <span>Agenda</span>
                </a>
            </li>

            <!-- Nav Item - Peraturan -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('peraturan.index') }}">
                    <i class="fas fa-fw fa-file-pdf"></i>
                    <span>Peraturan</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Alumni
            </div>

            <!-- Nav Item - Alumni -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('alumni.index') }}">
                    <i class="fas fa-fw fa-user-tie"></i>
                    <span>Data Alumni</span>
                </a>
            </li>

            <!-- Nav Item - Kisah Sukses -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('kisah-sukses.index') }}">
                    <i class="fas fa-fw fa-trophy"></i>
                    <span>Kisah Sukses</span>
                </a>
            </li>

            <!-- Nav Item - Tracer Study -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('tracer-study.index') }}">
                    <i class="fas fa-fw fa-chart-line"></i>
                    <span>Tracer Study</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Pengaturan
            </div>

            <!-- Nav Item - Manajemen User -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('users.index') }}">
                    <i class="fas fa-fw fa-users-cog"></i>
                    <span>Manajemen User</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

        </ul>