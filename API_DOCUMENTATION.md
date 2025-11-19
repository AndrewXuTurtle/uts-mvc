# API Documentation - UTS MVC

Base URL: `http://127.0.0.1:8000/api`

## 📰 Berita API

### GET /api/berita
**Query Parameters:**
- `exclude_prestasi`, `tanggal_dari`, `tanggal_sampai`, `search`, `per_page` (10)

**Response:** ✅ **Gambar dikirim dengan `gambar_url`** (Full URL)

---

## 📚 Kurikulum API (NEW)

### GET /api/kurikulum
**Query Parameters:**
- `semester`, `search`, `sort_by`, `sort_order`, `per_page` (50)

**Response:** ✅ **Cover foto dikirim dengan `cover_foto_url`** (Full URL)

### GET /api/kurikulum-semester/{semester}
Mata kuliah per semester

### GET /api/kurikulum-statistics
Statistik kurikulum

---

## 🎓 Tracer Study API (UPDATED)

### GET /api/tracer-study
**Query Parameters:**
- `tahun_survey`, `status_pekerjaan`, `kesesuaian_bidang_studi`
- `waktu_tunggu_min`, `waktu_tunggu_max` (bulan)
- `gaji_min`, `gaji_max`
- `search`, `sort_by`, `sort_order`, `per_page` (15)

**Response:**
```json
{
  "alumni": {
    "nim": "20200001",
    "nama": "John Doe",
    "foto_url": "http://127.0.0.1:8000/storage/mahasiswa/foto.jpg"
  },
  "tahun_survey": 2025,
  "status_pekerjaan": "Bekerja Full Time",
  "nama_perusahaan": "PT Tech Indonesia",
  "posisi": "Software Engineer",
  "gaji": 8000000,
  "waktu_tunggu_kerja": 3,
  "kesesuaian_bidang_studi": "Sangat Sesuai",
  "kepuasan_prodi": 5,
  "saran_prodi": "...",
  "kompetensi_didapat": "...",
  "saran_pengembangan": "..."
}
```

✅ **Data lengkap 13 fields + foto alumni URL**

### GET /api/tracer-study-statistics
**Response:**
```json
{
  "total_respondents": 150,
  "status_pekerjaan": {...},
  "waktu_tunggu_kerja_distribution": {
    "0-3_bulan": 60,
    "4-6_bulan": 40,
    "7-12_bulan": 25,
    "lebih_12_bulan": 10
  },
  "kesesuaian_bidang_studi": {...},
  "avg_gaji": 7500000.50,
  "avg_kepuasan_prodi": 4.2,
  "avg_waktu_tunggu_kerja": 4.5,
  "employment_rate": 90.67,
  "top_companies": [...]
}
```

### GET /api/tracer-study-testimonials
Testimoni alumni dengan foto

---

## 💼 Project Mahasiswa API

### GET /api/project
**Response:** 
- ✅ `cover_image_url` (Full URL)
- ✅ `galeri_urls` (Array of Full URLs)

---

## 📊 Summary

| API | Image Field | Status |
|-----|-------------|--------|
| Berita | `gambar_url` | ✅ Sudah ada |
| Kurikulum | `cover_foto_url` | ✅ Baru dibuat |
| Tracer Study | `foto_url` (alumni) | ✅ Updated dengan 13 fields + foto |
| Project | `cover_image_url` + `galeri_urls` | ✅ Sudah ada |

## 🎯 Filter Tracer Study untuk Front-End

```
GET /api/tracer-study?kesesuaian_bidang_studi=Sangat%20Sesuai&waktu_tunggu_max=6&gaji_min=5000000
```

**13 Database Fields:**
1. nim, 2. tahun_survey, 3. status_pekerjaan, 4. nama_perusahaan, 5. posisi, 
6. bidang_pekerjaan, 7. gaji, 8. waktu_tunggu_kerja, 9. kesesuaian_bidang_studi,
10. kepuasan_prodi, 11. saran_prodi, 12. kompetensi_didapat, 13. saran_pengembangan
