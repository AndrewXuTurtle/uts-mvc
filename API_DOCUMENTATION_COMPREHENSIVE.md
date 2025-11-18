# 📚 API Documentation - Comprehensive Guide
**Program Studi Teknik Perangkat Lunak**  
*Version 2.0 - Updated January 2025*

---

## 📋 Table of Contents
1. [Overview](#overview)
2. [Base URL](#base-url)
3. [Response Format](#response-format)
4. [Project API](#project-api)
5. [PKM API](#pkm-api)
6. [Penelitian API](#penelitian-api)
7. [Tracer Study API](#tracer-study-api)
8. [Kisah Sukses API](#kisah-sukses-api)
9. [Prestasi API](#prestasi-api)
10. [Relationship Data](#relationship-data)

---

## 🌐 Overview

This API provides access to academic data for the Software Engineering program including:
- **Projects**: Student capstone and portfolio projects
- **PKM**: Community service programs
- **Penelitian**: Research projects
- **Tracer Study**: Alumni employment tracking
- **Kisah Sukses**: Alumni success stories
- **Prestasi**: Student achievements

### Key Features
✅ **Eager Loading**: All responses include related data (mahasiswa, dosen, alumni)  
✅ **Single API Call**: No need for multiple requests to get complete data  
✅ **Standardized Format**: Consistent response structure across all endpoints  
✅ **Filtering & Search**: Query parameters for filtering data  
✅ **Pagination**: Efficient handling of large datasets  

---

## 🔗 Base URL

```
Production: https://tpl.ac.id/api
Development: http://localhost:8000/api
```

---

## 📦 Response Format

All API responses follow this standard structure:

### Success Response
```json
{
  "success": true,
  "data": [...],
  "meta": {
    "current_page": 1,
    "last_page": 5,
    "per_page": 15,
    "total": 68
  }
}
```

### Error Response
```json
{
  "success": false,
  "message": "Error description",
  "errors": {...}
}
```

---

## 🗂️ Project API

### Get All Projects
**Endpoint:** `GET /api/projects`

**Query Parameters:**
- `search` - Search in title, description, or student name
- `tahun` - Filter by year (e.g., 2024)
- `kategori` - Filter by category (Website, Mobile App, Desktop App, IoT, Game)
- `status` - Filter by status (ongoing, completed, published, cancelled)

**Request Example:**
```bash
curl -X GET "https://tpl.ac.id/api/projects?search=website&tahun=2024&status=published"
```

**Response Example:**
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
        "email": "ahmad.rahman@student.tpl.ac.id",
        "kelas": "TPL-A",
        "prodi": "Teknik Perangkat Lunak"
      },
      "judul_project": "E-Commerce Platform dengan AI Recommendation",
      "deskripsi": "Platform e-commerce modern dengan fitur rekomendasi produk berbasis AI...",
      "kategori": "Website",
      "teknologi": "Laravel, Vue.js, TensorFlow, MySQL",
      "url_repo": "https://github.com/ahmadrahman/ecommerce-ai",
      "url_demo": "https://demo-ecommerce.vercel.app",
      "cover_image_url": "http://localhost:8000/storage/projects/cover_1.jpg",
      "galeri_urls": [
        "http://localhost:8000/storage/projects/galeri_1_1.jpg",
        "http://localhost:8000/storage/projects/galeri_1_2.jpg"
      ],
      "tahun": 2024,
      "status": "published",
      "tanggal_mulai": "2024-02-01",
      "tanggal_selesai": "2024-06-30",
      "created_at": "2024-02-01T10:00:00.000000Z",
      "updated_at": "2024-06-30T15:30:00.000000Z"
    }
  ],
  "meta": {
    "current_page": 1,
    "last_page": 4,
    "per_page": 15,
    "total": 50
  }
}
```

### Get Single Project
**Endpoint:** `GET /api/projects/{id}`

**Response:** Returns complete project details with full mahasiswa profile (7 fields).

---

## 🤝 PKM API

### Get All PKM Programs
**Endpoint:** `GET /api/pkm`

**Query Parameters:**
- `search` - Search in title or description
- `tahun` - Filter by year
- `status` - Filter by status (ongoing, completed, published, cancelled)

**Request Example:**
```bash
curl -X GET "https://tpl.ac.id/api/pkm?status=published&tahun=2024"
```

**Response Example:**
```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "judul": "PKM Pelatihan Web Development untuk UMKM",
      "deskripsi": "Program pelatihan pembuatan website untuk pelaku UMKM di Desa Sejahtera...",
      "dosen": [
        {
          "id": 1,
          "nidn": "0015100101",
          "nama": "Dr. Ahmad Surya, S.Kom., M.Kom.",
          "email": "ahmad.surya@tpl.ac.id",
          "jabatan": "Lektor Kepala"
        },
        {
          "id": 2,
          "nidn": "0025040102",
          "nama": "Dr. Siti Nurhaliza, S.Kom., M.T.",
          "email": "siti.nurhaliza@tpl.ac.id",
          "jabatan": "Lektor"
        }
      ],
      "mahasiswa": [
        {
          "id": 1,
          "nim": "20220006",
          "nama": "Maya Anggraini",
          "email": "maya.anggraini@student.tpl.ac.id",
          "kelas": "TPL-A"
        },
        {
          "id": 2,
          "nim": "20220007",
          "nama": "Fajar Nugroho",
          "email": "fajar.nugroho@student.tpl.ac.id",
          "kelas": "TPL-B"
        },
        {
          "id": 3,
          "nim": "20230008",
          "nama": "Intan Permata",
          "email": "intan.permata@student.tpl.ac.id",
          "kelas": "TPL-A"
        }
      ],
      "mitra": "UMKM Desa Sejahtera",
      "lokasi": "Desa Sejahtera, Bogor",
      "biaya": 15000000,
      "dokumentasi_urls": [
        "http://localhost:8000/storage/pkm/dok_1_1.jpg",
        "http://localhost:8000/storage/pkm/dok_1_2.jpg"
      ],
      "status": "published",
      "tahun": 2024,
      "tanggal_mulai": "2024-03-01",
      "tanggal_selesai": "2024-08-31",
      "created_at": "2024-03-01T09:00:00.000000Z",
      "updated_at": "2024-08-31T16:00:00.000000Z"
    }
  ],
  "meta": {
    "current_page": 1,
    "last_page": 3,
    "per_page": 15,
    "total": 35
  }
}
```

**Note:** PKM includes **many-to-many relationships**:
- Multiple dosen can supervise one PKM
- Multiple mahasiswa can participate in one PKM

---

## 🔬 Penelitian API

### Get All Penelitian
**Endpoint:** `GET /api/penelitian`

**Query Parameters:**
- `search` - Search in title, description, or research field
- `tahun` - Filter by year
- `status` - Filter by status
- `bidang_penelitian` - Filter by research field

**Request Example:**
```bash
curl -X GET "https://tpl.ac.id/api/penelitian?bidang_penelitian=Machine%20Learning&tahun=2024"
```

**Response Example:**
```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "judul": "Penelitian Machine Learning untuk Deteksi Penyakit",
      "deskripsi": "Penelitian pengembangan model ML untuk deteksi dini penyakit...",
      "dosen": {
        "id": 3,
        "nidn": "0030120103",
        "nama": "Prof. Dr. Budi Santoso, S.Kom., M.Kom.",
        "email": "budi.santoso@tpl.ac.id",
        "jabatan": "Profesor",
        "bidang_keahlian": "Data Science, Machine Learning, AI"
      },
      "bidang_penelitian": "Machine Learning",
      "sumber_dana": "DIKTI",
      "jumlah_dana": 50000000,
      "tahun": 2024,
      "status": "ongoing",
      "tanggal_mulai": "2024-01-15",
      "tanggal_selesai": "2025-01-14",
      "file_proposal_url": "http://localhost:8000/storage/penelitian/proposal_1.pdf",
      "file_laporan_url": null,
      "created_at": "2024-01-15T08:00:00.000000Z",
      "updated_at": "2024-01-15T08:00:00.000000Z"
    }
  ],
  "meta": {
    "current_page": 1,
    "last_page": 2,
    "per_page": 15,
    "total": 30
  }
}
```

### Get Penelitian by Dosen
**Endpoint:** `GET /api/penelitian/by-dosen/{dosen_id}`

Returns all penelitian by a specific dosen with complete dosen profile.

---

## 📊 Tracer Study API

### Get All Tracer Study Responses
**Endpoint:** `GET /api/tracer-study`

**Query Parameters:**
- `search` - Search in alumni name, company, or position
- `tahun_survey` - Filter by survey year
- `status_pekerjaan` - Filter by employment status
- `kesesuaian_pekerjaan` - Filter by job relevance

**Request Example:**
```bash
curl -X GET "https://tpl.ac.id/api/tracer-study?status_pekerjaan=bekerja_full_time&tahun_survey=2024"
```

**Response Example:**
```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "nim": "20200001",
      "alumni": {
        "nim": "20200001",
        "nama": "Ahmad Rahman",
        "email": "ahmad.rahman@student.tpl.ac.id",
        "prodi": "Teknik Perangkat Lunak",
        "tahun_lulus": 2024,
        "foto_url": "http://localhost:8000/storage/alumni/foto_1.jpg",
        "pekerjaan_saat_ini": "Software Engineer",
        "nama_perusahaan": "PT Teknologi Maju",
        "posisi_jabatan": "Backend Developer",
        "telepon": "081234560001",
        "linkedin": "https://linkedin.com/in/ahmadrahman"
      },
      "tahun_survey": 2024,
      "bulan_sejak_lulus": 6,
      "status_pekerjaan": "bekerja_full_time",
      "nama_perusahaan": "PT Teknologi Maju",
      "posisi_pekerjaan": "Backend Developer",
      "bidang_pekerjaan": "IT/Software",
      "tingkat_pendidikan_pekerjaan": "S1",
      "gaji_pertama": 6000000,
      "gaji_sekarang": 8000000,
      "kesesuaian_pekerjaan": "sangat_sesuai",
      "waktu_tunggu_kerja": "kurang_3_bulan",
      "cara_dapat_kerja": "Job Portal",
      "kompetensi_teknis": 4,
      "kompetensi_bahasa_inggris": 4,
      "kompetensi_komunikasi": 5,
      "kompetensi_teamwork": 5,
      "kompetensi_problem_solving": 4,
      "kepuasan_kurikulum": 4,
      "kepuasan_dosen": 5,
      "kepuasan_fasilitas": 4,
      "saran_perbaikan": "Perbanyak praktik industri",
      "created_at": "2024-08-01T10:00:00.000000Z",
      "updated_at": "2024-08-01T10:00:00.000000Z"
    }
  ],
  "meta": {
    "current_page": 1,
    "last_page": 3,
    "per_page": 15,
    "total": 40
  }
}
```

**Note:** Tracer Study uses **nested eager loading**: `alumni.mahasiswa`
- Alumni table extends Mahasiswa via `nim` foreign key
- Response combines both alumni and mahasiswa data

### Get Testimonials
**Endpoint:** `GET /api/tracer-study/testimonials`

Returns tracer study responses with non-null `saran_perbaikan`, including alumni data.

---

## 🌟 Kisah Sukses API

### Get All Kisah Sukses
**Endpoint:** `GET /api/kisah-sukses`

**Query Parameters:**
- `search` - Search in title or story content
- `kategori` - Filter by category (karir, wirausaha, prestasi, melanjutkan_studi)
- `status` - Filter by status (published, draft, archived)

**Request Example:**
```bash
curl -X GET "https://tpl.ac.id/api/kisah-sukses?kategori=wirausaha&status=published"
```

**Response Example:**
```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "nim": "20200002",
      "alumni": {
        "nim": "20200002",
        "nama": "Siti Aminah",
        "email": "siti.aminah@student.tpl.ac.id",
        "prodi": "Teknik Perangkat Lunak",
        "tahun_lulus": 2024,
        "foto_url": "http://localhost:8000/storage/alumni/foto_2.jpg",
        "pekerjaan_saat_ini": "CEO & Founder",
        "nama_perusahaan": "TechStartup Indonesia",
        "posisi_jabatan": "Chief Executive Officer",
        "gaji_saat_ini": 25000000,
        "telepon": "081234560002",
        "linkedin": "https://linkedin.com/in/sitiaminah"
      },
      "judul": "Dari Mahasiswa ke CEO Startup Teknologi",
      "cerita": "Perjalanan saya membangun startup teknologi dimulai dari kampus...",
      "kategori": "wirausaha",
      "foto_utama_url": "http://localhost:8000/storage/kisah-sukses/foto_1.jpg",
      "galeri_foto_urls": [
        "http://localhost:8000/storage/kisah-sukses/galeri_1_1.jpg",
        "http://localhost:8000/storage/kisah-sukses/galeri_1_2.jpg"
      ],
      "video_url": "https://youtube.com/watch?v=abc123",
      "quote": "Kesuksesan dimulai dari impian yang berani",
      "tanggal_publish": "2024-09-15",
      "is_featured": true,
      "status": "published",
      "views": 1250,
      "tags": "inspirasi,startup,wirausaha",
      "created_at": "2024-09-10T09:00:00.000000Z",
      "updated_at": "2024-12-20T14:30:00.000000Z"
    }
  ],
  "meta": {
    "current_page": 1,
    "last_page": 2,
    "per_page": 15,
    "total": 25
  }
}
```

### Get Featured Stories
**Endpoint:** `GET /api/kisah-sukses/featured`

Returns top 6 featured and published stories with alumni data.

---

## 🏆 Prestasi API

### Get All Prestasi
**Endpoint:** `GET /api/prestasi`

**Query Parameters:**
- `search` - Search in title, student name, or achievement type
- `tingkat_prestasi` - Filter by level (Internasional, Nasional, Regional, Lokal)
- `jenis_prestasi` - Filter by type

**Request Example:**
```bash
curl -X GET "https://tpl.ac.id/api/prestasi?tingkat_prestasi=Nasional&jenis_prestasi=Hackathon"
```

**Response Example:**
```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "judul": "Mahasiswa TPL Raih Juara 1 Hackathon Nasional 2024",
      "isi": "Mahasiswa Teknik Perangkat Lunak berhasil meraih juara 1...",
      "gambar_url": "http://localhost:8000/storage/berita/prestasi_1.jpg",
      "penulis": "Admin Prodi TPL",
      "tanggal": "2024-10-15",
      "nim": "20220006",
      "mahasiswa": {
        "nim": "20220006",
        "nama": "Maya Anggraini",
        "email": "maya.anggraini@student.tpl.ac.id",
        "kelas": "TPL-A",
        "prodi": "Teknik Perangkat Lunak",
        "tahun_masuk": 2022
      },
      "nama_mahasiswa": "Maya Anggraini",
      "program_studi": "Teknik Perangkat Lunak",
      "tingkat_prestasi": "Nasional",
      "jenis_prestasi": "Hackathon",
      "penyelenggara": "Kementerian Pendidikan RI",
      "tanggal_prestasi": "2024-10-10",
      "is_prestasi": true,
      "created_at": "2024-10-15T11:00:00.000000Z",
      "updated_at": "2024-10-15T11:00:00.000000Z"
    }
  ],
  "meta": {
    "current_page": 1,
    "last_page": 3,
    "per_page": 15,
    "total": 35
  }
}
```

**Note:** Prestasi uses **fallback pattern**:
- If `mahasiswa` relationship exists, use relationship data
- If null, fallback to stored fields (`nama_mahasiswa`, `program_studi`)
- This handles cases where prestasi might reference non-existing students

### Get Statistics
**Endpoint:** `GET /api/prestasi/statistics`

Returns prestasi statistics by level and featured prestasi.

---

## 🔗 Relationship Data

### Understanding Eager Loading

All API endpoints use **eager loading** to include related data in a single request. This eliminates the need for multiple API calls.

#### Example: Before vs After

**❌ Before (Multiple API Calls Needed):**
```bash
# Call 1: Get project
curl /api/projects/1
# Returns: { "id": 1, "nim": "20200001", ... }

# Call 2: Get student data
curl /api/mahasiswa/20200001
# Returns: { "nim": "20200001", "nama": "Ahmad Rahman", ... }
```

**✅ After (Single API Call):**
```bash
# Single call with complete data
curl /api/projects/1
# Returns: { 
#   "id": 1, 
#   "nim": "20200001",
#   "mahasiswa": { "nama": "Ahmad Rahman", "email": "...", ... },
#   ...
# }
```

### Relationship Types

1. **belongsTo** (One-to-One)
   - Project → Mahasiswa
   - Penelitian → Dosen
   - TracerStudy → Alumni
   - Alumni → Mahasiswa

2. **belongsToMany** (Many-to-Many)
   - PKM ↔ Dosen (multiple dosen per PKM)
   - PKM ↔ Mahasiswa (multiple mahasiswa per PKM)

3. **Nested Relationships**
   - TracerStudy → Alumni → Mahasiswa
   - KisahSukses → Alumni → Mahasiswa

### Relationship Fields

#### Mahasiswa Fields (in relationships):
```json
{
  "nim": "20200001",
  "nama": "Ahmad Rahman",
  "email": "ahmad.rahman@student.tpl.ac.id",
  "kelas": "TPL-A",
  "prodi": "Teknik Perangkat Lunak",
  "tahun_masuk": 2020
}
```

#### Dosen Fields (in relationships):
```json
{
  "id": 1,
  "nidn": "0015100101",
  "nama": "Dr. Ahmad Surya, S.Kom., M.Kom.",
  "email": "ahmad.surya@tpl.ac.id",
  "jabatan": "Lektor Kepala",
  "bidang_keahlian": "Software Engineering, Web Development"
}
```

#### Alumni Fields (in relationships):
```json
{
  "nim": "20200001",
  "nama": "Ahmad Rahman",
  "email": "ahmad.rahman@student.tpl.ac.id",
  "prodi": "Teknik Perangkat Lunak",
  "tahun_lulus": 2024,
  "foto_url": "...",
  "pekerjaan_saat_ini": "Software Engineer",
  "nama_perusahaan": "PT Teknologi Maju",
  "posisi_jabatan": "Backend Developer",
  "telepon": "...",
  "linkedin": "..."
}
```

---

## 🎯 Frontend Integration Examples

### React/Vue.js Example
```javascript
// Single API call gets complete data
async function getProjectWithStudent(id) {
  const response = await fetch(`/api/projects/${id}`);
  const { data } = await response.json();
  
  // Access student data directly - no additional API call needed
  console.log(data.mahasiswa.nama);
  console.log(data.mahasiswa.email);
  console.log(data.mahasiswa.kelas);
}
```

### Displaying PKM with Multiple Dosen & Mahasiswa
```javascript
async function displayPKM(id) {
  const response = await fetch(`/api/pkm/${id}`);
  const { data } = await response.json();
  
  // Display all dosen (array)
  data.dosen.forEach(dosen => {
    console.log(`Dosen: ${dosen.nama} (${dosen.jabatan})`);
  });
  
  // Display all mahasiswa (array)
  data.mahasiswa.forEach(mhs => {
    console.log(`Mahasiswa: ${mhs.nama} - ${mhs.kelas}`);
  });
}
```

### Handling Nested Alumni Data
```javascript
async function displayTracerStudy(id) {
  const response = await fetch(`/api/tracer-study/${id}`);
  const { data } = await response.json();
  
  // Access nested alumni → mahasiswa data
  console.log(`Alumni: ${data.alumni.nama}`);
  console.log(`Email: ${data.alumni.email}`);
  console.log(`Lulusan: ${data.alumni.tahun_lulus}`);
  console.log(`Pekerjaan: ${data.alumni.pekerjaan_saat_ini}`);
  console.log(`Perusahaan: ${data.alumni.nama_perusahaan}`);
}
```

---

## 📞 Support

For API issues or questions:
- **Email**: it@tpl.ac.id
- **GitHub**: https://github.com/tpl/api-issues
- **Documentation**: https://tpl.ac.id/api-docs

---

## 📝 Changelog

### Version 2.0 (January 2025)
- ✅ Added eager loading to all endpoints
- ✅ Standardized response format
- ✅ Added comprehensive relationship data
- ✅ Improved search and filtering
- ✅ Added fallback patterns for Prestasi
- ✅ Enhanced PKM with many-to-many relationships
- ✅ Nested eager loading for Alumni data

### Version 1.0 (September 2024)
- Initial API release
- Basic CRUD endpoints
- Limited relationship support

---

**Last Updated:** January 15, 2025  
**Maintained by:** Tim IT Prodi TPL
