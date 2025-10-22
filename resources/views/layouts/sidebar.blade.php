 <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-start" href="index.html">
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

            <!-- Nav Item - Kegiatan -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('kegiatan.index') }}">
                    <i class="fas fa-fw fa-calendar-alt"></i>
                    <span>Data Kegiatan</span>
                </a>
            </li>

            <!-- Nav Item - Galeri -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('galeri.index') }}">
                    <i class="fas fa-fw fa-images"></i>
                    <span>Galeri Kegiatan</span>
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

            <!-- Divider -->
            <hr class="sidebar-divider">

        </ul>