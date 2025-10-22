# Laravel API Documentation

## Teknik Perangkat Lunak (TPL) Academic Management System API

This API provides access to the academic data management system for Teknik Perangkat Lunak (Software Engineering) program.

## Base URL
```
http://your-domain.com/api
```

## Authentication
Currently, this API does not require authentication. All endpoints are publicly accessible.

## Response Format
All API responses follow this standard format:

### Success Response
```json
{
  "data": { ... },
  "message": "Success message",
  "status": "success"
}
```

### Error Response
```json
{
  "message": "Error message",
  "status": "error"
}
```

---

# DOSEN API

## Get All Dosen
**GET** `/api/dosen`

### Response
```json
[
  {
    "id": 1,
    "nidn": "1234567890",
    "nama": "Dr. John Doe",
    "email": "john.doe@tpl.ac.id",
    "program_studi": "Teknik Perangkat Lunak",
    "jabatan": "Lektor Kepala",
    "bidang_keahlian": "Machine Learning, Artificial Intelligence",
    "foto": "dosen/photo.jpg",
    "foto_url": "http://your-domain.com/storage/dosen/photo.jpg",
    "created_at": "2025-10-01T10:00:00.000000Z",
    "updated_at": "2025-10-01T10:00:00.000000Z"
  }
]
```

## Get Dosen by ID
**GET** `/api/dosen/{id}`

### Parameters
- `id` (integer): Dosen ID

### Response
```json
{
  "id": 1,
  "nidn": "1234567890",
  "nama": "Dr. John Doe",
  "email": "john.doe@tpl.ac.id",
  "program_studi": "Teknik Perangkat Lunak",
  "jabatan": "Lektor Kepala",
  "bidang_keahlian": "Machine Learning, Artificial Intelligence",
  "foto": "dosen/photo.jpg",
  "foto_url": "http://your-domain.com/storage/dosen/photo.jpg",
  "created_at": "2025-10-01T10:00:00.000000Z",
  "updated_at": "2025-10-01T10:00:00.000000Z"
}
```

### Error Response (404)
```json
{
  "message": "Dosen not found"
}
```

---

# PROJECT API

## Get All Projects
**GET** `/api/project`

### Response
```json
[
  {
    "project_id": 1,
    "judul_proyek": "Sistem Informasi Akademik Berbasis Web",
    "deskripsi_singkat": "Pengembangan sistem informasi untuk manajemen data akademik",
    "nama_mahasiswa": "Jane Smith",
    "nim_mahasiswa": "123456789",
    "program_studi": "Teknik Perangkat Lunak",
    "dosen_pembimbing": "Dr. John Doe",
    "tahun_selesai": 2025,
    "path_foto_utama": "projects/main.jpg",
    "path_foto_galeri": "projects/img1.jpg,projects/img2.jpg",
    "foto_utama_url": "http://your-domain.com/storage/projects/main.jpg",
    "galeri_urls": [
      "http://your-domain.com/storage/projects/img1.jpg",
      "http://your-domain.com/storage/projects/img2.jpg"
    ],
    "keywords": "web, akademik, sistem informasi",
    "created_at": "2025-10-01T10:00:00.000000Z",
    "updated_at": "2025-10-01T10:00:00.000000Z"
  }
]
```

## Get Project by ID
**GET** `/api/project/{id}`

### Parameters
- `id` (integer): Project ID (project_id)

### Response
```json
{
  "project_id": 1,
  "judul_proyek": "Sistem Informasi Akademik Berbasis Web",
  "deskripsi_singkat": "Pengembangan sistem informasi untuk manajemen data akademik",
  "nama_mahasiswa": "Jane Smith",
  "nim_mahasiswa": "123456789",
  "program_studi": "Teknik Perangkat Lunak",
  "dosen_pembimbing": "Dr. John Doe",
  "tahun_selesai": 2025,
  "path_foto_utama": "projects/main.jpg",
  "path_foto_galeri": "projects/img1.jpg,projects/img2.jpg",
  "foto_utama_url": "http://your-domain.com/storage/projects/main.jpg",
  "galeri_urls": [
    "http://your-domain.com/storage/projects/img1.jpg",
    "http://your-domain.com/storage/projects/img2.jpg"
  ],
  "keywords": "web, akademik, sistem informasi",
  "created_at": "2025-10-01T10:00:00.000000Z",
  "updated_at": "2025-10-01T10:00:00.000000Z"
}
```

### Error Response (404)
```json
{
  "message": "Project not found"
}
```

---

# MATA KULIAH API

## Get All Mata Kuliah
**GET** `/api/matakuliah`

### Response
```json
[
  {
    "mk_id": 1,
    "kode_mk": "TPL101",
    "nama_mk": "Pemrograman Web",
    "sks": 3,
    "semester": 3,
    "program_studi": "Teknik Perangkat Lunak",
    "kurikulum_tahun": 2024,
    "deskripsi_singkat": "Mata kuliah ini membahas pengembangan aplikasi web",
    "status_wajib": "Wajib",
    "created_at": "2025-10-01T10:00:00.000000Z",
    "updated_at": "2025-10-01T10:00:00.000000Z"
  }
]
```

## Get Mata Kuliah by ID
**GET** `/api/matakuliah/{id}`

### Parameters
- `id` (integer): Mata Kuliah ID (mk_id)

### Response
```json
{
  "mk_id": 1,
  "kode_mk": "TPL101",
  "nama_mk": "Pemrograman Web",
  "sks": 3,
  "semester": 3,
  "program_studi": "Teknik Perangkat Lunak",
  "kurikulum_tahun": 2024,
  "deskripsi_singkat": "Mata kuliah ini membahas pengembangan aplikasi web",
  "status_wajib": "Wajib",
  "created_at": "2025-10-01T10:00:00.000000Z",
  "updated_at": "2025-10-01T10:00:00.000000Z"
}
```

### Error Response (404)
```json
{
  "message": "Mata Kuliah not found"
}
```

---

# FIELD DESCRIPTIONS

## Dosen Fields
| Field | Type | Description |
|-------|------|-------------|
| `id` | integer | Primary key |
| `nidn` | string | Nomor Induk Dosen Nasional (unique) |
| `nama` | string | Full name |
| `email` | string | Email address (unique) |
| `program_studi` | string | Study program (default: "Teknik Perangkat Lunak") |
| `jabatan` | string | Academic position |
| `bidang_keahlian` | string | Expertise/specialization |
| `foto` | string | Photo filename |
| `foto_url` | string | Full photo URL (API generated) |
| `created_at` | datetime | Creation timestamp |
| `updated_at` | datetime | Last update timestamp |

## Project Fields
| Field | Type | Description |
|-------|------|-------------|
| `project_id` | integer | Primary key |
| `judul_proyek` | string | Project title |
| `deskripsi_singkat` | text | Brief description |
| `nama_mahasiswa` | string | Student name |
| `nim_mahasiswa` | string | Student ID number |
| `program_studi` | string | Study program (default: "Teknik Perangkat Lunak") |
| `dosen_pembimbing` | string | Supervisor lecturer |
| `tahun_selesai` | integer | Completion year |
| `path_foto_utama` | string | Main photo filename |
| `path_foto_galeri` | string | Gallery photos (comma-separated) |
| `foto_utama_url` | string | Main photo URL (API generated) |
| `galeri_urls` | array | Gallery photo URLs (API generated) |
| `keywords` | string | Project keywords |
| `created_at` | datetime | Creation timestamp |
| `updated_at` | datetime | Last update timestamp |

## Mata Kuliah Fields
| Field | Type | Description |
|-------|------|-------------|
| `mk_id` | integer | Primary key |
| `kode_mk` | string | Course code (unique) |
| `nama_mk` | string | Course name |
| `sks` | integer | Credit hours (1-6) |
| `semester` | integer | Semester number (1-8) |
| `program_studi` | string | Study program (default: "Teknik Perangkat Lunak") |
| `kurikulum_tahun` | integer | Curriculum year |
| `deskripsi_singkat` | text | Brief description |
| `status_wajib` | enum | Status: "Wajib" or "Pilihan" |
| `created_at` | datetime | Creation timestamp |
| `updated_at` | datetime | Last update timestamp |

---

# NEXT.JS INTEGRATION EXAMPLES

## Fetch All Dosen
```javascript
// pages/api/dosen.js or components
const API_BASE = 'http://your-laravel-domain.com/api';

export async function getAllDosen() {
  try {
    const response = await fetch(`${API_BASE}/dosen`);
    const data = await response.json();
    return data;
  } catch (error) {
    console.error('Error fetching dosen:', error);
    return [];
  }
}
```

## Fetch Single Project
```javascript
export async function getProject(id) {
  try {
    const response = await fetch(`${API_BASE}/project/${id}`);
    if (!response.ok) {
      throw new Error('Project not found');
    }
    const data = await response.json();
    return data;
  } catch (error) {
    console.error('Error fetching project:', error);
    return null;
  }
}
```

## Display Data in Next.js Component
```jsx
import { useState, useEffect } from 'react';

export default function DosenList() {
  const [dosen, setDosen] = useState([]);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    fetch('/api/dosen')
      .then(res => res.json())
      .then(data => {
        setDosen(data);
        setLoading(false);
      })
      .catch(error => {
        console.error('Error:', error);
        setLoading(false);
      });
  }, []);

  if (loading) return <div>Loading...</div>;

  return (
    <div>
      {dosen.map(item => (
        <div key={item.id} className="dosen-card">
          <img src={item.foto_url} alt={item.nama} />
          <h3>{item.nama}</h3>
          <p>{item.jabatan}</p>
          <p>{item.bidang_keahlian}</p>
        </div>
      ))}
    </div>
  );
}
```

---

# NOTES

1. **Default Program Studi**: All records default to "Teknik Perangkat Lunak"
2. **Photo URLs**: API automatically generates full URLs for photo fields
3. **Gallery Photos**: Project gallery photos are returned as an array of URLs
4. **Status Values**: Mata Kuliah status can be "Wajib" (Required) or "Pilihan" (Optional)
5. **Primary Keys**: Project uses `project_id`, Mata Kuliah uses `mk_id`, Dosen uses standard `id`

# CORS Configuration

Make sure to configure CORS in your Laravel application for Next.js integration:

```php
// config/cors.php
'allowed_origins' => ['http://localhost:3000', 'https://your-nextjs-domain.com'],
'allowed_headers' => ['*'],
'allowed_methods' => ['*'],
'supports_credentials' => true,
```</content>
<parameter name="filePath">/Users/andrew/development/uts-mvc/laravelapi.md