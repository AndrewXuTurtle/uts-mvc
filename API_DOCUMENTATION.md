# API Documentation - UTS MVC

Base URL: `http://localhost:8000/api`

## Quick Start - Testing API dengan curl

Sebelum mengintegrasikan ke frontend, Anda dapat test semua endpoint menggunakan curl di terminal:

### Test Basic Endpoints

```bash
# 1. Test API Dosen - Get all dosen
curl http://localhost:8000/api/dosen

# 2. Test API Mahasiswa - Get all mahasiswa
curl http://localhost:8000/api/mahasiswa

# 3. Test API Project - Get all projects
curl http://localhost:8000/api/project

# 4. Test API Berita - Get all berita
curl http://localhost:8000/api/berita

# 5. Test API Peraturan - Get peraturan grouped by kategori
curl http://localhost:8000/api/peraturan

# 6. Test API Profil Prodi - Get program study profile
curl http://localhost:8000/api/profil-prodi

# 7. Test API Agenda - Get upcoming agenda
curl "http://localhost:8000/api/agenda?upcoming=true&aktif=true"

# 8. Test API Penelitian - Get all penelitian
curl http://localhost:8000/api/penelitian

# 9. Test API PKM - Get all PKM
curl http://localhost:8000/api/pkm

# 10. Test API Tracer Study Statistics
curl http://localhost:8000/api/tracer-study-statistics

# 11. Test API Alumni - Get all alumni
curl http://localhost:8000/api/alumni

# 12. Test API Alumni Statistics
curl http://localhost:8000/api/alumni-statistics

# 13. Test API Galeri - Get all gallery
curl http://localhost:8000/api/galeri

# 14. Test API Prestasi - Get all achievements
curl http://localhost:8000/api/prestasi

# 15. Test API Kisah Sukses - Get success stories
curl http://localhost:8000/api/kisah-sukses
```

### Test dengan Query Parameters

```bash
# Search dosen by name
curl "http://localhost:8000/api/dosen?search=Ahmad"

# Filter mahasiswa by status
curl "http://localhost:8000/api/mahasiswa?status=Aktif"

# Filter project by tahun
curl "http://localhost:8000/api/project?tahun=2024"

# Filter berita by kategori
curl "http://localhost:8000/api/berita?kategori=Event"

# Filter peraturan by kategori
curl "http://localhost:8000/api/peraturan-kategori/Akademik"

# Filter prestasi by tingkat
curl "http://localhost:8000/api/prestasi?tingkat=Nasional"

# Filter PKM by jenis
curl "http://localhost:8000/api/pkm?jenis_pkm=PKM-KC"

# Filter penelitian by status
curl "http://localhost:8000/api/penelitian?status=Sedang%20Berjalan"

# Get PKM by dosen
curl http://localhost:8000/api/pkm-dosen/1

# Get PKM by mahasiswa
curl http://localhost:8000/api/pkm-mahasiswa/1

# Get penelitian by dosen
curl http://localhost:8000/api/penelitian-dosen/1

# Get galeri by kategori
curl http://localhost:8000/api/galeri-kategori/akademik

# Get kisah sukses featured
curl http://localhost:8000/api/kisah-sukses-featured
```

### Test dengan Pretty JSON Output

```bash
# Menggunakan jq untuk format JSON yang lebih readable
curl http://localhost:8000/api/dosen | jq

# Atau menggunakan python
curl http://localhost:8000/api/mahasiswa | python -m json.tool

# Melihat hanya field tertentu
curl http://localhost:8000/api/dosen | jq '.[0] | {nama, email, jabatan}'
```

### Test Detail Endpoint

```bash
# Get single dosen by ID
curl http://localhost:8000/api/dosen/1

# Get single mahasiswa by ID
curl http://localhost:8000/api/mahasiswa/1

# Get single project by ID
curl http://localhost:8000/api/project/1

# Get single berita by ID
curl http://localhost:8000/api/berita/1

# Get single peraturan by ID
curl http://localhost:8000/api/peraturan/1
```

### Test Headers dan Response Time

```bash
# Melihat response headers
curl -I http://localhost:8000/api/dosen

# Melihat response time
curl -w "\nTime: %{time_total}s\n" http://localhost:8000/api/dosen

# Verbose output untuk debugging
curl -v http://localhost:8000/api/mahasiswa
```

### Expected Response Format

Semua API endpoint mengembalikan JSON dengan format standar:

**Success Response:**
```json
{
  "success": true,
  "data": [...]
}
```

**Error Response:**
```json
{
  "success": false,
  "message": "Error message here"
}
```

### Testing Checklist

Sebelum integrasi frontend, pastikan semua endpoint berikut berfungsi:

**Core Resources:**
- [ ] ✅ `GET /api/dosen` - Returns array of dosen with academic links
- [ ] ✅ `GET /api/mahasiswa` - Returns array of mahasiswa
- [ ] ✅ `GET /api/alumni` - Returns array of alumni data
- [ ] ✅ `GET /api/project` - Returns projects with mahasiswa relationship
- [ ] ✅ `GET /api/matakuliah` - Returns mata kuliah list
- [ ] ✅ `GET /api/profil-prodi` - Returns single prodi profile

**Content Management:**
- [ ] ✅ `GET /api/berita` - Returns news articles
- [ ] ✅ `GET /api/pengumuman` - Returns active announcements
- [ ] ✅ `GET /api/agenda` - Returns event agenda
- [ ] ✅ `GET /api/galeri` - Returns gallery photos
- [ ] ✅ `GET /api/galeri-kategori/{kategori}` - Returns gallery by category
- [ ] ✅ `GET /api/peraturan` - Returns regulations grouped by kategori
- [ ] ✅ `GET /api/peraturan-kategori/{kategori}` - Returns peraturan by category

**Research & Projects:**
- [ ] ✅ `GET /api/penelitian` - Returns research data with dosen
- [ ] ✅ `GET /api/penelitian-dosen/{dosenId}` - Returns penelitian by dosen
- [ ] ✅ `GET /api/penelitian-statistics` - Returns penelitian statistics
- [ ] ✅ `GET /api/pkm` - Returns PKM data with relationships
- [ ] ✅ `GET /api/pkm-dosen/{dosenId}` - Returns PKM by dosen
- [ ] ✅ `GET /api/pkm-mahasiswa/{mahasiswaId}` - Returns PKM by mahasiswa
- [ ] ✅ `GET /api/pkm-statistics` - Returns PKM statistics

**Alumni & Achievements:**
- [ ] ✅ `GET /api/alumni-statistics` - Returns alumni statistics
- [ ] ✅ `GET /api/kisah-sukses` - Returns success stories
- [ ] ✅ `GET /api/kisah-sukses-featured` - Returns featured stories
- [ ] ✅ `GET /api/kisah-sukses-statistics` - Returns kisah sukses stats
- [ ] ✅ `GET /api/tracer-study` - Returns tracer study responses
- [ ] ✅ `GET /api/tracer-study-statistics` - Returns employment stats
- [ ] ✅ `GET /api/tracer-study-testimonials` - Returns testimonials
- [ ] ✅ `GET /api/prestasi` - Returns student achievements
- [ ] ✅ `GET /api/prestasi/statistics` - Returns achievement statistics

---

## Table of Contents
- [Quick Start - Testing API](#quick-start---testing-api-dengan-curl)
- [Authentication](#authentication)
- [Dosen](#dosen)
- [Mahasiswa](#mahasiswa)
- [Alumni](#alumni)
- [Projects](#projects)
- [Matakuliah](#matakuliah)
- [Profil Prodi](#profil-prodi)
- [Berita](#berita-api)
- [Pengumuman](#pengumuman)
- [Agenda](#agenda)
- [Galeri](#galeri)
- [Penelitian](#penelitian)
- [PKM](#pkm)
- [Kisah Sukses](#kisah-sukses)
- [Tracer Study](#tracer-study)
- [Prestasi](#prestasi)
- [Peraturan](#peraturan)
- [Error Responses](#error-responses)
- [CORS Configuration](#cors-configuration)
- [Frontend Integration Examples](#frontend-integration-examples)

---

## Authentication

Most endpoints are public and don't require authentication. Admin endpoints (POST, PUT, DELETE) require authentication via session cookies.

---

## Dosen

### GET /api/dosen
Get list of all dosen (lecturers) with academic profiles.

**Query Parameters:**
- `search` (string): Search by nama or NIDN
- `status` (string): Filter by status (Aktif, Cuti, Pensiun)

**Response:**
```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "nidn": "0015100101",
      "nama": "Dr. Ahmad Surya, S.Kom., M.Kom.",
      "email": "ahmad.surya@tpl.ac.id",
      "no_hp": "081234567801",
      "jenis_kelamin": "Laki-laki",
      "jabatan": "Lektor Kepala",
      "pendidikan_terakhir": "S3 Ilmu Komputer",
      "bidang_keahlian": "Software Engineering, Web Development",
      "alamat": "Jl. Merdeka No. 15, Jakarta",
      "foto": null,
      "foto_url": null,
      "google_scholar_link": "https://scholar.google.com/citations?user=AhmadSurya123",
      "sinta_link": "https://sinta.kemdikbud.go.id/authors/profile/6001234",
      "scopus_link": "https://www.scopus.com/authid/detail.uri?authorId=57123456789",
      "prodi": "Teknik Perangkat Lunak",
      "status": "Aktif",
      "created_at": "2025-11-11T12:55:08.000000Z",
      "updated_at": "2025-11-11T13:52:41.000000Z"
    }
  ]
}
```

### GET /api/dosen/{id}
Get single dosen detail including research profile links (Google Scholar, SINTA, Scopus).

**Response:**
```json
{
  "success": true,
  "data": {
    "id": 1,
    "nidn": "0015100101",
    "nama": "Dr. Ahmad Surya, S.Kom., M.Kom.",
    "email": "ahmad.surya@tpl.ac.id",
    "no_hp": "081234567801",
    "jenis_kelamin": "Laki-laki",
    "jabatan": "Lektor Kepala",
    "pendidikan_terakhir": "S3 Ilmu Komputer",
    "bidang_keahlian": "Software Engineering, Web Development",
    "alamat": "Jl. Merdeka No. 15, Jakarta",
    "foto": null,
    "foto_url": null,
    "google_scholar_link": "https://scholar.google.com/citations?user=AhmadSurya123",
    "sinta_link": "https://sinta.kemdikbud.go.id/authors/profile/6001234",
    "scopus_link": "https://www.scopus.com/authid/detail.uri?authorId=57123456789",
    "prodi": "Teknik Perangkat Lunak",
    "status": "Aktif",
    "created_at": "2025-11-11T12:55:08.000000Z",
    "updated_at": "2025-11-11T13:52:41.000000Z"
  }
}
```

**Academic Profile Fields:**
- `google_scholar_link`: Link to dosen's Google Scholar profile (nullable)
- `sinta_link`: Link to dosen's SINTA (Science and Technology Index) profile (nullable)
- `scopus_link`: Link to dosen's Scopus author profile (nullable)

---

## Mahasiswa

### GET /api/mahasiswa
Get list of all mahasiswa.

**Query Parameters:**
- `search` (string): Search by nama or NIM
- `status` (string): Filter by status (Aktif, Lulus, Cuti, DO)
- `tahun_masuk` (integer): Filter by tahun masuk
- `kelas` (string): Filter by kelas

**Response:**
```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "nim": "20200001",
      "nama": "Ahmad Rahman",
      "email": "ahmad.rahman@student.tpl.ac.id",
      "no_hp": "081234560001",
      "jenis_kelamin": "Laki-laki",
      "alamat": "Jl. Kebon Jeruk No. 12, Jakarta Barat",
      "tempat_lahir": "Jakarta",
      "tanggal_lahir": "2002-05-15",
      "tahun_masuk": 2020,
      "tahun_lulus": 2024,
      "kelas": "TPL-A",
      "status": "Lulus",
      "prodi": "Teknik Perangkat Lunak",
      "foto": null,
      "created_at": "2025-11-11T10:00:00.000000Z",
      "updated_at": "2025-11-11T10:00:00.000000Z"
    }
  ]
}
```

### GET /api/mahasiswa/{id}
Get single mahasiswa detail.

---

## Alumni

### GET /api/alumni
Get list of all alumni.

**Query Parameters:**
- `search` (string): Search by nama or NIM
- `pekerjaan_saat_ini` (string): Filter by pekerjaan (Bekerja, Melanjutkan Studi, Wirausaha, Belum Bekerja)

**Response:**
```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "nim": "20200001",
      "nama": "Ahmad Rahman",
      "email": "ahmad.rahman@student.tpl.ac.id",
      "pekerjaan_saat_ini": "Bekerja",
      "nama_perusahaan": "PT. Tech Indonesia",
      "posisi_jabatan": "Software Engineer",
      "gaji_pertama": 6000000,
      "gaji_saat_ini": 8500000,
      "linkedin": "https://linkedin.com/in/ahmad-rahman",
      "instagram": "@ahmadrhmn",
      "pesan_alumni": "Belajar TPL sangat membantu karir saya!",
      "created_at": "2025-11-11T10:00:00.000000Z"
    }
  ]
}
```

### GET /api/alumni-statistics
Get alumni statistics (employment rate, average salary, etc.)

---

## Projects

### GET /api/project
Get list of all projects.

**Query Parameters:**
- `search` (string): Search by judul or deskripsi
- `tahun` (integer): Filter by year
- `kategori` (string): Filter by kategori
- `status` (string): Filter by status (Draft, Published)

**Response:**
```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "nim": "20200001",
      "mahasiswa": {
        "nim": "20200001",
        "nama": "Ahmad Rahman"
      },
      "judul_project": "E-Commerce Platform dengan Laravel",
      "deskripsi": "Platform e-commerce lengkap...",
      "tahun": 2024,
      "tahun_selesai": 2024,
      "kategori": "Web Application",
      "teknologi": "Laravel, Vue.js, MySQL, Midtrans",
      "dosen_pembimbing": "Dr. Rina Wati, M.Kom",
      "link_github": "https://github.com/ahmad/ecommerce-laravel",
      "link_demo": null,
      "status": "Published",
      "foto_utama": null,
      "galeri": [],
      "created_at": "2025-11-11T10:00:00.000000Z"
    }
  ]
}
```

### GET /api/project/{id}
Get single project detail with full gallery.

---

## Matakuliah

### GET /api/matakuliah
Get list of all mata kuliah.

**Query Parameters:**
- `search` (string): Search by kode or nama
- `semester` (integer): Filter by semester
- `status_wajib` (boolean): Filter by wajib/pilihan

**Response:**
```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "kode_mk": "TPL101",
      "nama_mk": "Dasar Pemrograman",
      "sks": 4,
      "semester": 1,
      "kurikulum_tahun": 2024,
      "status_wajib": true,
      "created_at": "2025-11-11T10:00:00.000000Z"
    }
  ]
}
```

---

## Profil Prodi

### GET /api/profil-prodi
Get program study profile (only 1 record).

**Response:**
```json
{
  "success": true,
  "data": {
    "id": 1,
    "nama_prodi": "Teknik Perangkat Lunak",
    "visi": "Menjadi Program Studi Teknik Perangkat Lunak...",
    "misi": "1. Menyelenggarakan pendidikan tinggi...",
    "deskripsi": "Program Studi Teknik Perangkat Lunak (TPL)...",
    "akreditasi": "A (Unggul)",
    "logo": "logo-tpl.png",
    "kontak_email": "tpl@university.ac.id",
    "kontak_telepon": "+62 21 1234 5678",
    "alamat": "Gedung Fakultas Teknik...",
    "created_at": "2025-11-11T10:00:00.000000Z"
  }
}
```

---

## Berita API

### GET /api/berita
Get list of all berita (news).

**Query Parameters:**
- `search` (string): Search by judul or konten
- `is_prestasi` (boolean): Filter prestasi news
- `kategori` (string): Filter by kategori

**Response:**
```json
{
  "success": true,
  "data": {
    "current_page": 1,
    "data": [
      {
        "id": 1,
        "judul": "Seminar Nasional Teknologi Informasi 2025",
        "slug": "seminar-nasional-teknologi-informasi-2025",
        "konten": "Program Studi TPL akan menyelenggarakan...",
        "gambar": "berita/seminar-ti-2025.jpg",
        "gambar_url": "http://localhost:8000/storage/berita/seminar-ti-2025.jpg",
        "penulis": "Admin TPL",
        "tanggal_publish": "2025-11-01",
        "kategori": "Event",
        "is_prestasi": false,
        "views": 150,
        "created_at": "2025-11-11T10:00:00.000000Z"
      }
    ],
    "per_page": 10,
    "total": 5
  }
}
```

### GET /api/berita/{id}
Get single berita detail.

---

## Pengumuman

### GET /api/pengumuman
Get list of pengumuman (announcements).

**Query Parameters:**
- `prioritas` (string): Filter by prioritas (tinggi, sedang, rendah)
- `aktif` (boolean): Filter active only

**Response:**
```json
{
  "success": true,
  "data": {
    "current_page": 1,
    "data": [
      {
        "id": 1,
        "judul": "Pendaftaran Tugas Akhir Semester Ganjil 2025/2026",
        "isi": "Pendaftaran Tugas Akhir untuk semester ganjil...",
        "gambar": "pengumuman/pendaftaran-ta.jpg",
        "gambar_url": "http://localhost:8000/storage/pengumuman/pendaftaran-ta.jpg",
        "penulis": "Koordinator TA",
        "tanggal_mulai": "2025-11-01",
        "tanggal_selesai": "2025-11-15",
        "prioritas": "tinggi",
        "aktif": true,
        "created_at": "2025-11-11T10:00:00.000000Z"
      }
    ],
    "per_page": 10,
    "total": 3
  }
}
```

---

## Agenda

### GET /api/agenda
Get list of upcoming agenda/events.

**Query Parameters:**
- `kategori` (string): Filter by kategori (seminar, workshop, acara)
- `upcoming` (boolean): Only upcoming events
- `month` (integer): Filter by month
- `year` (integer): Filter by year

**Response:**
```json
{
  "success": true,
  "data": {
    "current_page": 1,
    "data": [
      {
        "id": 1,
        "judul": "Seminar Nasional TI 2025",
        "deskripsi": "Seminar nasional dengan tema...",
        "tanggal_mulai": "2025-11-15 09:00:00",
        "tanggal_selesai": "2025-11-16 17:00:00",
        "lokasi": "Auditorium Kampus",
        "kategori": "seminar",
        "penyelenggara": "Prodi TPL",
        "kontak": "08123456789",
        "poster": "agenda/seminar-nasional-ti.jpg",
        "gambar_url": "http://localhost:8000/storage/agenda/seminar-nasional-ti.jpg",
        "aktif": true,
        "created_at": "2025-11-11T10:00:00.000000Z"
      }
    ],
    "per_page": 10,
    "total": 5
  }
}
```

---

## Galeri

### GET /api/galeri
Get list of all gallery photos.

**Query Parameters:**
- `kategori` (string): Filter by kategori (akademik, kemahasiswaan, kegiatan, prestasi, fasilitas)
- `tampilkan_di_home` (boolean): Filter featured only

**Response:**
```json
{
  "success": true,
  "data": {
    "current_page": 1,
    "data": [
      {
        "id": 1,
        "judul": "Wisuda Angkatan 2024",
        "deskripsi": "Wisuda mahasiswa angkatan 2024...",
        "foto": "galeri/wisuda-2024.jpg",
        "foto_url": "http://localhost:8000/storage/galeri/wisuda-2024.jpg",
        "kategori": "akademik",
        "tanggal_kegiatan": "2024-10-15",
        "fotografer": "Tim Dokumentasi TPL",
        "tampilkan_di_home": true,
        "urutan": 1,
        "created_at": "2025-11-11T10:00:00.000000Z"
      }
    ],
    "per_page": 12,
    "total": 10
  }
}
```

### GET /api/galeri-kategori/{kategori}
Get gallery photos by specific kategori.

---

## Penelitian

### GET /api/penelitian
Get list of all penelitian (research).

**Query Parameters:**
- `search` (string): Search by judul_penelitian
- `tahun` (integer): Filter by year
- `status` (string): Filter by status
- `jenis_penelitian` (string): Filter by jenis
- `ketua_peneliti_id` (integer): Filter by ketua peneliti (dosen ID)

**Response:**
```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "judul_penelitian": "Pengembangan Sistem Informasi Akademik...",
      "deskripsi": "Penelitian ini bertujuan untuk...",
      "tahun": 2024,
      "jenis_penelitian": "Hibah",
      "sumber_dana": "DIKTI",
      "dana": 50000000,
      "status": "Sedang Berjalan",
      "tanggal_mulai": "2024-01-15",
      "tanggal_selesai": null,
      "output": "Jurnal Nasional",
      "file_dokumen": "penelitian/proposal-2024.pdf",
      "ketua_peneliti_id": 1,
      "ketua_peneliti": {
        "id": 1,
        "nama": "Dr. Ahmad Surya, S.Kom., M.Kom.",
        "nidn": "0015100101"
      },
      "created_at": "2025-11-11T10:00:00.000000Z"
    }
  ]
}
```

**Note:** Field `judul_penelitian` digunakan (bukan `judul`), `dana` (bukan `jumlah_dana`), dan `ketua_peneliti_id` (bukan `dosen_id`).

### GET /api/penelitian-dosen/{dosenId}
Get penelitian by specific dosen (ketua peneliti).

**Example:** `/api/penelitian-dosen/1`

**Response:**
```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "judul_penelitian": "Pengembangan Sistem Informasi Akademik...",
      "tahun": 2024,
      "status": "Sedang Berjalan",
      "dana": 50000000,
      "ketua_peneliti": {
        "id": 1,
        "nama": "Dr. Ahmad Surya, S.Kom., M.Kom."
      }
    }
  ]
}
```

### GET /api/penelitian-statistics
Get penelitian statistics (total, by jenis, by status, by year, total funding).

**Response:**
```json
{
  "success": true,
  "data": {
    "total": 45,
    "by_jenis": {
      "Hibah": 20,
      "Mandiri": 15,
      "Kolaborasi": 10
    },
    "by_status": {
      "Sedang Berjalan": 15,
      "Selesai": 25,
      "Diajukan": 5
    },
    "by_year": {
      "2024": 15,
      "2023": 18,
      "2022": 12
    },
    "total_dana": 2250000000
  }
}
```

---

## PKM

### GET /api/pkm
Get list of all PKM (Program Kreativitas Mahasiswa).

**Query Parameters:**
- `search` (string): Search by judul_pkm
- `tahun` (integer): Filter by year
- `jenis_pkm` (string): Filter by jenis (PKM-KC, PKM-K, PKM-M, PKM-T, PKM-R)
- `status` (string): Filter by status (Didanai, Diajukan, Selesai)
- `dosen_pembimbing_id` (integer): Filter by dosen pembimbing ID

**Response:**
```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "judul_pkm": "Pengembangan Aplikasi Mobile untuk Deteksi Penyakit Tanaman",
      "deskripsi": "PKM ini bertujuan untuk mengembangkan aplikasi mobile berbasis AI...",
      "tahun": 2024,
      "jenis_pkm": "PKM-KC",
      "status": "Didanai",
      "dana": 15000000,
      "pencapaian": "Lolos Pendanaan DIKTI 2024, Presentasi di PIMNAS",
      "file_dokumen": "pkm/proposal-pkm-2024.pdf",
      "dosen_pembimbing_id": 2,
      "dosen_pembimbing": {
        "id": 2,
        "nama": "Dr. Rina Wati, S.Kom., M.Kom.",
        "nidn": "0020100202"
      },
      "mahasiswa": [
        {
          "nim": "20210001",
          "nama": "Budi Santoso",
          "peran": "Ketua"
        }
      ],
      "created_at": "2025-11-11T10:00:00.000000Z"
    }
  ]
}
```

**Note:** Menggunakan `dana` (bukan `biaya`) dan relasi langsung ke tabel `dosen` dan `mahasiswa`.

### GET /api/pkm-dosen/{dosenId}
Get PKM by specific dosen pembimbing.

**Example:** `/api/pkm-dosen/1`

**Response:**
```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "judul_pkm": "Pengembangan Aplikasi Mobile untuk Deteksi Penyakit Tanaman",
      "tahun": 2024,
      "jenis_pkm": "PKM-KC",
      "status": "Didanai",
      "dana": 15000000,
      "dosen_pembimbing": {
        "id": 1,
        "nama": "Dr. Rina Wati, S.Kom., M.Kom."
      },
      "mahasiswa": [
        {
          "nim": "20210001",
          "nama": "Budi Santoso"
        }
      ]
    }
  ]
}
```

### GET /api/pkm-mahasiswa/{mahasiswaId}
Get PKM by specific mahasiswa (participant).

**Example:** `/api/pkm-mahasiswa/1`

**Response:**
```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "judul_pkm": "Pengembangan Aplikasi Mobile untuk Deteksi Penyakit Tanaman",
      "tahun": 2024,
      "jenis_pkm": "PKM-KC",
      "status": "Didanai",
      "dana": 15000000,
      "dosen_pembimbing": {
        "nama": "Dr. Rina Wati, S.Kom., M.Kom."
      },
      "mahasiswa": [
        {
          "nim": "20210001",
          "nama": "Budi Santoso",
          "peran": "Ketua"
        },
        {
          "nim": "20210002",
          "nama": "Citra Dewi",
          "peran": "Anggota"
        }
      ]
    }
  ]
}
```

### GET /api/pkm-statistics
Get PKM statistics (total, by jenis, by status, by year, total funding).

**Response:**
```json
{
  "success": true,
  "data": {
    "total": 35,
    "by_jenis": {
      "PKM-KC": 10,
      "PKM-K": 8,
      "PKM-M": 7,
      "PKM-T": 6,
      "PKM-R": 4
    },
    "by_status": {
      "Didanai": 20,
      "Diajukan": 10,
      "Selesai": 5
    },
    "by_year": {
      "2024": 12,
      "2023": 15,
      "2022": 8
    },
    "total_dana": 525000000
  }
}
```

---

## Kisah Sukses

### GET /api/kisah-sukses
Get list of success stories from alumni.

**Query Parameters:**
- `search` (string): Search by judul or kisah
- `status` (string): Filter by status (Published, Draft)
- `tahun_pencapaian` (integer): Filter by year

**Response:**
```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "nim": "20200001",
      "mahasiswa": {
        "nim": "20200001",
        "nama": "Ahmad Rahman",
        "email": "ahmad.rahman@student.tpl.ac.id"
      },
      "judul": "Dari Kampus ke Silicon Valley",
      "kisah": "Setelah lulus dari TPL, saya mendapatkan kesempatan bekerja di perusahaan teknologi terkemuka...",
      "pencapaian": "Software Engineer di Google",
      "tahun_pencapaian": 2024,
      "foto": "kisah-sukses/ahmad-rahman.jpg",
      "foto_url": "http://localhost:8000/storage/kisah-sukses/ahmad-rahman.jpg",
      "status": "Published",
      "created_at": "2025-11-11T10:00:00.000000Z",
      "updated_at": "2025-11-11T10:00:00.000000Z"
    }
  ]
}
```

**Note:** Menggunakan relasi langsung ke `mahasiswa` (bukan melalui `alumni.mahasiswa`). Schema simplified tanpa field `is_featured`, `kategori`, `views`.

### GET /api/kisah-sukses-featured
Get featured success stories for homepage (10 latest published stories).

**Response:**
```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "nim": "20200001",
      "mahasiswa": {
        "nim": "20200001",
        "nama": "Ahmad Rahman"
      },
      "judul": "Dari Kampus ke Silicon Valley",
      "kisah": "Setelah lulus dari TPL...",
      "pencapaian": "Software Engineer di Google",
      "tahun_pencapaian": 2024,
      "foto": "kisah-sukses/ahmad-rahman.jpg",
      "foto_url": "http://localhost:8000/storage/kisah-sukses/ahmad-rahman.jpg",
      "status": "Published"
    }
  ]
}
```

### GET /api/kisah-sukses-statistics
Get kisah sukses statistics by year.

**Response:**
```json
{
  "success": true,
  "data": {
    "total": 25,
    "published": 20,
    "draft": 5,
    "by_year": {
      "2024": 10,
      "2023": 8,
      "2022": 7
    }
  }
}
```

**Note:** Statistics focused on year-based grouping (bukan kategori atau views yang tidak ada di database).

---

## Tracer Study

### GET /api/tracer-study
Get tracer study data (simplified schema).

**Query Parameters:**
- `tahun_survey` (integer): Filter by survey year
- `status_pekerjaan` (string): Filter by employment status (Bekerja Full Time, Wiraswasta, Melanjutkan Studi, Freelancer, Belum Bekerja)

**Response:**
```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "nim": "20200001",
      "mahasiswa": {
        "nim": "20200001",
        "nama": "Ahmad Rahman",
        "email": "ahmad.rahman@student.tpl.ac.id"
      },
      "tahun_survey": 2024,
      "status_pekerjaan": "Bekerja Full Time",
      "nama_perusahaan": "PT Tech Indonesia",
      "posisi": "Backend Developer",
      "bidang_pekerjaan": "Software Development",
      "gaji": 8000000,
      "waktu_tunggu_kerja": 3,
      "kesesuaian_bidang_studi": "Sesuai",
      "kepuasan_prodi": 5,
      "saran_prodi": "Tambahkan materi cloud computing",
      "kompetensi_didapat": "Programming, Database, Software Engineering",
      "saran_pengembangan": "Lebih banyak praktek industri",
      "created_at": "2025-11-11T10:00:00.000000Z",
      "updated_at": "2025-11-11T10:00:00.000000Z"
    }
  ]
}
```

**Note:** Schema simplified dengan 15 kolom dasar. Tidak ada field `status_survey`, `alumni_id`, `tanggal_survey`, `gaji_pertama/gaji_sekarang` (digabung jadi `gaji`), atau multiple `kompetensi_*` dan `kepuasan_*` fields.

### GET /api/tracer-study-statistics
Get employment statistics from tracer study (using available fields).

**Response:**
```json
{
  "success": true,
  "data": {
    "total_responses": 100,
    "employment_rate": 85.0,
    "average_salary": 7500000,
    "average_waiting_time": 3.2,
    "satisfaction_rate": 4.3,
    "by_status_pekerjaan": {
      "Bekerja Full Time": 65,
      "Wiraswasta": 15,
      "Melanjutkan Studi": 5,
      "Freelancer": 5,
      "Belum Bekerja": 10
    },
    "by_kesesuaian": {
      "Sesuai": 70,
      "Tidak Sesuai": 15,
      "Tidak Relevan": 15
    },
    "salary_range": {
      "min": 4000000,
      "max": 15000000,
      "median": 7000000
    }
  }
}
```

**Note:** Statistics menggunakan field yang ada: `status_pekerjaan`, `waktu_tunggu_kerja`, `kesesuaian_bidang_studi`, `gaji`, `kepuasan_prodi`.

### GET /api/tracer-study-testimonials
Get testimonials/feedback from alumni (saran_prodi and saran_pengembangan).

**Response:**
```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "nim": "20200001",
      "mahasiswa": {
        "nim": "20200001",
        "nama": "Ahmad Rahman"
      },
      "tahun_survey": 2024,
      "kepuasan_prodi": 5,
      "saran_prodi": "Tambahkan materi cloud computing dan DevOps",
      "saran_pengembangan": "Lebih banyak praktek industri dan magang"
    }
  ]
}
```

**Note:** Testimonials menggunakan `saran_prodi` dan `saran_pengembangan`. Tidak ada field `pesan_untuk_juniors`.

---

## Prestasi

### GET /api/prestasi
Get list of student achievements.

**Query Parameters:**
- `search` (string): Search by nama or prestasi
- `tingkat` (string): Filter by tingkat (Internasional, Nasional, Regional, Lokal)
- `jenis` (string): Filter by jenis (Akademik, Olahraga, Seni, Teknologi, Lainnya)
- `tahun` (integer): Filter by year

**Response:**
```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "nim": "20200001",
      "mahasiswa": {
        "nim": "20200001",
        "nama": "Ahmad Rahman"
      },
      "nama_prestasi": "Juara 1 Hackathon Nasional",
      "tingkat_prestasi": "Nasional",
      "jenis_prestasi": "Teknologi",
      "penyelenggara": "Kementerian Pendidikan",
      "tanggal_prestasi": "2024-08-15",
      "deskripsi": "Memenangkan kompetisi hackathon...",
      "foto": "prestasi/hackathon-2024.jpg",
      "sertifikat": "sertifikat/hackathon-2024.pdf",
      "created_at": "2025-11-11T10:00:00.000000Z"
    }
  ]
}
```

### GET /api/prestasi/statistics
Get achievement statistics.

---

## Peraturan

### GET /api/peraturan
Get all peraturan (regulations/documents) grouped by kategori.

**Query Parameters:**
- `kategori` (string): Filter by kategori (Akademik, Kemahasiswaan, Administratif, Keuangan)
- `jenis` (string): Filter by specific jenis
- `include_inactive` (boolean): Include inactive peraturan

**Response:**
```json
{
  "success": true,
  "data": {
    "Akademik": [
      {
        "id": 1,
        "judul": "Kalender Akademik 2025/2026",
        "deskripsi": "Kalender akademik tahun ajaran 2025/2026...",
        "kategori": "Akademik",
        "jenis": "Kalender Akademik",
        "file_url": "http://localhost:8000/storage/peraturan/kalender_akademik_2025.pdf",
        "file_name": "Kalender_Akademik_2025_2026.pdf",
        "file_size_formatted": "2.00 MB",
        "urutan": 1,
        "is_active": true,
        "created_at": "2025-11-11T10:00:00.000000Z",
        "updated_at": "2025-11-11T10:00:00.000000Z"
      }
    ],
    "Kemahasiswaan": [...],
    "Administratif": [...],
    "Keuangan": [...]
  }
}
```

### GET /api/peraturan-kategori/{kategori}
Get peraturan by specific kategori.

**Example:** `/api/peraturan-kategori/Akademik`

**Response:**
```json
{
  "success": true,
  "kategori": "Akademik",
  "data": [
    {
      "id": 1,
      "judul": "Kalender Akademik 2025/2026",
      "deskripsi": "Kalender akademik tahun ajaran 2025/2026...",
      "kategori": "Akademik",
      "jenis": "Kalender Akademik",
      "file_url": "http://localhost:8000/storage/peraturan/kalender_akademik_2025.pdf",
      "file_name": "Kalender_Akademik_2025_2026.pdf",
      "file_size_formatted": "2.00 MB",
      "urutan": 1,
      "created_at": "2025-11-11T10:00:00.000000Z"
    }
  ]
}
```

### GET /api/peraturan/{id}
Get single peraturan detail.

**Response:**
```json
{
  "success": true,
  "data": {
    "id": 1,
    "judul": "Kalender Akademik 2025/2026",
    "deskripsi": "Kalender akademik tahun ajaran 2025/2026 yang berisi jadwal kegiatan akademik selama satu tahun.",
    "kategori": "Akademik",
    "jenis": "Kalender Akademik",
    "file_url": "http://localhost:8000/storage/peraturan/kalender_akademik_2025.pdf",
    "file_name": "Kalender_Akademik_2025_2026.pdf",
    "file_size_formatted": "2.00 MB",
    "urutan": 1,
    "is_active": true,
    "created_at": "2025-11-11T10:00:00.000000Z",
    "updated_at": "2025-11-11T10:00:00.000000Z"
  }
}
```

---

## Error Responses

All endpoints return errors in this format:

```json
{
  "success": false,
  "message": "Error message here"
}
```

**Common HTTP Status Codes:**
- `200` - Success
- `404` - Resource not found
- `422` - Validation error
- `500` - Server error

---

## CORS Configuration

Make sure CORS is enabled in Laravel for your Next.js frontend:

```php
// config/cors.php
'paths' => ['api/*'],
'allowed_origins' => ['http://localhost:3000', 'https://your-nextjs-domain.com'],
'allowed_methods' => ['*'],
'allowed_headers' => ['*'],
```

---

## Frontend Integration Examples

### React/Next.js Fetch Examples

```javascript
// lib/api.js
const API_BASE_URL = process.env.NEXT_PUBLIC_API_URL || 'http://localhost:8000/api';

// Fetch all peraturan grouped by kategori
export async function getPeraturan() {
  const res = await fetch(`${API_BASE_URL}/peraturan`);
  const data = await res.json();
  return data;
}

// Fetch peraturan by kategori
export async function getPeraturanByKategori(kategori) {
  const res = await fetch(`${API_BASE_URL}/peraturan-kategori/${kategori}`);
  return res.json();
}

// Fetch berita
export async function getBerita(params = {}) {
  const queryString = new URLSearchParams(params).toString();
  const res = await fetch(`${API_BASE_URL}/berita?${queryString}`);
  return res.json();
}

// Fetch agenda mendatang
export async function getAgendaMendatang() {
  const res = await fetch(`${API_BASE_URL}/agenda?upcoming=true&aktif=true`);
  return res.json();
}

// Fetch tracer study statistics
export async function getTracerStudyStats() {
  const res = await fetch(`${API_BASE_URL}/tracer-study-statistics`);
  return res.json();
}
```

### Display PDF File
```javascript
// Direct download link
<a href={item.file_url} download={item.file_name} target="_blank">
  Download {item.file_name}
</a>

// Display in iframe
<iframe 
  src={item.file_url} 
  width="100%" 
  height="600px"
  title={item.judul}
/>
```

### Peraturan Component Example
```jsx
// components/PeraturanList.jsx
import { useState, useEffect } from 'react';

export default function PeraturanList({ kategori }) {
  const [peraturan, setPeraturan] = useState([]);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    fetch(`http://localhost:8000/api/peraturan-kategori/${kategori}`)
      .then(res => res.json())
      .then(data => {
        if (data.success) {
          setPeraturan(data.data);
        }
        setLoading(false);
      });
  }, [kategori]);

  if (loading) return <div>Loading...</div>;

  return (
    <div className="peraturan-list">
      <h2>Peraturan {kategori}</h2>
      <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
        {peraturan.map(item => (
          <div key={item.id} className="card">
            <h3>{item.judul}</h3>
            <p>{item.deskripsi}</p>
            <p className="text-sm text-gray-500">{item.file_size_formatted}</p>
            <a 
              href={item.file_url} 
              target="_blank"
              className="btn btn-primary"
            >
              Download PDF
            </a>
          </div>
        ))}
      </div>
    </div>
  );
}
```

---

## Notes

1. All file URLs (images, PDFs) are absolute URLs ready to use in frontend.
2. Most endpoints support pagination (use `?page=2` for next page).
3. Date formats follow ISO 8601 standard.
4. File sizes are automatically formatted (B, KB, MB, GB).
5. Boolean values use `true`/`false` or `1`/`0`.
6. All responses include `success` flag for easy error handling.

---

## Example JSON Responses

Berikut adalah contoh lengkap JSON response dari setiap endpoint utama untuk referensi frontend:

### Dosen Response Example
```bash
curl http://localhost:8000/api/dosen/1 | jq
```
```json
{
  "success": true,
  "data": {
    "id": 1,
    "nidn": "0015100101",
    "nama": "Dr. Ahmad Surya, S.Kom., M.Kom.",
    "email": "ahmad.surya@tpl.ac.id",
    "no_hp": "081234567801",
    "jenis_kelamin": "Laki-laki",
    "jabatan": "Lektor Kepala",
    "pendidikan_terakhir": "S3 Ilmu Komputer",
    "bidang_keahlian": "Software Engineering, Web Development",
    "alamat": "Jl. Merdeka No. 15, Jakarta",
    "foto": null,
    "foto_url": null,
    "google_scholar_link": "https://scholar.google.com/citations?user=AhmadSurya123",
    "sinta_link": "https://sinta.kemdikbud.go.id/authors/profile/6001234",
    "scopus_link": "https://www.scopus.com/authid/detail.uri?authorId=57123456789",
    "prodi": "Teknik Perangkat Lunak",
    "status": "Aktif",
    "created_at": "2025-11-11T12:55:08.000000Z",
    "updated_at": "2025-11-11T13:52:41.000000Z"
  }
}
```

### Mahasiswa Response Example
```bash
curl http://localhost:8000/api/mahasiswa?status=Aktif | jq
```
```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "nim": "20200001",
      "nama": "Ahmad Rahman",
      "email": "ahmad.rahman@student.tpl.ac.id",
      "no_hp": "081234560001",
      "jenis_kelamin": "Laki-laki",
      "alamat": "Jl. Kebon Jeruk No. 12, Jakarta Barat",
      "tempat_lahir": "Jakarta",
      "tanggal_lahir": "2002-05-15",
      "tahun_masuk": 2020,
      "tahun_lulus": 2024,
      "kelas": "TPL-A",
      "status": "Aktif",
      "prodi": "Teknik Perangkat Lunak",
      "foto": null,
      "created_at": "2025-11-11T10:00:00.000000Z",
      "updated_at": "2025-11-11T10:00:00.000000Z"
    }
  ]
}
```

### Project Response Example
```bash
curl http://localhost:8000/api/project/1 | jq
```
```json
{
  "success": true,
  "data": {
    "id": 1,
    "nim": "20200001",
    "mahasiswa": {
      "nim": "20200001",
      "nama": "Ahmad Rahman",
      "email": "ahmad.rahman@student.tpl.ac.id"
    },
    "judul_project": "E-Commerce Platform dengan Laravel",
    "deskripsi": "Platform e-commerce lengkap dengan fitur keranjang belanja, payment gateway, dan admin dashboard",
    "tahun": 2024,
    "tahun_selesai": 2024,
    "kategori": "Web Application",
    "teknologi": "Laravel, Vue.js, MySQL, Midtrans",
    "dosen_pembimbing": "Dr. Rina Wati, M.Kom",
    "link_github": "https://github.com/ahmad/ecommerce-laravel",
    "link_demo": "https://ecommerce-demo.tpl.ac.id",
    "status": "Published",
    "cover_image": "projects/ecommerce-cover.jpg",
    "galeri": [
      "projects/ecommerce-1.jpg",
      "projects/ecommerce-2.jpg",
      "projects/ecommerce-3.jpg"
    ],
    "created_at": "2025-11-11T10:00:00.000000Z",
    "updated_at": "2025-11-11T10:00:00.000000Z"
  }
}
```

### Peraturan Response Example
```bash
curl http://localhost:8000/api/peraturan | jq
```
```json
{
  "success": true,
  "data": {
    "Akademik": [
      {
        "id": 1,
        "judul": "Kalender Akademik 2025/2026",
        "deskripsi": "Kalender akademik tahun ajaran 2025/2026 yang berisi jadwal kegiatan akademik selama satu tahun",
        "kategori": "Akademik",
        "jenis": "Kalender Akademik",
        "file_path": "peraturan/kalender_akademik_2025.pdf",
        "file_url": "http://localhost:8000/storage/peraturan/kalender_akademik_2025.pdf",
        "file_name": "Kalender_Akademik_2025_2026.pdf",
        "file_size": 2097152,
        "file_size_formatted": "2.00 MB",
        "urutan": 1,
        "is_active": true,
        "created_at": "2025-11-11T10:00:00.000000Z",
        "updated_at": "2025-11-11T10:00:00.000000Z"
      }
    ],
    "Kemahasiswaan": [...],
    "Administratif": [...],
    "Keuangan": [...]
  }
}
```

### Tracer Study Statistics Response Example
```bash
curl http://localhost:8000/api/tracer-study-statistics | jq
```
```json
{
  "success": true,
  "data": {
    "total_responses": 100,
    "employment_rate": 85.5,
    "average_salary": 7500000,
    "average_waiting_time": 3.2,
    "satisfaction_rate": 4.3,
    "by_status": {
      "Bekerja Full Time": 65,
      "Wiraswasta": 15,
      "Melanjutkan Studi": 5,
      "Freelancer": 5,
      "Belum Bekerja": 10
    },
    "by_field": {
      "Sesuai Bidang": 70,
      "Tidak Sesuai": 15
    },
    "salary_range": {
      "min": 4000000,
      "max": 15000000,
      "median": 7000000
    }
  }
}
```

### Penelitian Response Example
```bash
curl http://localhost:8000/api/penelitian?tahun=2024 | jq
# Or by dosen
curl http://localhost:8000/api/penelitian-dosen/1 | jq
```
```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "judul_penelitian": "Pengembangan Sistem Informasi Akademik Berbasis Cloud",
      "deskripsi": "Penelitian ini bertujuan untuk mengembangkan sistem informasi akademik yang scalable dan dapat diakses dari berbagai platform",
      "tahun": 2024,
      "jenis_penelitian": "Hibah",
      "sumber_dana": "DIKTI",
      "dana": 50000000,
      "status": "Sedang Berjalan",
      "tanggal_mulai": "2024-01-15",
      "tanggal_selesai": null,
      "output": "Jurnal Nasional Terakreditasi Sinta 2",
      "file_dokumen": "penelitian/proposal-2024.pdf",
      "ketua_peneliti_id": 1,
      "ketua_peneliti": {
        "id": 1,
        "nama": "Dr. Ahmad Surya, S.Kom., M.Kom.",
        "nidn": "0015100101",
        "email": "ahmad.surya@tpl.ac.id"
      },
      "created_at": "2025-11-11T10:00:00.000000Z",
      "updated_at": "2025-11-11T10:00:00.000000Z"
    }
  ]
}
```

**Schema Notes:**
- Uses `judul_penelitian` (not `judul`)
- Uses `dana` (not `jumlah_dana`)
- Uses `ketua_peneliti_id` (not `dosen_id`)
- Uses single `file_dokumen` (not `file_proposal`/`file_laporan`)

### PKM Response Example
```bash
curl http://localhost:8000/api/pkm?tahun=2024 | jq
# Or by dosen
curl http://localhost:8000/api/pkm-dosen/1 | jq
# Or by mahasiswa
curl http://localhost:8000/api/pkm-mahasiswa/1 | jq
```
```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "judul_pkm": "Pengembangan Aplikasi Mobile untuk Deteksi Penyakit Tanaman",
      "deskripsi": "PKM ini bertujuan untuk mengembangkan aplikasi mobile berbasis AI untuk mendeteksi penyakit pada tanaman pertanian",
      "tahun": 2024,
      "jenis_pkm": "PKM-KC",
      "status": "Didanai",
      "dana": 15000000,
      "pencapaian": "Lolos Pendanaan DIKTI 2024, Presentasi di PIMNAS",
      "file_dokumen": "pkm/proposal-pkm-2024.pdf",
      "dosen_pembimbing_id": 2,
      "dosen_pembimbing": {
        "id": 2,
        "nama": "Dr. Rina Wati, S.Kom., M.Kom.",
        "nidn": "0020100202"
      },
      "mahasiswa": [
        {
          "nim": "20210001",
          "nama": "Budi Santoso",
          "peran": "Ketua"
        },
        {
          "nim": "20210002",
          "nama": "Citra Dewi",
          "peran": "Anggota"
        }
      ],
      "created_at": "2025-11-11T10:00:00.000000Z",
      "updated_at": "2025-11-11T10:00:00.000000Z"
    }
  ]
}
```

**Schema Notes:**
- Uses `dana` (not `biaya`)
- Direct relationship to `dosen` and `mahasiswa` tables (not `tbl_dosen`/`tbl_mahasiswa`)
- Uses whereHas queries (not scope methods)

### Agenda Response Example
```bash
curl "http://localhost:8000/api/agenda?upcoming=true&aktif=true" | jq
```
```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "judul": "Seminar Nasional Teknologi Informasi 2025",
      "deskripsi": "Seminar nasional dengan tema 'AI dan Machine Learning untuk Industri 4.0'",
      "tanggal_mulai": "2025-11-15 09:00:00",
      "tanggal_selesai": "2025-11-16 17:00:00",
      "lokasi": "Auditorium Kampus",
      "kategori": "seminar",
      "penyelenggara": "Prodi TPL",
      "kontak": "08123456789",
      "poster": "agenda/seminar-nasional-ti.jpg",
      "poster_url": "http://localhost:8000/storage/agenda/seminar-nasional-ti.jpg",
      "aktif": true,
      "created_at": "2025-11-11T10:00:00.000000Z",
      "updated_at": "2025-11-11T10:00:00.000000Z"
    }
  ]
}
```

---

## Quick Integration Scripts

### JavaScript/Next.js Example
```javascript
// lib/api.js
const API_URL = 'http://localhost:8000/api';

export async function fetchAPI(endpoint, options = {}) {
  const res = await fetch(`${API_URL}${endpoint}`, {
    ...options,
    headers: {
      'Content-Type': 'application/json',
      ...options.headers,
    },
  });
  
  if (!res.ok) {
    throw new Error(`API Error: ${res.status}`);
  }
  
  return res.json();
}

// Usage examples
export const getDosenList = () => fetchAPI('/dosen');
export const getDosenById = (id) => fetchAPI(`/dosen/${id}`);
export const getMahasiswa = (params = {}) => {
  const query = new URLSearchParams(params).toString();
  return fetchAPI(`/mahasiswa?${query}`);
};
export const getPeraturan = () => fetchAPI('/peraturan');
export const getTracerStudyStats = () => fetchAPI('/tracer-study-statistics');
```

### React Component Example
```jsx
// components/DosenCard.jsx
import { useEffect, useState } from 'react';

export default function DosenCard() {
  const [dosen, setDosen] = useState([]);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    fetch('http://localhost:8000/api/dosen')
      .then(res => res.json())
      .then(data => {
        if (data.success) {
          setDosen(data.data);
        }
        setLoading(false);
      })
      .catch(error => {
        console.error('Error:', error);
        setLoading(false);
      });
  }, []);

  if (loading) return <div>Loading...</div>;

  return (
    <div className="grid grid-cols-1 md:grid-cols-3 gap-4">
      {dosen.map(d => (
        <div key={d.id} className="card">
          <h3>{d.nama}</h3>
          <p>{d.jabatan}</p>
          <p>{d.bidang_keahlian}</p>
          <div className="academic-links">
            {d.google_scholar_link && (
              <a href={d.google_scholar_link} target="_blank">Google Scholar</a>
            )}
            {d.sinta_link && (
              <a href={d.sinta_link} target="_blank">SINTA</a>
            )}
            {d.scopus_link && (
              <a href={d.scopus_link} target="_blank">Scopus</a>
            )}
          </div>
        </div>
      ))}
    </div>
  );
}
```

---

Last Updated: November 12, 2025
