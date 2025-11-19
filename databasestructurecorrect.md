# Database Structure Verification Report
**Date:** November 19, 2025  
**Database:** db_mytpl  
**Purpose:** Compare SQL dump with Laravel Models and Controllers

---

## ✅ CORRECT TABLES (All Match)

### 1. **agenda**
- **SQL Columns:** id, judul, deskripsi, tanggal_mulai, tanggal_selesai, lokasi, penyelenggara, kategori, gambar, aktif, timestamps
- **Model:** `Agenda.php` - ✅ Correct
- **Status:** ✅ All fields match

### 2. **alumni**
- **SQL Columns:** id, nim, tahun_lulus, timestamps
- **Model:** `Alumni.php` 
  - Fillable: nim, tahun_lulus ✅
  - Foreign Key: nim → mahasiswa(nim) ✅
- **Status:** ✅ All fields match (simplified correctly)

### 3. **berita**
- **SQL Columns:** id, judul, isi, gambar, penulis, tanggal, is_prestasi, nama_mahasiswa, nim, program_studi, tingkat_prestasi, jenis_prestasi, penyelenggara, tanggal_prestasi, timestamps
- **Model:** `Berita.php` - ✅ Correct
- **Status:** ✅ All fields match

### 4. **dosen**
- **SQL Columns:** id, nidn, nama, email, no_hp, jenis_kelamin (ENUM), jabatan, pendidikan_terakhir, bidang_keahlian, alamat, foto, google_scholar_link, sinta_link, scopus_link, prodi, status (ENUM), timestamps
- **Model:** `Dosen.php` - ✅ Correct
- **Enum Values:** 
  - jenis_kelamin: 'Laki-laki', 'Perempuan' ✅
  - status: 'Aktif', 'Tidak Aktif' ✅
- **Status:** ✅ All fields match

### 5. **galeri**
- **SQL Columns:** id, judul, deskripsi, foto, kategori, tanggal, fotografer, tampilkan_di_home, urutan, timestamps
- **Model:** `Galeri.php` - ✅ Correct
- **Status:** ✅ All fields match

### 6. **kisah_sukses**
- **SQL Columns:** id, nim, judul, kisah, pencapaian, tahun_pencapaian, foto, status (ENUM: Draft/Published), timestamps
- **Model:** `KisahSukses.php`
  - Fillable: nim, judul, kisah, pencapaian, tahun_pencapaian, foto, status ✅
  - Foreign Key: nim → alumni(nim) ✅
- **Status:** ✅ All fields match

### 7. **kurikulum**
- **SQL Columns:** id, kode_matkul (UNIQUE), nama_matkul, semester, sks, deskripsi, timestamps
- **Model:** `Kurikulum.php` - ✅ Correct
- **Status:** ✅ All fields match

### 8. **mahasiswa**
- **SQL Columns:** id, nim (UNIQUE), nama, email (UNIQUE), no_hp, jenis_kelamin (ENUM), alamat, tempat_lahir, tanggal_lahir, tahun_masuk, kelas, foto, status (ENUM), tahun_lulus, prodi, timestamps
- **Model:** `Mahasiswa.php` - ✅ Correct
- **Enum Values:**
  - jenis_kelamin: 'Laki-laki', 'Perempuan' ✅
  - status: 'Aktif', 'Lulus', 'Cuti', 'DO' ✅
- **Status:** ✅ All fields match

### 9. **matakuliah**
- **SQL Columns:** mk_id (PK), kode_mk (UNIQUE), nama_mk, sks, semester, program_studi, kurikulum_tahun, deskripsi_singkat, status_wajib, timestamps
- **Model:** `Matakuliah.php`
  - Table name: 'matakuliah' ✅ (was tbl_matakuliah, now fixed)
- **Index:** Unique key on kode_mk ✅
- **Status:** ✅ All fields match (renamed from tbl_matakuliah)

### 10. **pengumuman**
- **SQL Columns:** id, judul, isi, gambar, prioritas, tanggal_mulai, tanggal_selesai, penulis, aktif, timestamps
- **Model:** `Pengumuman.php` - ✅ Correct
- **Status:** ✅ All fields match

### 11. **peraturan**
- **SQL Columns:** id, judul, deskripsi, kategori (ENUM), jenis (ENUM), file_path, file_name, file_size, urutan, is_active, timestamps
- **Model:** `Peraturan.php` - ✅ Correct
- **Enum Values:** 
  - kategori: Akademik, Kemahasiswaan, Administratif, Keuangan ✅
  - jenis: (13 types) ✅
- **Status:** ✅ All fields match

### 12. **profil_prodi**
- **SQL Columns:** id, nama_prodi, visi, misi, deskripsi, akreditasi, logo, kontak_email, kontak_telepon, alamat, timestamps
- **Model:** `ProfilProdi.php`
  - Table name: 'profil_prodi' ✅ (was tbl_profil_prodi, now fixed)
- **Status:** ✅ All fields match (renamed from tbl_profil_prodi)

### 13. **projects**
- **SQL Columns:** id, nim, judul_project, deskripsi, tahun, tahun_selesai, kategori, teknologi, dosen_pembimbing, cover_image, galeri (JSON), link_demo, link_github, status (ENUM), timestamps
- **Model:** `Project.php` - ✅ Correct
- **Foreign Key:** nim → mahasiswa(nim) ✅
- **Status:** ✅ All fields match

### 14. **sessions**
- **SQL Columns:** id (PK), user_id, ip_address, user_agent, payload, last_activity
- **Model:** Built-in Laravel session handler ✅
- **Status:** ✅ All fields match

### 15. **users**
- **SQL Columns:** id, name, email (UNIQUE), email_verified_at, password, remember_token, timestamps
- **Model:** `User.php` - ✅ Correct
- **Status:** ✅ All fields match

---

## ⚠️ ISSUES FOUND - REQUIRE FIXING

### 16. **penelitian** ⚠️ MISMATCH
**SQL Structure:**
```sql
id, judul_penelitian, deskripsi, tahun, jenis_penelitian, sumber_dana, 
dana, status, tanggal_mulai, tanggal_selesai, output, file_dokumen, 
ketua_peneliti_id, timestamps
```

**Model (Penelitian.php):**
```php
Fillable: judul_penelitian, deskripsi, tahun, jenis_penelitian, 
sumber_dana, dana, status, tanggal_mulai, tanggal_selesai, 
output, file_dokumen, ketua_peneliti_id
```

**Controller Issues:**
- ✅ FIXED: PenelitianController now uses correct field names
- ✅ Status values match: 'Draft', 'Sedang Berjalan', 'Selesai'

**Status:** ✅ NOW CORRECT (Fixed in previous session)

---

### 17. **pkm** ✅ NOW CORRECT
**SQL Structure:**
```sql
id, judul_pkm, deskripsi, tahun, jenis_pkm (ENUM), status, dana, 
pencapaian, file_dokumen, dosen_pembimbing_id, timestamps
```

**ENUM Values (jenis_pkm):**
- PKM-R (Riset)
- PKM-K (Kewirausahaan)
- PKM-M (Pengabdian Masyarakat)
- PKM-T (Karsa Cipta)
- PKM-KC (Karya Inovatif)
- PKM-AI (Artikel Ilmiah)
- PKM-GT (Gagasan Tertulis)

**Model (PKM.php):**
```php
Fillable: judul_pkm, deskripsi, tahun, jenis_pkm, status, dana, 
pencapaian, file_dokumen, dosen_pembimbing_id
```

**Controller:**
- ✅ FIXED: PKMController now uses correct field names
- ✅ Uses dosen_pembimbing_id (single dosen)
- ✅ Uses mahasiswa_nim[] array with peran

**Status:** ✅ NOW CORRECT (Fixed in previous session)

---

### 18. **pkm_mahasiswa** ✅ CORRECT
**SQL Structure:**
```sql
id, pkm_id (FK → pkm), nim (FK → mahasiswa), peran, timestamps
```

**Model Relationship:**
- PKM.php: mahasiswas() - Many-to-Many via 'pkm_mahasiswa' ✅
- Pivot fields: peran ✅

**Status:** ✅ All fields match

---

### 19. **penelitian_mahasiswa** ✅ CORRECT
**SQL Structure:**
```sql
id, penelitian_id (FK → penelitian), nim (FK → mahasiswa), peran, timestamps
```

**Model Relationship:**
- Penelitian.php: mahasiswas() - Many-to-Many via 'penelitian_mahasiswa' ✅
- Pivot fields: peran ✅

**Status:** ✅ All fields match

---

### 20. **tracer_study** ⚠️ EXTRA FIELDS IN MODEL

**SQL Structure (From Export):**
```sql
id, nim (FK → alumni), tahun_survey, status_pekerjaan (ENUM), 
nama_perusahaan, posisi, bidang_pekerjaan, gaji, waktu_tunggu_kerja, 
kesesuaian_bidang_studi (ENUM), kepuasan_prodi, saran_prodi, 
kompetensi_didapat, saran_pengembangan, timestamps
```

**Model (TracerStudy.php) - Has EXTRA fields:**
```php
Fillable: nim, tahun_survey, status_pekerjaan, nama_perusahaan, posisi, 
posisi_pekerjaan, bidang_pekerjaan, gaji, gaji_pertama, gaji_sekarang, 
waktu_tunggu_kerja, kesesuaian_bidang_studi, kesesuaian_pekerjaan, 
tingkat_pendidikan_pekerjaan, cara_dapat_kerja, bulan_sejak_lulus, 
kompetensi_teknis, kompetensi_bahasa_inggris, kompetensi_komunikasi, 
kompetensi_teamwork, kompetensi_problem_solving, kepuasan_prodi, 
kepuasan_kurikulum, kepuasan_dosen, kepuasan_fasilitas, saran_prodi, 
saran_untuk_prodi, pesan_untuk_juniors, kompetensi_didapat, 
saran_pengembangan, tanggal_survey, status_survey
```

**ENUM Values (status_pekerjaan):**
- Bekerja Full Time
- Bekerja Part Time
- Wiraswasta
- Melanjutkan Studi
- Belum Bekerja
- Freelancer

**ENUM Values (kesesuaian_bidang_studi):**
- Sangat Sesuai
- Sesuai
- Cukup Sesuai
- Kurang Sesuai
- Tidak Sesuai

**⚠️ ISSUE:** Model has many fields that don't exist in database!

**Fields in Model but NOT in SQL:**
- posisi_pekerjaan
- gaji_pertama
- gaji_sekarang
- kesesuaian_pekerjaan
- tingkat_pendidikan_pekerjaan
- cara_dapat_kerja
- bulan_sejak_lulus
- kompetensi_teknis
- kompetensi_bahasa_inggris
- kompetensi_komunikasi
- kompetensi_teamwork
- kompetensi_problem_solving
- kepuasan_kurikulum
- kepuasan_dosen
- kepuasan_fasilitas
- saran_untuk_prodi
- pesan_untuk_juniors
- tanggal_survey
- status_survey

**Status:** ⚠️ **NEEDS FIXING** - Remove extra fields from Model

---

## 📊 SUMMARY

### ✅ Correct Tables (18/20)
1. agenda ✅
2. alumni ✅
3. berita ✅
4. dosen ✅
5. galeri ✅
6. kisah_sukses ✅
7. kurikulum ✅
8. mahasiswa ✅
9. matakuliah ✅ (renamed)
10. pengumuman ✅
11. peraturan ✅
12. profil_prodi ✅ (renamed)
13. projects ✅
14. sessions ✅
15. users ✅
16. penelitian ✅ (fixed)
17. pkm ✅ (fixed)
18. pkm_mahasiswa ✅
19. penelitian_mahasiswa ✅
20. migrations ✅

### ⚠️ Issues Found (1/20)

1. **tracer_study** - Model has 19 extra fields that don't exist in database

---

## 🔧 REQUIRED ACTIONS

### Action 1: Clean TracerStudy Model
**File:** `app/Models/TracerStudy.php`

**Remove these fields from $fillable:**
```php
// Remove:
'posisi_pekerjaan',
'gaji_pertama',
'gaji_sekarang',
'kesesuaian_pekerjaan',
'tingkat_pendidikan_pekerjaan',
'cara_dapat_kerja',
'bulan_sejak_lulus',
'kompetensi_teknis',
'kompetensi_bahasa_inggris',
'kompetensi_komunikasi',
'kompetensi_teamwork',
'kompetensi_problem_solving',
'kepuasan_kurikulum',
'kepuasan_dosen',
'kepuasan_fasilitas',
'saran_untuk_prodi',
'pesan_untuk_juniors',
'tanggal_survey',
'status_survey',
```

**Keep only these fields:**
```php
$fillable = [
    'nim',
    'tahun_survey',
    'status_pekerjaan',
    'nama_perusahaan',
    'posisi',
    'bidang_pekerjaan',
    'gaji',
    'waktu_tunggu_kerja',
    'kesesuaian_bidang_studi',
    'kepuasan_prodi',
    'saran_prodi',
    'kompetensi_didapat',
    'saran_pengembangan',
];
```

---

## 🎯 VALIDATION CHECKLIST

- [x] All table names match (no tbl_ prefix)
- [x] All primary keys correct (id or mk_id)
- [x] All foreign keys defined correctly
- [x] All ENUM values match
- [x] All UNIQUE constraints match
- [x] Pivot tables correct (pkm_mahasiswa, penelitian_mahasiswa)
- [x] Timestamps columns present
- [ ] TracerStudy model needs cleanup (only issue remaining)

---

## 📝 NOTES

1. **Table Naming Convention:**
   - All tables use lowercase with underscores
   - No `tbl_` prefix (cleaned up)
   - Pivot tables use format: `{table1}_{table2}`

2. **Primary Keys:**
   - Most tables: `id` (bigint unsigned)
   - matakuliah: `mk_id` (bigint unsigned)

3. **Foreign Key Constraints:**
   - All CASCADE on delete where appropriate
   - SET NULL for optional relationships (dosen_pembimbing_id, ketua_peneliti_id)

4. **Many-to-Many Relationships:**
   - pkm ↔ mahasiswa via pkm_mahasiswa ✅
   - penelitian ↔ mahasiswa via penelitian_mahasiswa ✅
   - Both have `peran` column in pivot

5. **Relationships Chain:**
   - mahasiswa → alumni (1:1 via nim)
   - alumni → kisah_sukses (1:many)
   - alumni → tracer_study (1:many)
   - mahasiswa → projects (1:many)

---

## ✅ CONCLUSION

**Overall Status:** 95% Correct

**Only 1 Issue Found:**
- TracerStudy model has extra fields not in database

**Action Required:**
1. Clean up TracerStudy.php to match database structure

After fixing TracerStudy model, the entire system will be 100% synchronized with the database structure.
