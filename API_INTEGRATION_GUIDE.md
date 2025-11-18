# API Integration Guide - UTS MVC

**Base URL:** `http://localhost:8000/api`

## Quick Reference

All endpoints return standardized JSON:
```json
{
  "success": true,
  "data": [...] 
}
```

## Core Endpoints

### 1. Dosen (Lecturers)
```bash
# Get all dosen
GET /api/dosen

# Get single dosen
GET /api/dosen/{id}

# Search dosen
GET /api/dosen?search=Ahmad&status=Aktif
```

**Response Fields:**
- `id`, `nidn`, `nama`, `email`, `no_hp`
- `jabatan`, `pendidikan_terakhir`, `bidang_keahlian`
- `google_scholar_link`, `sinta_link`, `scopus_link`
- `foto_url`, `status`

### 2. Mahasiswa (Students)
```bash
# Get all mahasiswa
GET /api/mahasiswa

# Get single mahasiswa
GET /api/mahasiswa/{id}

# Filter mahasiswa
GET /api/mahasiswa?status=Aktif&tahun_masuk=2020
```

**Response Fields:**
- `id`, `nim`, `nama`, `email`, `no_hp`
- `tahun_masuk`, `tahun_lulus`, `kelas`, `status`
- `foto`, `prodi`

### 3. Alumni
```bash
# Get all alumni
GET /api/alumni

# Search alumni
GET /api/alumni?search=Ahmad&pekerjaan_saat_ini=Bekerja

# Get alumni statistics
GET /api/alumni-statistics
```

**Response Fields:**
- `nim`, `nama`, `email`
- `pekerjaan_saat_ini`, `nama_perusahaan`, `posisi_jabatan`
- `gaji_pertama`, `gaji_saat_ini`
- `linkedin`, `instagram`, `pesan_alumni`

### 4. Berita (News)
```bash
# Get all berita (paginated)
GET /api/berita

# Get single berita
GET /api/berita/{id}

# Filter berita
GET /api/berita?kategori=Event&is_prestasi=true
```

**Response Fields:**
- `id`, `judul`, `slug`, `konten`
- `gambar`, `gambar_url`
- `penulis`, `tanggal_publish`, `kategori`
- `is_prestasi`, `views`

### 5. Pengumuman (Announcements)
```bash
# Get all pengumuman (paginated)
GET /api/pengumuman

# Filter by priority
GET /api/pengumuman?prioritas=tinggi&aktif=true
```

**Response Fields:**
- `id`, `judul`, `isi`
- `gambar`, `gambar_url`
- `penulis`, `tanggal_mulai`, `tanggal_selesai`
- `prioritas` (tinggi/sedang/rendah), `aktif`

### 6. Agenda (Events)
```bash
# Get upcoming agenda
GET /api/agenda?upcoming=true&aktif=true

# Filter by month
GET /api/agenda?month=11&year=2025

# Filter by kategori
GET /api/agenda?kategori=seminar
```

**Response Fields:**
- `id`, `judul`, `deskripsi`
- `tanggal_mulai`, `tanggal_selesai`, `lokasi`
- `kategori` (seminar/workshop/acara)
- `penyelenggara`, `kontak`
- `poster`, `gambar_url`, `aktif`

### 7. Galeri (Gallery)
```bash
# Get all gallery (paginated)
GET /api/galeri

# Get by kategori
GET /api/galeri-kategori/akademik

# Filter featured
GET /api/galeri?tampilkan_di_home=true
```

**Kategori:** akademik, kemahasiswaan, kegiatan, prestasi, fasilitas

**Response Fields:**
- `id`, `judul`, `deskripsi`
- `foto`, `foto_url`
- `kategori`, `tanggal_kegiatan`
- `fotografer`, `tampilkan_di_home`, `urutan`

### 8. Penelitian (Research)
```bash
# Get all penelitian
GET /api/penelitian

# Get by dosen
GET /api/penelitian-dosen/{dosenId}

# Get statistics
GET /api/penelitian-statistics

# Filter
GET /api/penelitian?tahun=2024&status=Sedang Berjalan
```

**Response Fields:**
- `id`, `judul_penelitian`, `deskripsi`
- `tahun`, `jenis_penelitian`, `sumber_dana`, `dana`
- `status`, `tanggal_mulai`, `tanggal_selesai`
- `output`, `file_dokumen`
- `ketua_peneliti_id`, `ketua_peneliti` (object)

**⚠️ Important:** Use `judul_penelitian` (not `judul`), `dana` (not `jumlah_dana`), `ketua_peneliti_id` (not `dosen_id`)

### 9. PKM (Student Community Projects)
```bash
# Get all PKM
GET /api/pkm

# Get by dosen
GET /api/pkm-dosen/{dosenId}

# Get by mahasiswa
GET /api/pkm-mahasiswa/{mahasiswaId}

# Get statistics
GET /api/pkm-statistics

# Filter
GET /api/pkm?tahun=2024&jenis_pkm=PKM-KC&status=Didanai
```

**Response Fields:**
- `id`, `judul_pkm`, `deskripsi`
- `tahun`, `jenis_pkm` (PKM-KC/PKM-K/PKM-M/PKM-T/PKM-R)
- `status` (Didanai/Diajukan/Selesai)
- `dana`, `pencapaian`, `file_dokumen`
- `dosen_pembimbing_id`, `dosen_pembimbing` (object)
- `mahasiswa` (array)

**⚠️ Important:** Use `dana` (not `biaya`)

### 10. Kisah Sukses (Success Stories)
```bash
# Get all stories
GET /api/kisah-sukses

# Get featured stories
GET /api/kisah-sukses-featured

# Get statistics
GET /api/kisah-sukses-statistics

# Filter
GET /api/kisah-sukses?status=Published&tahun_pencapaian=2024
```

**Response Fields (10 columns):**
- `id`, `nim`
- `mahasiswa` (object with nama, email)
- `judul` - Story title
- `kisah` - Full story text (required field)
- `pencapaian` - Achievement description (required)
- `tahun_pencapaian` - Year of achievement (required)
- `foto` - Photo filename
- `foto_url` - Full photo URL
- `status` - Draft/Published/Archived

**⚠️ Important:** 
- Direct `mahasiswa` relationship (not through `alumni`)
- Field `kisah` is REQUIRED (not nullable)
- Field `pencapaian` is REQUIRED
- Field `tahun_pencapaian` is REQUIRED
- Use `foto` (not `foto_utama` or `galeri_foto`)

**Form Fields for Create/Update:**
```
nim (required, exists in mahasiswa)
judul (required, max 255)
kisah (required, text)
pencapaian (required, max 255)
tahun_pencapaian (required, integer, 2000-current year)
foto (optional, image file max 2MB)
status (required, Draft/Published/Archived)
```

### 11. Tracer Study (Alumni Survey)
```bash
# Get all responses
GET /api/tracer-study

# Get statistics
GET /api/tracer-study-statistics

# Get testimonials
GET /api/tracer-study-testimonials

# Filter
GET /api/tracer-study?tahun_survey=2024&status_pekerjaan=Bekerja Full Time
```

**Response Fields (16 columns):**
- `id`, `nim`, `mahasiswa` (object)
- `tahun_survey` (required)
- `status_pekerjaan` (required) - Employment status text
- `nama_perusahaan` (nullable)
- `posisi` (nullable) - Job position
- `bidang_pekerjaan` (nullable) - Field of work
- `gaji` (nullable, numeric) - Single salary field
- `waktu_tunggu_kerja` (nullable, integer) - Months waiting for job
- `kesesuaian_bidang_studi` (nullable) - Field compatibility
- `kepuasan_prodi` (nullable, 1-5) - Program satisfaction rating
- `saran_prodi` (nullable, text) - Suggestions for program
- `kompetensi_didapat` (nullable, text) - Competencies gained
- `saran_pengembangan` (nullable, text) - Development suggestions

**⚠️ Important:** 
- Simplified 16-column schema (not 25+ fields)
- No `status_survey`, `alumni.mahasiswa` chain
- No multiple `kompetensi_*` fields (combined into `kompetensi_didapat`)
- No separate `gaji_pertama`/`gaji_sekarang` (single `gaji` field)
- No `kepuasan_kurikulum`/`kepuasan_dosen`/`kepuasan_fasilitas` (only `kepuasan_prodi`)
- Direct `mahasiswa` relationship (use `exists:mahasiswa,nim`)

**Form Fields for Create/Update:**
```
nim (required, exists in mahasiswa)
tahun_survey (required, integer, 2000-current year)
status_pekerjaan (required, string max 100)
nama_perusahaan (optional, max 255)
posisi (optional, max 255)
bidang_pekerjaan (optional, max 255)
gaji (optional, numeric)
waktu_tunggu_kerja (optional, integer months)
kesesuaian_bidang_studi (optional, string max 100)
kepuasan_prodi (optional, integer 1-5)
saran_prodi (optional, text)
kompetensi_didapat (optional, text)
saran_pengembangan (optional, text)
```

### 12. Prestasi (Achievements)
```bash
# Get all prestasi
GET /api/prestasi

# Get statistics
GET /api/prestasi/statistics

# Filter
GET /api/prestasi?tingkat=Nasional&jenis=Teknologi&tahun=2024
```

**Response Fields:**
- `id`, `nim`, `mahasiswa` (object)
- `nama_prestasi`, `tingkat_prestasi` (Internasional/Nasional/Regional/Lokal)
- `jenis_prestasi` (Akademik/Olahraga/Seni/Teknologi/Lainnya)
- `penyelenggara`, `tanggal_prestasi`, `deskripsi`
- `foto`, `sertifikat`

### 13. Projects
```bash
# Get all projects
GET /api/project

# Get single project
GET /api/project/{id}

# Filter
GET /api/project?tahun=2024&kategori=Web Application&status=Published
```

**Response Fields:**
- `id`, `nim`, `mahasiswa` (object)
- `judul_project`, `deskripsi`
- `tahun`, `tahun_selesai`, `kategori`, `teknologi`
- `dosen_pembimbing`
- `link_github`, `link_demo`, `status`
- `cover_image`, `galeri` (array)

### 14. Matakuliah (Courses)
```bash
# Get all courses
GET /api/matakuliah

# Filter
GET /api/matakuliah?semester=1&status_wajib=true
```

**Response Fields:**
- `id`, `kode_mk`, `nama_mk`
- `sks`, `semester`
- `kurikulum_tahun`, `status_wajib`

### 15. Profil Prodi (Program Profile)
```bash
# Get program profile (single record)
GET /api/profil-prodi
```

**Response Fields:**
- `id`, `nama_prodi`
- `visi`, `misi`, `deskripsi`
- `akreditasi`, `logo`
- `kontak_email`, `kontak_telepon`, `alamat`

### 16. Peraturan (Regulations/Documents)
```bash
# Get all peraturan (grouped by kategori)
GET /api/peraturan

# Get by kategori
GET /api/peraturan-kategori/Akademik

# Get single document
GET /api/peraturan/{id}
```

**Kategori:** Akademik, Kemahasiswaan, Administratif, Keuangan

**Response Fields:**
- `id`, `judul`, `deskripsi`
- `kategori`, `jenis`
- `file_url`, `file_name`, `file_size_formatted`
- `urutan`, `is_active`

---

## JavaScript/React Integration

### Basic Fetch Function
```javascript
const API_URL = 'http://localhost:8000/api';

async function fetchAPI(endpoint) {
  try {
    const response = await fetch(`${API_URL}${endpoint}`);
    const json = await response.json();
    
    if (json.success) {
      return json.data;
    } else {
      throw new Error(json.message || 'API Error');
    }
  } catch (error) {
    console.error('Fetch error:', error);
    throw error;
  }
}

// Usage
const dosen = await fetchAPI('/dosen');
const berita = await fetchAPI('/berita?kategori=Event');
const penelitian = await fetchAPI('/penelitian-dosen/1');
```

### React Hook Example
```jsx
import { useState, useEffect } from 'react';

function useAPI(endpoint) {
  const [data, setData] = useState(null);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState(null);

  useEffect(() => {
    fetch(`http://localhost:8000/api${endpoint}`)
      .then(res => res.json())
      .then(json => {
        if (json.success) {
          setData(json.data);
        } else {
          setError(json.message);
        }
      })
      .catch(err => setError(err.message))
      .finally(() => setLoading(false));
  }, [endpoint]);

  return { data, loading, error };
}

// Usage in component
function DosenList() {
  const { data, loading, error } = useAPI('/dosen');
  
  if (loading) return <div>Loading...</div>;
  if (error) return <div>Error: {error}</div>;
  
  return (
    <div>
      {data.map(dosen => (
        <div key={dosen.id}>{dosen.nama}</div>
      ))}
    </div>
  );
}
```

### Next.js Example
```javascript
// app/dosen/page.js
export default async function DosenPage() {
  const res = await fetch('http://localhost:8000/api/dosen');
  const json = await res.json();
  const dosen = json.data;

  return (
    <div>
      {dosen.map(d => (
        <div key={d.id}>
          <h3>{d.nama}</h3>
          <p>{d.jabatan}</p>
        </div>
      ))}
    </div>
  );
}
```

---

## Testing APIs

### Quick Test All Endpoints
```bash
# Save this as test-api.sh
#!/bin/bash

BASE_URL="http://localhost:8000/api"

echo "Testing Core Endpoints..."
curl -s $BASE_URL/dosen | jq '.success'
curl -s $BASE_URL/mahasiswa | jq '.success'
curl -s $BASE_URL/alumni | jq '.success'
curl -s $BASE_URL/berita | jq '.success'
curl -s $BASE_URL/pengumuman | jq '.success'
curl -s $BASE_URL/agenda | jq '.success'
curl -s $BASE_URL/galeri | jq '.success'
curl -s $BASE_URL/penelitian | jq '.success'
curl -s $BASE_URL/pkm | jq '.success'
curl -s $BASE_URL/kisah-sukses | jq '.success'
curl -s $BASE_URL/tracer-study | jq '.success'
curl -s $BASE_URL/prestasi | jq '.success'
curl -s $BASE_URL/project | jq '.success'
curl -s $BASE_URL/matakuliah | jq '.success'
curl -s $BASE_URL/profil-prodi | jq '.success'
curl -s $BASE_URL/peraturan | jq '.success'

echo "Testing Statistics..."
curl -s $BASE_URL/penelitian-statistics | jq '.success'
curl -s $BASE_URL/pkm-statistics | jq '.success'
curl -s $BASE_URL/kisah-sukses-statistics | jq '.success'
curl -s $BASE_URL/tracer-study-statistics | jq '.success'
curl -s $BASE_URL/alumni-statistics | jq '.success'
curl -s $BASE_URL/prestasi/statistics | jq '.success'

echo "Testing Filters..."
curl -s "$BASE_URL/penelitian-dosen/1" | jq '.success'
curl -s "$BASE_URL/pkm-dosen/1" | jq '.success'
curl -s "$BASE_URL/pkm-mahasiswa/1" | jq '.success'
curl -s "$BASE_URL/kisah-sukses-featured" | jq '.success'
curl -s "$BASE_URL/tracer-study-testimonials" | jq '.success'
curl -s "$BASE_URL/galeri-kategori/akademik" | jq '.success'
curl -s "$BASE_URL/peraturan-kategori/Akademik" | jq '.success'
curl -s "$BASE_URL/agenda?upcoming=true" | jq '.success'

echo "Done!"
```

### Test Individual Endpoint
```bash
# Test with pretty JSON
curl http://localhost:8000/api/dosen | jq

# Test single record
curl http://localhost:8000/api/dosen/1 | jq

# Test with filters
curl "http://localhost:8000/api/mahasiswa?status=Aktif" | jq

# Test statistics
curl http://localhost:8000/api/penelitian-statistics | jq

# Check response time
curl -w "\nTime: %{time_total}s\n" http://localhost:8000/api/berita

# Check only success field
curl -s http://localhost:8000/api/dosen | jq '.success'
```

---

## Common Errors & Solutions

### Error: CORS Policy
**Problem:** `Access to fetch... has been blocked by CORS policy`

**Solution:** Add your frontend URL to `config/cors.php`:
```php
'allowed_origins' => [
    'http://localhost:3000',
    'http://localhost:5173',
    'https://your-domain.com'
],
```

### Error: 500 Internal Server Error
**Problem:** Server error on specific endpoint

**Solution:** 
1. Check Laravel logs: `storage/logs/laravel.log`
2. Test with curl: `curl -v http://localhost:8000/api/endpoint`
3. Check database connection

### Error: 404 Not Found
**Problem:** Endpoint doesn't exist

**Solution:**
1. Verify route: `php artisan route:list | grep api`
2. Check spelling (case-sensitive)
3. Ensure Laravel server is running

### Error: Empty Response
**Problem:** `data` is empty array

**Solution:**
1. Check database has data: `php artisan tinker` → `Model::count()`
2. Check filters in query params
3. For paginated responses, check `per_page` and `total`

---

## Important Schema Notes

### ⚠️ Field Names to Remember

**Penelitian:**
- Use `judul_penelitian` (NOT `judul`)
- Use `dana` (NOT `jumlah_dana`)
- Use `ketua_peneliti_id` (NOT `dosen_id`)

**PKM:**
- Use `dana` (NOT `biaya`)
- Direct `dosen`/`mahasiswa` tables (NOT `tbl_dosen`/`tbl_mahasiswa`)

**Kisah Sukses:**
- Direct `mahasiswa` (NOT `alumni.mahasiswa`)
- Field `kisah` is REQUIRED (must not be empty)
- Field `pencapaian` is REQUIRED 
- Field `tahun_pencapaian` is REQUIRED
- Use `foto` (NOT `foto_utama` or `galeri_foto`)
- No `kategori`, `is_featured`, `views`, `tags`, `video_url`, `quote` fields

**Tracer Study:**
- 16 basic fields only (not 25+)
- Single `gaji` (NOT `gaji_pertama`/`gaji_sekarang`)
- Single `kepuasan_prodi` (NOT multiple `kepuasan_*` fields)
- Single `kompetensi_didapat` text (NOT multiple `kompetensi_*` fields)
- Field `posisi` (NOT `posisi_pekerjaan`)
- Direct `mahasiswa` (NOT through `alumni`)
- No `status_survey`, `tanggal_survey`, `bulan_sejak_lulus` fields

---

## Response Format

### Success Response
```json
{
  "success": true,
  "data": [...] // or {} for single record
}
```

### Paginated Response
```json
{
  "success": true,
  "data": {
    "current_page": 1,
    "data": [...],
    "per_page": 10,
    "total": 50,
    "last_page": 5
  }
}
```

### Error Response
```json
{
  "success": false,
  "message": "Error description"
}
```

---

## Quick Start Checklist

Before integrating to frontend:

- [ ] Laravel server running: `php artisan serve --port=8000`
- [ ] Test base endpoint: `curl http://localhost:8000/api/dosen`
- [ ] All responses return `{"success": true}`
- [ ] CORS configured for your frontend URL
- [ ] Database seeded with test data
- [ ] Frontend can reach API (no network errors)

---

**Last Updated:** November 13, 2025

**For detailed field descriptions, see:** `API_DOCUMENTATION.md`
