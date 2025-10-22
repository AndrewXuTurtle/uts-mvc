# API Documentation untuk Next.js

Base URL: `http://your-domain.com/api`

## Berita API

### GET /api/berita
Mengambil semua data berita dengan pagination

**Query Parameters:**
- `per_page` (optional): Jumlah item per halaman (default: 10)
- `search` (optional): Pencarian berdasarkan judul atau isi
- `tanggal_dari` (optional): Filter tanggal mulai (format: Y-m-d)
- `tanggal_sampai` (optional): Filter tanggal akhir (format: Y-m-d)

**Response:**
```json
{
  "current_page": 1,
  "data": [
    {
      "id": 1,
      "judul": "Judul Berita",
      "isi": "Isi berita lengkap...",
      "gambar": "berita/image.jpg",
      "gambar_url": "http://domain.com/storage/berita/image.jpg",
      "penulis": "Nama Penulis",
      "tanggal": "2025-10-22",
      "created_at": "2025-10-22T10:00:00.000000Z",
      "updated_at": "2025-10-22T10:00:00.000000Z"
    }
  ],
  "total": 50
}
```

### GET /api/berita/{id}
Mengambil detail berita berdasarkan ID

**Response:**
```json
{
  "data": {
    "id": 1,
    "judul": "Judul Berita",
    "isi": "Isi berita lengkap...",
    "gambar": "berita/image.jpg",
    "gambar_url": "http://domain.com/storage/berita/image.jpg",
    "penulis": "Nama Penulis",
    "tanggal": "2025-10-22"
  }
}
```

### POST /api/berita
Membuat berita baru

**Body (multipart/form-data):**
- `judul` (required): String
- `isi` (required): Text
- `penulis` (required): String
- `tanggal` (required): Date (Y-m-d)
- `gambar` (optional): Image file

**Response:**
```json
{
  "message": "Berita berhasil ditambahkan",
  "data": { ... }
}
```

### PUT/PATCH /api/berita/{id}
Update berita

**Body (multipart/form-data):** Same as POST

### DELETE /api/berita/{id}
Hapus berita

**Response:**
```json
{
  "message": "Berita berhasil dihapus"
}
```

---

## Pengumuman API

### GET /api/pengumuman
Mengambil semua data pengumuman dengan pagination

**Query Parameters:**
- `per_page` (optional): Jumlah item per halaman (default: 10)
- `search` (optional): Pencarian berdasarkan judul atau isi
- `aktif` (optional): Filter status aktif (true/false)
- `prioritas` (optional): Filter prioritas (rendah/sedang/tinggi)
- `berlaku` (optional): Filter yang masih berlaku (true)

**Response:**
```json
{
  "current_page": 1,
  "data": [
    {
      "id": 1,
      "judul": "Judul Pengumuman",
      "isi": "Isi pengumuman...",
      "gambar": "pengumuman/image.jpg",
      "gambar_url": "http://domain.com/storage/pengumuman/image.jpg",
      "prioritas": "tinggi",
      "tanggal_mulai": "2025-10-22",
      "tanggal_selesai": "2025-10-30",
      "penulis": "Admin",
      "aktif": true,
      "created_at": "2025-10-22T10:00:00.000000Z"
    }
  ]
}
```

### GET /api/pengumuman/{id}
Mengambil detail pengumuman

### POST /api/pengumuman
Membuat pengumuman baru

**Body (multipart/form-data):**
- `judul` (required): String
- `isi` (required): Text
- `prioritas` (required): Enum (rendah, sedang, tinggi)
- `tanggal_mulai` (required): Date
- `tanggal_selesai` (optional): Date
- `penulis` (required): String
- `aktif` (optional): Boolean (default: true)
- `gambar` (optional): Image file

### PUT/PATCH /api/pengumuman/{id}
Update pengumuman

### DELETE /api/pengumuman/{id}
Hapus pengumuman

---

## Agenda API

### GET /api/agenda
Mengambil semua data agenda dengan pagination

**Query Parameters:**
- `per_page` (optional): Jumlah item per halaman (default: 10)
- `search` (optional): Pencarian berdasarkan judul, deskripsi, atau lokasi
- `aktif` (optional): Filter status aktif (true/false)
- `kategori` (optional): Filter kategori (seminar/workshop/rapat/acara/lainnya)
- `mendatang` (optional): Filter agenda mendatang (true)
- `tanggal_dari` (optional): Filter tanggal mulai
- `tanggal_sampai` (optional): Filter tanggal akhir

**Response:**
```json
{
  "current_page": 1,
  "data": [
    {
      "id": 1,
      "judul": "Seminar Teknologi",
      "deskripsi": "Deskripsi seminar...",
      "tanggal_mulai": "2025-10-25T09:00:00.000000Z",
      "tanggal_selesai": "2025-10-25T12:00:00.000000Z",
      "lokasi": "Auditorium Kampus",
      "penyelenggara": "Fakultas Teknologi",
      "kategori": "seminar",
      "gambar": "agenda/image.jpg",
      "gambar_url": "http://domain.com/storage/agenda/image.jpg",
      "aktif": true
    }
  ]
}
```

### GET /api/agenda/{id}
Mengambil detail agenda

### POST /api/agenda
Membuat agenda baru

**Body (multipart/form-data):**
- `judul` (required): String
- `deskripsi` (optional): Text
- `tanggal_mulai` (required): DateTime
- `tanggal_selesai` (optional): DateTime
- `lokasi` (optional): String
- `penyelenggara` (optional): String
- `kategori` (required): Enum (seminar, workshop, rapat, acara, lainnya)
- `aktif` (optional): Boolean (default: true)
- `gambar` (optional): Image file

### PUT/PATCH /api/agenda/{id}
Update agenda

### DELETE /api/agenda/{id}
Hapus agenda

---

## Contoh Penggunaan dengan Next.js

```javascript
// lib/api.js
const API_BASE_URL = process.env.NEXT_PUBLIC_API_URL || 'http://localhost:8000/api';

// Fetch Berita
export async function getBerita(params = {}) {
  const queryString = new URLSearchParams(params).toString();
  const res = await fetch(`${API_BASE_URL}/berita?${queryString}`);
  return res.json();
}

// Fetch Pengumuman Aktif
export async function getPengumumanAktif() {
  const res = await fetch(`${API_BASE_URL}/pengumuman?aktif=1&berlaku=1`);
  return res.json();
}

// Fetch Agenda Mendatang
export async function getAgendaMendatang() {
  const res = await fetch(`${API_BASE_URL}/agenda?aktif=1&mendatang=1`);
  return res.json();
}

// Fetch Detail
export async function getBeritaDetail(id) {
  const res = await fetch(`${API_BASE_URL}/berita/${id}`);
  const data = await res.json();
  return data.data;
}
```

## CORS Configuration

Pastikan untuk mengaktifkan CORS di Laravel:

```bash
php artisan config:publish cors
```

Edit `config/cors.php`:
```php
'paths' => ['api/*'],
'allowed_origins' => ['http://localhost:3000', 'https://your-nextjs-domain.com'],
```
