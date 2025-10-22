# Alumni API Documentation

API endpoints untuk modul Alumni yang dapat digunakan oleh Next.js frontend.

## Base URL
```
http://your-domain.com/api
```

## Endpoints

### 1. Get All Alumni (with filtering & pagination)

**Endpoint:** `GET /alumni`

**Query Parameters:**
- `tahun_lulus` (optional) - Filter berdasarkan tahun lulus
- `program_studi` (optional) - Filter berdasarkan program studi
- `pekerjaan` (optional) - Filter berdasarkan status pekerjaan (Bekerja, Wirausaha, Melanjutkan Studi, Belum Bekerja)
- `bekerja` (optional) - true/false, filter alumni yang sudah bekerja atau wirausaha
- `search` (optional) - Search berdasarkan nama, nim, atau nama perusahaan
- `sort_by` (optional, default: tahun_lulus) - Field untuk sorting
- `sort_order` (optional, default: desc) - asc atau desc
- `per_page` (optional, default: 15) - Jumlah data per halaman

**Example Request:**
```
GET /api/alumni?tahun_lulus=2024&program_studi=Teknik Informatika&per_page=10
GET /api/alumni?bekerja=true&search=john
GET /api/alumni?pekerjaan=Bekerja&sort_by=nama&sort_order=asc
```

**Response:**
```json
{
  "current_page": 1,
  "data": [
    {
      "id": 1,
      "nama": "John Doe",
      "nim": "12345678",
      "program_studi": "Teknik Informatika",
      "tahun_lulus": 2024,
      "ipk": "3.75",
      "foto": "alumni/photo.jpg",
      "foto_url": "http://your-domain.com/storage/alumni/photo.jpg",
      "email": "john@example.com",
      "telepon": "081234567890",
      "linkedin": "https://linkedin.com/in/johndoe",
      "pekerjaan_sekarang": "Bekerja",
      "nama_perusahaan": "PT Technology Indonesia",
      "posisi": "Software Engineer",
      "alamat_perusahaan": "Jakarta",
      "tanggal_mulai_kerja": "2024-06-01",
      "gaji_range": "8000000.00",
      "testimoni": "Pengalaman kuliah yang luar biasa...",
      "pencapaian": "Berhasil mendapatkan sertifikasi...",
      "created_at": "2024-10-22T13:28:10.000000Z",
      "updated_at": "2024-10-22T13:28:10.000000Z"
    }
  ],
  "first_page_url": "http://your-domain.com/api/alumni?page=1",
  "from": 1,
  "last_page": 3,
  "last_page_url": "http://your-domain.com/api/alumni?page=3",
  "next_page_url": "http://your-domain.com/api/alumni?page=2",
  "path": "http://your-domain.com/api/alumni",
  "per_page": 15,
  "prev_page_url": null,
  "to": 15,
  "total": 42
}
```

---

### 2. Get Alumni Statistics

**Endpoint:** `GET /alumni-statistics`

**Response:**
```json
{
  "total_alumni": 150,
  "bekerja": 85,
  "wirausaha": 30,
  "melanjutkan_studi": 25,
  "by_tahun": [
    {
      "tahun_lulus": 2024,
      "total": 50
    },
    {
      "tahun_lulus": 2023,
      "total": 45
    }
  ],
  "by_prodi": [
    {
      "program_studi": "Teknik Informatika",
      "total": 80
    },
    {
      "program_studi": "Sistem Informasi",
      "total": 70
    }
  ],
  "avg_ipk": 3.52,
  "recent_alumni": [
    {
      "id": 1,
      "nama": "John Doe",
      "nim": "12345678",
      "program_studi": "Teknik Informatika",
      "tahun_lulus": 2024,
      "foto_url": "http://your-domain.com/storage/alumni/photo.jpg",
      "pekerjaan_sekarang": "Bekerja"
    }
  ]
}
```

---

### 3. Get Single Alumni Detail

**Endpoint:** `GET /alumni/{id}`

**Example Request:**
```
GET /api/alumni/1
```

**Response:**
```json
{
  "success": true,
  "data": {
    "id": 1,
    "nama": "John Doe",
    "nim": "12345678",
    "program_studi": "Teknik Informatika",
    "tahun_lulus": 2024,
    "ipk": "3.75",
    "foto": "alumni/photo.jpg",
    "foto_url": "http://your-domain.com/storage/alumni/photo.jpg",
    "email": "john@example.com",
    "telepon": "081234567890",
    "linkedin": "https://linkedin.com/in/johndoe",
    "pekerjaan_sekarang": "Bekerja",
    "nama_perusahaan": "PT Technology Indonesia",
    "posisi": "Software Engineer",
    "alamat_perusahaan": "Jakarta Selatan",
    "tanggal_mulai_kerja": "2024-06-01",
    "gaji_range": "8000000.00",
    "testimoni": "Pengalaman kuliah yang luar biasa dan membantu karir saya...",
    "pencapaian": "Berhasil mendapatkan sertifikasi AWS Solution Architect",
    "created_at": "2024-10-22T13:28:10.000000Z",
    "updated_at": "2024-10-22T13:28:10.000000Z"
  }
}
```

---

### 4. Create New Alumni

**Endpoint:** `POST /alumni`

**Headers:**
```
Content-Type: multipart/form-data
```

**Request Body:**
```
nama: John Doe (required)
nim: 12345678 (required, unique)
program_studi: Teknik Informatika (required)
tahun_lulus: 2024 (required, integer)
ipk: 3.75 (optional, 0-4)
foto: [file] (optional, image, max 2MB)
email: john@example.com (optional)
telepon: 081234567890 (optional)
linkedin: https://linkedin.com/in/johndoe (optional, url)
pekerjaan_sekarang: Bekerja (optional)
nama_perusahaan: PT Technology Indonesia (optional)
posisi: Software Engineer (optional)
alamat_perusahaan: Jakarta (optional)
tanggal_mulai_kerja: 2024-06-01 (optional, date)
gaji_range: 8000000 (optional, numeric)
testimoni: Pengalaman kuliah yang luar biasa... (optional)
pencapaian: Berhasil mendapatkan sertifikasi... (optional)
```

**Success Response:**
```json
{
  "success": true,
  "message": "Data alumni berhasil ditambahkan",
  "data": {
    "id": 1,
    "nama": "John Doe",
    "nim": "12345678",
    "foto_url": "http://your-domain.com/storage/alumni/photo.jpg",
    ...
  }
}
```

**Error Response (422):**
```json
{
  "success": false,
  "errors": {
    "nama": ["The nama field is required."],
    "nim": ["The nim has already been taken."]
  }
}
```

---

### 5. Update Alumni

**Endpoint:** `PUT /alumni/{id}` or `POST /alumni/{id}` (with _method=PUT)

**Headers:**
```
Content-Type: multipart/form-data
```

**Request Body:**
Same as Create Alumni, tapi:
- nim validation: unique kecuali untuk record ini sendiri
- foto: optional, jika kosong tidak akan mengubah foto existing

**Success Response:**
```json
{
  "success": true,
  "message": "Data alumni berhasil diupdate",
  "data": {
    "id": 1,
    "nama": "John Doe Updated",
    ...
  }
}
```

---

### 6. Delete Alumni

**Endpoint:** `DELETE /alumni/{id}`

**Success Response:**
```json
{
  "success": true,
  "message": "Data alumni berhasil dihapus"
}
```

---

## Field Descriptions

### Personal Data
- **nama** - Nama lengkap alumni
- **nim** - Nomor Induk Mahasiswa (unique)
- **program_studi** - Program studi yang diambil
- **tahun_lulus** - Tahun kelulusan (integer)
- **ipk** - Indeks Prestasi Kumulatif (decimal 0-4)
- **foto** - Path ke file foto
- **foto_url** - Full URL ke foto (ditambahkan di response)
- **email** - Email alumni
- **telepon** - Nomor telepon
- **linkedin** - LinkedIn profile URL

### Employment Data
- **pekerjaan_sekarang** - Status saat ini (Bekerja, Wirausaha, Melanjutkan Studi, Belum Bekerja)
- **nama_perusahaan** - Nama perusahaan/institusi
- **posisi** - Posisi/jabatan
- **alamat_perusahaan** - Alamat lengkap perusahaan
- **tanggal_mulai_kerja** - Tanggal mulai bekerja (date)
- **gaji_range** - Range gaji (decimal, optional untuk statistik)

### Other
- **testimoni** - Testimoni/kesan pesan alumni (text)
- **pencapaian** - Pencapaian setelah lulus (text)

---

## Example Usage in Next.js

### Fetch Alumni List
```javascript
// app/alumni/page.jsx
async function getAlumni(params) {
  const queryString = new URLSearchParams(params).toString();
  const res = await fetch(`http://your-domain.com/api/alumni?${queryString}`);
  return res.json();
}

export default async function AlumniPage({ searchParams }) {
  const alumni = await getAlumni(searchParams);
  
  return (
    <div>
      {alumni.data.map(item => (
        <div key={item.id}>
          <img src={item.foto_url} alt={item.nama} />
          <h3>{item.nama}</h3>
          <p>{item.program_studi} - {item.tahun_lulus}</p>
        </div>
      ))}
    </div>
  );
}
```

### Fetch Statistics
```javascript
// components/AlumniStats.jsx
async function getStats() {
  const res = await fetch('http://your-domain.com/api/alumni-statistics');
  return res.json();
}

export default async function AlumniStats() {
  const stats = await getStats();
  
  return (
    <div>
      <h2>Total Alumni: {stats.total_alumni}</h2>
      <p>Bekerja: {stats.bekerja}</p>
      <p>Wirausaha: {stats.wirausaha}</p>
      <p>IPK Rata-rata: {stats.avg_ipk.toFixed(2)}</p>
    </div>
  );
}
```

### Fetch Alumni Detail
```javascript
// app/alumni/[id]/page.jsx
async function getAlumniDetail(id) {
  const res = await fetch(`http://your-domain.com/api/alumni/${id}`);
  const json = await res.json();
  return json.data;
}

export default async function AlumniDetailPage({ params }) {
  const alumni = await getAlumniDetail(params.id);
  
  return (
    <div>
      <img src={alumni.foto_url} alt={alumni.nama} />
      <h1>{alumni.nama}</h1>
      <p>NIM: {alumni.nim}</p>
      <p>Program Studi: {alumni.program_studi}</p>
      <p>Tahun Lulus: {alumni.tahun_lulus}</p>
      <p>IPK: {alumni.ipk}</p>
      
      {alumni.testimoni && (
        <div>
          <h3>Testimoni</h3>
          <p>{alumni.testimoni}</p>
        </div>
      )}
      
      {alumni.pekerjaan_sekarang && (
        <div>
          <h3>Pekerjaan</h3>
          <p>{alumni.pekerjaan_sekarang}</p>
          <p>{alumni.posisi} at {alumni.nama_perusahaan}</p>
        </div>
      )}
    </div>
  );
}
```

---

## Notes

1. **Foto Upload**: Gunakan FormData untuk upload foto
2. **Pagination**: Response menggunakan Laravel pagination format
3. **Filtering**: Bisa kombinasi multiple filters
4. **Search**: Search akan mencari di nama, nim, dan nama_perusahaan
5. **CORS**: Pastikan CORS sudah dikonfigurasi untuk Next.js domain
6. **Authentication**: Saat ini API tidak memerlukan authentication, sesuaikan jika perlu

---

## Error Codes

- **200** - Success
- **201** - Created (POST success)
- **404** - Alumni not found
- **422** - Validation error
- **500** - Server error
