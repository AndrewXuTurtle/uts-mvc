# UAS MVC - Sistem Informasi Program Studi TPL

## 📋 Daftar Isi
- [Struktur Halaman](#struktur-halaman)
- [API Integration](#api-integration)
- [Fitur CRUD](#fitur-crud)
- [Struktur Database](#struktur-database)
- [Cara Menambah Data](#cara-menambah-data)

---

## 🌐 Struktur Halaman

### 1. **Dashboard** (`/`)
- **Tampilan**: 
  - 4 Stats Cards (Dosen, Mahasiswa, Alumni, Berita)
  - Chart.js Bar Chart (7 kategori data)
  - Latest Berita (3 cards dengan gambar)
  - Recent Activity Feed
  - Upcoming Agenda (5 items)
  - Quick Actions (6 icon buttons)
  - Statistics Progress Bars
- **Data**: Mengambil dari 7 tabel (dosen, mahasiswa, alumni, projects, penelitian, pkm, berita)

### 2. **Data Dosen** (`/dosen`)
- Index: Tabel list dosen dengan search & pagination
- Create: Form tambah dosen + foto + profil akademik
- Edit: Update data dosen
- Show: Detail lengkap dosen + link Google Scholar/SINTA/Scopus
- Delete: Konfirmasi SweetAlert2

### 3. **Data Mahasiswa** (`/mahasiswa`)
- Index: Tab filter (Aktif/Lulus/Cuti/DO/Eligible Alumni)
- Create: Form tambah mahasiswa + foto
- Edit: Update data mahasiswa
- Show: Detail + list PKM yang diikuti
- Convert: Konversi mahasiswa → alumni (untuk eligible)

### 4. **Data Project** (`/project`)
- Index: Filter tahun + search
- Create: Form tambah project dengan cover
- Edit: Update project
- Show: Detail project dengan galeri foto

### 5. **Data Mata Kuliah** (`/matakuliah`)
- CRUD lengkap untuk mata kuliah

### 6. **Profil Prodi** (`/profil-prodi`)
- CRUD profil program studi + logo

### 7. **Publikasi**
- **Berita** (`/berita`): CRUD berita dengan cover image
- **Pengumuman** (`/pengumuman`): CRUD pengumuman
- **Agenda** (`/agenda`): CRUD agenda kegiatan
- **Peraturan** (`/peraturan`): Upload PDF dengan 13 jenis dokumen

### 8. **Alumni**
- **Data Alumni** (`/alumni`): Filter tahun lulus + search
- **Kisah Sukses** (`/kisah-sukses`): Story alumni dengan foto
- **Tracer Study** (`/tracer-study`): Survey alumni (pekerjaan, gaji, penilaian)

### 9. **Penelitian & PKM**
- **Penelitian** (`/penelitian`): Filter status + upload dokumen
- **PKM** (`/pkm`): Multi-mahasiswa per PKM, filter status

### 10. **Manajemen User** (`/users`)
- CRUD user admin dengan role

---

## 🔌 API Integration

### API External yang Digunakan:

#### 1. **API Dosen** (`/api/dosen`)
- **Endpoint**: `GET http://127.0.0.1:8000/api/dosen`
- **Response**: JSON array dosen
- **Field**: id, nidn, nama, email, program_studi, pendidikan_terakhir, jabatan, bidang_keahlian, no_hp, jenis_kelamin, alamat, foto_url, google_scholar_link, sinta_link, scopus_link

#### 2. **API Tracer Study** (`/api/tracer-study`)
- **Endpoint**: `GET http://127.0.0.1:8000/api/tracer-study`
- **Response**: JSON array tracer study
- **Field**: 13 fields (alumni info, pekerjaan, gaji, masa tunggu, kesesuaian, kepuasan, saran)

#### 3. **API Kisah Sukses** (`/api/kisah-sukses`)
- **Endpoint**: `GET http://127.0.0.1:8000/api/kisah-sukses`
- **Response**: JSON array kisah sukses
- **Field**: id, mahasiswa_id, judul, konten, posisi_saat_ini, perusahaan, tahun, foto_url, is_featured

#### 4. **API Kurikulum** (`/api/kurikulum`)
- **Endpoint**: `GET http://127.0.0.1:8000/api/kurikulum`
- **Response**: JSON array kurikulum
- **Field**: 8 fields (kode_mk, nama_mk, sks, semester, jenis, deskripsi, created_at, updated_at)

**Testing dengan cURL:**
```bash
curl http://127.0.0.1:8000/api/dosen
curl http://127.0.0.1:8000/api/tracer-study
curl http://127.0.0.1:8000/api/kisah-sukses
curl http://127.0.0.1:8000/api/kurikulum
```

**Integrasi di Frontend:**
- Semua API mengembalikan JSON dengan foto sebagai URL lengkap
- Tidak ada authentication required
- CORS enabled untuk akses external

---

## ✏️ Fitur CRUD

### 1. **Master Data**
- ✅ Dosen (Create, Read, Update, Delete)
- ✅ Mahasiswa (CRUD + Convert to Alumni)
- ✅ Mata Kuliah (CRUD)
- ✅ Profil Prodi (CRUD + Logo Upload)
- ✅ Project (CRUD + Cover Image + Galeri)

### 2. **Publikasi**
- ✅ Berita (CRUD + Cover Image)
- ✅ Pengumuman (CRUD)
- ✅ Agenda (CRUD dengan filter kategori)
- ✅ Peraturan (CRUD + PDF Upload)

### 3. **Alumni**
- ✅ Data Alumni (CRUD + Filter)
- ✅ Kisah Sukses (CRUD + Featured)
- ✅ Tracer Study (CRUD + Survey Form)

### 4. **Penelitian & PKM**
- ✅ Penelitian (CRUD + Status + Upload Dokumen)
- ✅ PKM (CRUD + Multi Mahasiswa)

### 5. **System**
- ✅ User Management (CRUD + Role)

---

## 🗄️ Struktur Database

### 1. **users** (Authentication)
```
id, name, email, password, remember_token, timestamps
```

### 2. **tbl_dosen** (Data Dosen)
```
id, nidn, nama, email, program_studi, pendidikan_terakhir, jabatan, 
bidang_keahlian, no_hp, jenis_kelamin, alamat, foto,
google_scholar_link, sinta_link, scopus_link, timestamps
```

### 3. **tbl_mahasiswa** (Data Mahasiswa)
```
id, nim, nama, email, no_hp, jenis_kelamin, tempat_lahir, tanggal_lahir,
alamat, angkatan, tahun_masuk, status (Aktif/Lulus/Cuti/DO), foto, timestamps
```

### 4. **alumni** (Data Alumni)
```
id, nim, nama, email, tahun_lulus, ipk, pekerjaan_saat_ini, 
perusahaan, no_hp, alamat, foto, timestamps
```
**Relasi**: Konversi dari `tbl_mahasiswa` yang status Lulus

### 5. **projects** (Project Mahasiswa)
```
project_id, nim (FK→mahasiswa), judul_project, deskripsi, tahun, 
tahun_selesai, url_demo, url_repo, cover_image, status, timestamps
```
**Relasi**: `belongsTo(Mahasiswa::class, 'nim', 'nim')`

### 6. **tbl_mk** (Mata Kuliah)
```
mk_id, kode_mk, nama_mk, sks, semester, jenis (Wajib/Pilihan),
deskripsi, timestamps
```

### 7. **kurikulum** (Kurikulum)
```
id, kode_mk (FK→tbl_mk), nama_mk, sks, semester, jenis, 
deskripsi, timestamps
```

### 8. **berita** (Berita & Artikel)
```
id, judul, konten, kategori, cover, tanggal_publish, 
penulis, is_published, views, timestamps
```

### 9. **pengumuman** (Pengumuman)
```
id, judul, konten, tanggal_mulai, tanggal_selesai, 
prioritas (Tinggi/Sedang/Rendah), is_active, timestamps
```

### 10. **agenda** (Agenda Kegiatan)
```
id, judul, deskripsi, tanggal_mulai, tanggal_selesai, 
lokasi, kategori (Seminar/Workshop/Acara), is_aktif, timestamps
```

### 11. **peraturan** (Dokumen Peraturan)
```
id, judul, deskripsi, kategori (Akademik/Kemahasiswaan/Administratif/Keuangan),
jenis (13 tipe: Kalender Akademik, Panduan Studi, Skripsi, Magang, Tata Tertib, 
      Kode Etik, Kegiatan, SOP, Surat Menyurat, Cuti Kuliah, 
      Biaya Kuliah, Beasiswa, Denda Keterlambatan),
file_path, file_name, file_size, urutan, is_active, timestamps
```

### 12. **penelitian** (Penelitian Dosen)
```
id, dosen_id (FK→dosen), judul, jenis (Mandiri/Kelompok/Hibah),
tahun, sumber_dana, nominal_dana, status (Proposal/Berjalan/Selesai),
deskripsi, file_proposal, file_laporan, timestamps
```
**Relasi**: `belongsTo(Dosen::class)`

### 13. **pkm** (Program Kreativitas Mahasiswa)
```
id, judul, jenis_pkm (5 tipe), tahun, dana_disetujui, 
status (Draft/Diajukan/Diterima/Ditolak/Selesai), 
deskripsi, file_proposal, timestamps
```

### 14. **pkm_mahasiswa** (Pivot: PKM ↔ Mahasiswa)
```
id, pkm_id (FK→pkm), mahasiswa_id (FK→mahasiswa), 
role (Ketua/Anggota), timestamps
```
**Relasi**: Many-to-Many antara PKM dan Mahasiswa

### 15. **kisah_sukses** (Success Story Alumni)
```
id, mahasiswa_id (FK→mahasiswa), judul, konten, 
posisi_saat_ini, perusahaan, tahun, foto, is_featured, timestamps
```

### 16. **tracer_study** (Survey Alumni)
```
id, alumni_id (FK→alumni), tahun_survey, status_pekerjaan,
nama_perusahaan, posisi, gaji, masa_tunggu_kerja,
kesesuaian_bidang, kepuasan_kerja (1-5), kepuasan_pendidikan (1-5),
saran_kurikulum, saran_fasilitas, timestamps
```

### 17. **profil_prodi** (Profil Program Studi)
```
id, nama_prodi, akreditasi, visi, misi, tujuan, 
kontak_email, kontak_telp, alamat, website, logo, timestamps
```

---

## 🔗 Relasi Database

```
users (1) ───────────────────────────── (Admin System)

tbl_dosen (1) ──< (N) penelitian
              └──< (N) tbl_mk (dosen_pengampu - optional)

tbl_mahasiswa (1) ──< (N) projects
                  ├──< (N) pkm_mahasiswa ──< pkm
                  ├──< (1) kisah_sukses
                  └──> (1) alumni (conversion)

alumni (1) ──< (N) tracer_study

tbl_mk (1) ──< (N) kurikulum

pkm (1) ──< (N) pkm_mahasiswa ──< (N) tbl_mahasiswa

profil_prodi (1) ────────────────────── (Singleton)

berita, pengumuman, agenda, peraturan ─── (Independent Tables)
```

### Penjelasan Relasi:
1. **Dosen → Penelitian**: One-to-Many (1 dosen bisa punya banyak penelitian)
2. **Mahasiswa → Project**: One-to-Many (1 mahasiswa bisa punya banyak project)
3. **Mahasiswa → PKM**: Many-to-Many via `pkm_mahasiswa` (1 mahasiswa bisa ikut banyak PKM, 1 PKM punya banyak mahasiswa)
4. **Mahasiswa → Alumni**: One-to-One Conversion (mahasiswa status Lulus dikonversi jadi alumni)
5. **Alumni → Tracer Study**: One-to-Many (1 alumni bisa disurvey berkali-kali)
6. **Mata Kuliah → Kurikulum**: One-to-Many (1 MK bisa ada di beberapa kurikulum/semester)

---

## ➕ Cara Menambah Data

### 1. **Menambah Dosen**
```
1. Login sebagai admin
2. Sidebar → Data Dosen → Tambah Dosen
3. Isi form:
   - NIDN (wajib)
   - Nama Lengkap (wajib)
   - Email (wajib)
   - Pendidikan Terakhir (S1/S2/S3)
   - Jabatan (wajib)
   - Bidang Keahlian
   - No HP
   - Jenis Kelamin
   - Alamat
   - Google Scholar Link (opsional)
   - SINTA Link (opsional)
   - Scopus Link (opsional)
   - Upload Foto
4. Klik "Simpan Data"
```

### 2. **Menambah Mahasiswa**
```
1. Sidebar → Data Mahasiswa → Tambah Mahasiswa
2. Isi form lengkap (NIM, Nama, Email, dll)
3. Upload foto mahasiswa
4. Klik "Simpan Data"
```

### 3. **Menambah Project**
```
1. Sidebar → Data Project → Tambah Project
2. Pilih mahasiswa dari dropdown
3. Isi judul, deskripsi, tahun
4. Upload cover image project
5. Isi URL demo dan repository (opsional)
6. Klik "Simpan"
```

### 4. **Menambah PKM**
```
1. Sidebar → Data PKM → Tambah PKM
2. Isi judul dan jenis PKM
3. Pilih mahasiswa peserta (bisa multiple):
   - Centang checkbox mahasiswa
   - Pilih role (Ketua/Anggota)
4. Isi dana, status, deskripsi
5. Upload proposal PDF
6. Klik "Simpan"
```

### 5. **Konversi Mahasiswa → Alumni**
```
1. Sidebar → Data Mahasiswa
2. Tab "Eligible untuk Alumni"
   (Otomatis muncul mahasiswa angkatan >= 4 tahun lalu & status Aktif)
3. Klik icon graduation cap (🎓)
4. Konfirmasi konversi
5. Data otomatis pindah ke tabel alumni
```

### 6. **Menambah Berita**
```
1. Sidebar → Publikasi → Berita → Tambah Berita
2. Isi judul, konten (WYSIWYG editor)
3. Pilih kategori
4. Upload cover image
5. Set tanggal publish
6. Toggle "Publish" jika ingin langsung tampil
7. Klik "Simpan"
```

### 7. **Upload Peraturan/Dokumen**
```
1. Sidebar → Publikasi → Peraturan → Tambah Peraturan
2. Isi judul dan deskripsi
3. Pilih kategori (Akademik/Kemahasiswaan/Administratif/Keuangan)
4. Pilih jenis dokumen (13 pilihan):
   - Kalender Akademik
   - Panduan Studi
   - Skripsi
   - Magang
   - Tata Tertib
   - Kode Etik
   - Kegiatan
   - SOP
   - Surat Menyurat
   - Cuti Kuliah
   - Biaya Kuliah
   - Beasiswa
   - Denda Keterlambatan
5. Upload file PDF (max 10MB)
6. Set urutan tampil
7. Klik "Simpan"
```

### 8. **Menambah Tracer Study**
```
1. Sidebar → Alumni → Tracer Study → Tambah Tracer Study
2. Pilih alumni dari dropdown
3. Isi form survey:
   - Status pekerjaan
   - Nama perusahaan & posisi
   - Gaji (range)
   - Masa tunggu kerja (bulan)
   - Kesesuaian bidang (Ya/Tidak)
   - Rating kepuasan (1-5)
   - Saran untuk kurikulum & fasilitas
4. Klik "Simpan"
```

### 9. **Menambah User Admin**
```
1. Sidebar → Pengaturan → Manajemen User → Tambah User
2. Isi nama, email, password
3. Pilih role (Admin/Super Admin)
4. Klik "Simpan"
```

---

## 🎨 UI Features

### Modern Design Elements:
- ✅ Glassmorphism login page
- ✅ Gradient sidebar (purple theme)
- ✅ Animated stats cards with hover effects
- ✅ Chart.js interactive bar chart
- ✅ SweetAlert2 untuk delete confirmation
- ✅ Dropdown dengan hover gradient
- ✅ Action buttons dengan smooth animations
- ✅ Responsive table dengan hover effects
- ✅ Toast notifications untuk success/error

### Delete Confirmation:
Semua halaman menggunakan **SweetAlert2** dengan animasi cantik:
- Warning popup dengan icon
- Confirm button gradient merah
- Loading state saat proses delete
- Success toast notification

---

## 📦 Tech Stack

- **Backend**: Laravel 12.x
- **Frontend**: Blade Templates + Bootstrap (SB Admin 2)
- **Database**: MySQL (SQLite untuk development)
- **Charts**: Chart.js 3.9.1
- **Notifications**: SweetAlert2
- **Icons**: Font Awesome 5
- **Fonts**: Nunito (dashboard), Inter (login)

---

## 🚀 Setup & Installation

```bash
# Clone repository
git clone https://github.com/AndrewXuTurtle/uts-mvc.git
cd uts-mvc

# Install dependencies
composer install
npm install

# Setup environment
cp .env.example .env
php artisan key:generate

# Run migrations
php artisan migrate

# Seed database (optional)
php artisan db:seed

# Storage link
php artisan storage:link

# Run server
php artisan serve
```

**Default Login:**
- Email: admin@example.com
- Password: password

---

## 📝 Notes

- Semua upload file (foto, PDF) disimpan di `storage/app/public/`
- Image optimization otomatis untuk cover image
- Pagination default: 10 items per page
- Soft delete tidak digunakan, hard delete langsung
- View cache di-clear otomatis setiap update
- API tidak memerlukan authentication
- CORS sudah enabled untuk external access

---

**Dibuat untuk**: UAS Mata Kuliah MVC  
**Program Studi**: Teknik Perangkat Lunak  
**Tahun**: 2025
