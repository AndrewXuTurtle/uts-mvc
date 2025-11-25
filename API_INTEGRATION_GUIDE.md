# 🚀 API Integration Guide - UTS MVC System

Base URL: `http://127.0.0.1:8000/api`

---

## 📋 Quick Reference

All endpoints return standardized JSON:
```json
{
  "success": true,
  "data": {...}
}
```

### Key Image URL Fields
- Berita: `gambar_url`
- Project: `cover_image_url`, `galeri_urls[]`
- TracerStudy: `alumni.foto_url`
- KisahSukses: `mahasiswa.foto_url`, `foto_url`
- Alumni: `mahasiswa.foto_url`
- Dosen: `foto_url`

---

## 📰 Berita (News)

### GET /api/berita
List semua berita dengan pagination

**Query Parameters:**
- `exclude_prestasi` (boolean) - Exclude berita prestasi
- `search` (string) - Cari di judul/isi
- `tanggal_dari` (date) - YYYY-MM-DD
- `tanggal_sampai` (date) - YYYY-MM-DD
- `per_page` (int) - Default: 10

**cURL Test:**
```bash
curl -X GET "http://127.0.0.1:8000/api/berita?per_page=5"
```

**Response:**
```json
{
  "success": true,
  "data": {
    "data": [
      {
        "id": 1,
        "judul": "Judul Berita",
        "isi": "Konten berita...",
        "gambar": "berita/image.jpg",
        "gambar_url": "http://127.0.0.1:8000/storage/berita/image.jpg",
        "penulis": "Admin",
        "tanggal": "2025-11-19",
        "is_prestasi": 0
      }
    ],
    "current_page": 1,
    "per_page": 5,
    "total": 50
  }
}
```

### GET /api/berita/{id}
**cURL Test:**
```bash
curl -X GET "http://127.0.0.1:8000/api/berita/1"
```

---

## 📚 Kurikulum (Curriculum)

### GET /api/kurikulum
List mata kuliah (8 fields only)

**Database Fields:**
- `id`, `kode_matkul`, `nama_matkul`, `semester`, `sks`, `deskripsi`, `created_at`, `updated_at`

**Query Parameters:**
- `semester` (int) - Filter 1-8
- `search` (string) - Cari kode/nama matkul
- `sort_by` (string) - Default: semester
- `sort_order` (string) - asc/desc
- `per_page` (int) - Default: 50

**cURL Test:**
```bash
curl -X GET "http://127.0.0.1:8000/api/kurikulum?semester=3&per_page=10"
```

**Response:**
```json
{
  "success": true,
  "data": {
    "data": [
      {
        "id": 1,
        "kode_matkul": "TIF301",
        "nama_matkul": "Pemrograman Web",
        "semester": 3,
        "sks": 3,
        "deskripsi": "Mata kuliah pemrograman web...",
        "created_at": "2025-11-19T10:00:00.000000Z",
        "updated_at": "2025-11-19T10:00:00.000000Z"
      }
    ]
  },
  "message": "Data kurikulum berhasil diambil"
}
```

### GET /api/kurikulum-semester/{semester}
Get mata kuliah per semester

**cURL Test:**
```bash
curl -X GET "http://127.0.0.1:8000/api/kurikulum-semester/3"
```

### GET /api/kurikulum-statistics
Statistik kurikulum per semester

**cURL Test:**
```bash
curl -X GET "http://127.0.0.1:8000/api/kurikulum-statistics"
```

**Response:**
```json
{
  "success": true,
  "data": {
    "total_matkul": 40,
    "total_sks": 144,
    "by_semester": [
      {"semester": 1, "total_matkul": 8, "total_sks": 20},
      {"semester": 2, "total_matkul": 7, "total_sks": 18}
    ]
  }
}
```

### POST /api/kurikulum
Create mata kuliah

**Request Body:**
```json
{
  "kode_matkul": "TIF301",
  "nama_matkul": "Pemrograman Web",
  "semester": 3,
  "sks": 3,
  "deskripsi": "Mata kuliah yang membahas..."
}
```

**cURL Test:**
```bash
curl -X POST "http://127.0.0.1:8000/api/kurikulum" \
  -H "Content-Type: application/json" \
  -d '{
    "kode_matkul": "TIF301",
    "nama_matkul": "Pemrograman Web",
    "semester": 3,
    "sks": 3,
    "deskripsi": "Mata kuliah pemrograman web"
  }'
```

### PUT /api/kurikulum/{id}
Update mata kuliah

**cURL Test:**
```bash
curl -X PUT "http://127.0.0.1:8000/api/kurikulum/1" \
  -H "Content-Type: application/json" \
  -d '{
    "kode_matkul": "TIF301",
    "nama_matkul": "Pemrograman Web Lanjut",
    "semester": 3,
    "sks": 3,
    "deskripsi": "Updated description"
  }'
```

### DELETE /api/kurikulum/{id}
Delete mata kuliah

**cURL Test:**
```bash
curl -X DELETE "http://127.0.0.1:8000/api/kurikulum/1"
```

**⚠️ Important:** NO `cover_foto` field in database

---

## 🎓 Tracer Study

### GET /api/tracer-study
Data lengkap tracer study alumni dengan filter

**Database Fields (13 only):**
- `nim`, `tahun_survey`, `status_pekerjaan`, `nama_perusahaan`, `posisi`, `bidang_pekerjaan`, `gaji`, `waktu_tunggu_kerja`, `kesesuaian_bidang_studi`, `kepuasan_prodi`, `saran_prodi`, `kompetensi_didapat`, `saran_pengembangan`

**Query Parameters:**
- `tahun_survey` (int) - Filter tahun
- `status_pekerjaan` (string) - "Bekerja Full Time", "Bekerja Part Time", "Wiraswasta", "Melanjutkan Studi", "Belum Bekerja", "Freelancer"
- `kesesuaian_bidang_studi` (string) - "Sangat Sesuai", "Sesuai", "Cukup Sesuai", "Kurang Sesuai", "Tidak Sesuai"
- `waktu_tunggu_min` (int) - Bulan minimum
- `waktu_tunggu_max` (int) - Bulan maksimum
- `gaji_min` (decimal)
- `gaji_max` (decimal)
- `search` (string) - Cari nama/perusahaan/posisi
- `per_page` (int) - Default: 15

**cURL Test:**
```bash
# Get all
curl -X GET "http://127.0.0.1:8000/api/tracer-study"

# Filter by kesesuaian & gaji
curl -X GET "http://127.0.0.1:8000/api/tracer-study?kesesuaian_bidang_studi=Sangat%20Sesuai&gaji_min=5000000"

# Search
curl -X GET "http://127.0.0.1:8000/api/tracer-study?search=Software"

# Complex filter
curl -X GET "http://127.0.0.1:8000/api/tracer-study?status_pekerjaan=Bekerja%20Full%20Time&waktu_tunggu_max=6&gaji_min=5000000&per_page=20"
```

**Response:**
```json
{
  "success": true,
  "data": {
    "data": [
      {
        "id": 1,
        "nim": "20200001",
        "alumni": {
          "nim": "20200001",
          "nama": "John Doe",
          "email": "john@email.com",
          "prodi": "Teknik Informatika",
          "tahun_lulus": 2024,
          "foto": "mahasiswa/foto.jpg",
          "foto_url": "http://127.0.0.1:8000/storage/mahasiswa/foto.jpg"
        },
        "tahun_survey": 2025,
        "status_pekerjaan": "Bekerja Full Time",
        "nama_perusahaan": "PT Tech Indonesia",
        "posisi": "Software Engineer",
        "bidang_pekerjaan": "IT & Software",
        "gaji": 8000000,
        "waktu_tunggu_kerja": 3,
        "kesesuaian_bidang_studi": "Sangat Sesuai",
        "kepuasan_prodi": 5,
        "saran_prodi": "Perbanyak praktikum...",
        "kompetensi_didapat": "Programming, Problem Solving",
        "saran_pengembangan": "Update teknologi AI/ML"
      }
    ],
    "current_page": 1,
    "total": 100
  }
}
```

### GET /api/tracer-study/{id}
**cURL Test:**
```bash
curl -X GET "http://127.0.0.1:8000/api/tracer-study/1"
```

### GET /api/tracer-study-statistics
Statistik lengkap tracer study

**Query Parameters:**
- `tahun_survey` (int) - Optional, default: latest year

**cURL Test:**
```bash
curl -X GET "http://127.0.0.1:8000/api/tracer-study-statistics?tahun_survey=2025"
```

**Response:**
```json
{
  "success": true,
  "data": {
    "total_respondents": 150,
    "status_pekerjaan": {
      "Bekerja Full Time": 80,
      "Bekerja Part Time": 15,
      "Wiraswasta": 10
    },
    "waktu_tunggu_kerja_distribution": {
      "0-3_bulan": 60,
      "4-6_bulan": 40,
      "7-12_bulan": 25,
      "lebih_12_bulan": 10
    },
    "kesesuaian_bidang_studi": {
      "Sangat Sesuai": 50,
      "Sesuai": 60
    },
    "avg_gaji": 7500000.50,
    "avg_kepuasan_prodi": 4.2,
    "avg_waktu_tunggu_kerja": 4.5,
    "employment_rate": 90.67,
    "top_companies": [
      {"nama_perusahaan": "PT Tech", "total": 15}
    ]
  },
  "tahun_survey": 2025
}
```

### GET /api/tracer-study-testimonials
Testimoni alumni

**cURL Test:**
```bash
curl -X GET "http://127.0.0.1:8000/api/tracer-study-testimonials?per_page=5"
```

### POST /api/tracer-study
Create tracer study entry

**Request Body:**
```json
{
  "nim": "20200001",
  "tahun_survey": 2025,
  "status_pekerjaan": "Bekerja Full Time",
  "nama_perusahaan": "PT Tech Indonesia",
  "posisi": "Software Engineer",
  "bidang_pekerjaan": "IT & Software",
  "gaji": 8000000,
  "waktu_tunggu_kerja": 3,
  "kesesuaian_bidang_studi": "Sangat Sesuai",
  "kepuasan_prodi": 5,
  "saran_prodi": "Perbanyak praktikum",
  "kompetensi_didapat": "Programming, Problem Solving",
  "saran_pengembangan": "Update AI/ML"
}
```

**cURL Test:**
```bash
curl -X POST "http://127.0.0.1:8000/api/tracer-study" \
  -H "Content-Type: application/json" \
  -d '{
    "nim": "20200001",
    "tahun_survey": 2025,
    "status_pekerjaan": "Bekerja Full Time",
    "nama_perusahaan": "PT Tech",
    "posisi": "Software Engineer",
    "gaji": 8000000,
    "waktu_tunggu_kerja": 3
  }'
```

**⚠️ Important Field Changes:**
- Use `posisi` (NOT `posisi_pekerjaan`)
- Single `gaji` field (NOT `gaji_pertama`/`gaji_sekarang`)
- Use `waktu_tunggu_kerja` as integer months (NOT `bulan_sejak_lulus`)
- Single `kepuasan_prodi` 1-5 (NOT multiple `kepuasan_*` fields)
- Direct `mahasiswa` relationship via `nim` (NOT through `alumni_id`)

---

## 💼 Project Mahasiswa

### GET /api/project
List project mahasiswa

**Query Parameters:**
- `search` (string) - Judul/deskripsi/nama
- `tahun` (int)
- `kategori` (string)
- `status` (string)

**cURL Test:**
```bash
curl -X GET "http://127.0.0.1:8000/api/project?kategori=Web%20Development"
```

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
        "nama": "John Doe",
        "email": "john@email.com",
        "kelas": "TI-3A"
      },
      "judul_project": "Sistem Informasi Kampus",
      "deskripsi": "Project web-based...",
      "tahun": 2024,
      "kategori": "Web Development",
      "teknologi": "Laravel, Vue.js",
      "cover_image": "projects/cover.jpg",
      "cover_image_url": "http://127.0.0.1:8000/storage/projects/cover.jpg",
      "galeri": ["projects/img1.jpg"],
      "galeri_urls": ["http://127.0.0.1:8000/storage/projects/img1.jpg"]
    }
  ]
}
```

### GET /api/project/{id}
**cURL Test:**
```bash
curl -X GET "http://127.0.0.1:8000/api/project/1"
```

---

## 🏆 Kisah Sukses (Success Stories)

### GET /api/kisah-sukses
List kisah sukses alumni

**Database Fields (8 only):**
- `nim`, `judul`, `kisah`, `pencapaian`, `tahun_pencapaian`, `foto`, `status`, `timestamps`

**Query Parameters:**
- `status` (string) - "Published"/"Draft"
- `search` (string)
- `per_page` (int) - Default: 10

**cURL Test:**
```bash
curl -X GET "http://127.0.0.1:8000/api/kisah-sukses?status=Published"
```

**Response:**
```json
{
  "success": true,
  "data": {
    "data": [
      {
        "id": 1,
        "nim": "20200001",
        "mahasiswa": {
          "nim": "20200001",
          "nama": "John Doe",
          "foto": "mahasiswa/foto.jpg",
          "foto_url": "http://127.0.0.1:8000/storage/mahasiswa/foto.jpg"
        },
        "judul": "Dari Mahasiswa Menjadi CTO",
        "kisah": "Perjalanan karir saya dimulai...",
        "pencapaian": "CTO at PT Tech",
        "tahun_pencapaian": 2024,
        "foto": "kisah-sukses/foto.jpg",
        "foto_url": "http://127.0.0.1:8000/storage/kisah-sukses/foto.jpg",
        "status": "Published"
      }
    ]
  }
}
```

### GET /api/kisah-sukses/{id}
**cURL Test:**
```bash
curl -X GET "http://127.0.0.1:8000/api/kisah-sukses/1"
```

### GET /api/kisah-sukses-statistics
**cURL Test:**
```bash
curl -X GET "http://127.0.0.1:8000/api/kisah-sukses-statistics"
```

### POST /api/kisah-sukses
Create kisah sukses

**Request Body (multipart/form-data):**
```
nim: 20200001
judul: Dari Mahasiswa ke CTO
kisah: Full story text...
pencapaian: CTO at PT Tech
tahun_pencapaian: 2024
foto: [file upload]
status: Published
```

**cURL Test:**
```bash
curl -X POST "http://127.0.0.1:8000/api/kisah-sukses" \
  -F "nim=20200001" \
  -F "judul=Success Story Title" \
  -F "kisah=Full story text here..." \
  -F "pencapaian=CEO at Startup" \
  -F "tahun_pencapaian=2024" \
  -F "foto=@/path/to/photo.jpg" \
  -F "status=Published"
```

**⚠️ Important:** 
- Fields `kisah`, `pencapaian`, `tahun_pencapaian` are REQUIRED
- Use `foto` field (NOT `foto_utama` or `galeri_foto`)
- Direct `mahasiswa` relationship (NOT through `alumni`)

---

## 🔬 Penelitian (Research)

### GET /api/penelitian
**Query Parameters:**
- `jenis_penelitian` (string)
- `status` (string) - "Draft", "Sedang Berjalan", "Selesai"
- `search` (string)
- `per_page` (int) - Default: 10

**cURL Test:**
```bash
curl -X GET "http://127.0.0.1:8000/api/penelitian?status=Selesai"
```

**Response:**
```json
{
  "success": true,
  "data": {
    "data": [
      {
        "id": 1,
        "judul_penelitian": "AI dalam Pendidikan",
        "ketuaPeneliti": {
          "nama": "Dr. Jane Smith",
          "nidn": "123456"
        },
        "jenis_penelitian": "Penelitian Dasar",
        "tahun_mulai": "2024",
        "tahun_selesai": "2025",
        "dana": 50000000,
        "status": "Selesai"
      }
    ]
  }
}
```

### GET /api/penelitian-statistics
**cURL Test:**
```bash
curl -X GET "http://127.0.0.1:8000/api/penelitian-statistics"
```

---

## 📝 PKM (Student Program)

### GET /api/pkm
**Query Parameters:**
- `jenis_pkm` (string)
- `status` (string)
- `search` (string)
- `per_page` (int) - Default: 10

**cURL Test:**
```bash
curl -X GET "http://127.0.0.1:8000/api/pkm"
```

**Response:**
```json
{
  "success": true,
  "data": {
    "data": [
      {
        "id": 1,
        "judul_pkm": "Aplikasi Pembelajaran",
        "deskripsi": "Deskripsi PKM...",
        "jenis_pkm": "PKM-KC",
        "dosenPembimbing": {
          "nama": "Dr. John",
          "nidn": "123456"
        },
        "mahasiswas": [
          {
            "nim": "20200001",
            "nama": "Jane Doe",
            "peran": "Ketua"
          }
        ],
        "dana": 12500000,
        "status": "Selesai"
      }
    ]
  }
}
```

### GET /api/pkm-statistics
**cURL Test:**
```bash
curl -X GET "http://127.0.0.1:8000/api/pkm-statistics"
```

---

## 🎓 Alumni

### GET /api/alumni
**Query Parameters:**
- `tahun_lulus` (int)
- `prodi` (string)
- `search` (string)
- `per_page` (int) - Default: 15

**cURL Test:**
```bash
curl -X GET "http://127.0.0.1:8000/api/alumni?tahun_lulus=2024"
```

**Response:**
```json
{
  "success": true,
  "data": {
    "data": [
      {
        "id": 1,
        "nim": "20200001",
        "mahasiswa": {
          "nim": "20200001",
          "nama": "John Doe",
          "email": "john@email.com",
          "prodi": "Teknik Informatika",
          "foto": "mahasiswa/foto.jpg",
          "foto_url": "http://127.0.0.1:8000/storage/mahasiswa/foto.jpg"
        },
        "tahun_lulus": 2024,
        "ipk": 3.75
      }
    ]
  }
}
```

### GET /api/alumni-statistics
**cURL Test:**
```bash
curl -X GET "http://127.0.0.1:8000/api/alumni-statistics"
```

---

## 🎯 Field Changes Summary

| Module | Removed Fields | Actual DB Fields |
|--------|---------------|------------------|
| **TracerStudy** | alumni_id, bulan_sejak_lulus, posisi_pekerjaan, gaji_pertama/sekarang, kompetensi_*, kepuasan_*, status_survey, tanggal_survey | nim, posisi, gaji, waktu_tunggu_kerja, kepuasan_prodi (1-5) |
| **KisahSukses** | kategori, quote, foto_utama, galeri_foto, video_url, tags, is_featured, views | judul, kisah (required), pencapaian (required), tahun_pencapaian (required), foto, status |
| **Kurikulum** | cover_foto | 8 fields only: kode_matkul, nama_matkul, semester, sks, deskripsi, timestamps |

---

## 🔧 JavaScript Integration

### Basic Fetch
```javascript
const API_URL = 'http://127.0.0.1:8000/api';

async function fetchAPI(endpoint) {
  const response = await fetch(`${API_URL}${endpoint}`);
  const json = await response.json();
  return json.success ? json.data : null;
}

// Usage
const tracerStudy = await fetchAPI('/tracer-study?gaji_min=5000000');
const kurikulum = await fetchAPI('/kurikulum?semester=3');
```

### React Hook
```jsx
function useAPI(endpoint) {
  const [data, setData] = useState(null);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    fetch(`http://127.0.0.1:8000/api${endpoint}`)
      .then(res => res.json())
      .then(json => setData(json.data))
      .finally(() => setLoading(false));
  }, [endpoint]);

  return { data, loading };
}
```

---

## 📌 Testing All Endpoints

### Quick Test Script
```bash
#!/bin/bash
BASE="http://127.0.0.1:8000/api"

echo "Testing APIs..."
curl -s $BASE/berita | jq '.success'
curl -s $BASE/kurikulum | jq '.success'
curl -s $BASE/tracer-study | jq '.success'
curl -s $BASE/project | jq '.success'
curl -s $BASE/kisah-sukses | jq '.success'
curl -s $BASE/penelitian | jq '.success'
curl -s $BASE/pkm | jq '.success'
curl -s $BASE/alumni | jq '.success'

echo "Testing Statistics..."
curl -s $BASE/tracer-study-statistics | jq '.success'
curl -s $BASE/kurikulum-statistics | jq '.success'
curl -s $BASE/kisah-sukses-statistics | jq '.success'
```

---

## ✅ Checklist

Before integration:
- [ ] Laravel server running: `php artisan serve`
- [ ] Test endpoints: All return `{"success": true}`
- [ ] CORS configured for frontend URL
- [ ] Database has test data
- [ ] Image URLs return full paths

---

**Last Updated:** November 2025  
**Laravel Version:** 12.x  
**Database:** MySQL (db_mytpl)
