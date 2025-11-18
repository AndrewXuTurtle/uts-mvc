# 🎓 Sistem Informasi Program Studi Teknik Perangkat Lunak

**Laravel 11 MVC Application**  
Website resmi Program Studi Teknik Perangkat Lunak dengan fitur lengkap untuk mengelola data akademik, mahasiswa, dosen, penelitian, PKM, alumni, dan tracer study.

[![Laravel](https://img.shields.io/badge/Laravel-11.x-red.svg)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.2+-blue.svg)](https://php.net)
[![License](https://img.shields.io/badge/License-MIT-green.svg)](LICENSE)

---

## 📋 Daftar Isi

- [Fitur Utama](#-fitur-utama)
- [Requirements](#-requirements)
- [Instalasi](#-instalasi)
- [Konfigurasi](#-konfigurasi)
- [Struktur Database](#-struktur-database)
- [Seeder Data](#-seeder-data)
- [API Documentation](#-api-documentation)
- [Admin Panel](#-admin-panel)
- [Testing](#-testing)
- [Troubleshooting](#-troubleshooting)

---

## ✨ Fitur Utama

### 🎯 Manajemen Akademik
- **Mahasiswa**: Data lengkap mahasiswa dengan status (Aktif/Lulus)
- **Dosen**: Profil dosen dengan link Google Scholar, SINTA, Scopus
- **Matakuliah**: Daftar mata kuliah dengan SKS dan semester
- **Kurikulum**: Struktur kurikulum program studi

### 📚 Manajemen Proyek & Penelitian
- **Projects**: Portfolio project mahasiswa dengan teknologi & demo links
- **PKM**: Program Kreativitas Mahasiswa (many-to-many: dosen & mahasiswa)
- **Penelitian**: Research projects dengan dana & output publikasi

### 🎓 Alumni & Tracer Study
- **Alumni**: Data alumni dengan info pekerjaan & gaji
- **Tracer Study**: Survei pelacakan alumni
- **Kisah Sukses**: Success stories alumni dengan kategori

### 📰 Content Management
- **Berita & Prestasi**: News articles dan student achievements
- **Agenda**: Kalender event kampus
- **Galeri**: Photo gallery
- **Pengumuman**: Announcements board
- **Peraturan**: Rules and regulations

### 🚀 RESTful API
- **Complete API** untuk integrasi frontend (React/Vue/Next.js)
- **Eager Loading** - semua relationship data dalam 1 request
- **Filter & Search** - query parameters lengkap
- **Standardized Response** - format konsisten semua endpoint

---

## 🛠️ Requirements

- **PHP** >= 8.2
- **Composer** >= 2.0
- **MySQL** >= 8.0 atau **MariaDB** >= 10.3
- **Node.js** >= 18.x & **NPM** >= 9.x (untuk Vite)
- **Extensions**: OpenSSL, PDO, Mbstring, Tokenizer, XML, Ctype, JSON, BCMath, Fileinfo

---

## 📦 Instalasi

### 1. Clone Repository
```bash
git clone https://github.com/AndrewXuTurtle/uts-mvc.git
cd uts-mvc
```

### 2. Install Dependencies
```bash
# Install PHP dependencies
composer install

# Install Node.js dependencies
npm install
```

### 3. Setup Environment
```bash
# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

### 4. Konfigurasi Database

Edit file `.env`:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=db_mytpl
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Create Database
```bash
# Login ke MySQL
mysql -u root -p

# Buat database
CREATE DATABASE db_mytpl CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
EXIT;
```

### 6. Run Migrations & Seeders
```bash
# Jalankan migrations dan seeder sekaligus
php artisan migrate:fresh --seed
```

**Output yang diharapkan:**
```
✅ Mahasiswa seeder completed! 60 mahasiswa created
✅ Dosen seeder completed! 25 dosen created
🚀 Starting comprehensive seeder...
📦 Creating 50 projects...
   ✅ 50 projects created
🤝 Creating 35 PKM programs...
   ✅ 35 PKM programs created
🔬 Creating 30 penelitian...
   ✅ 30 penelitian created
🎓 Creating 45 alumni...
   ✅ 45 alumni created

🎉 Database seeded successfully!
```

### 7. Create Storage Symlink
```bash
php artisan storage:link
```

### 8. Compile Assets
```bash
# Development
npm run dev

# Production
npm run build
```

### 9. Run Application
```bash
php artisan serve
```

Buka browser: **http://localhost:8000**

---

## ⚙️ Konfigurasi

### Default Admin Account

Setelah seeder berjalan, gunakan kredensial ini:

```
Email:    admin@gmail.com
Password: admin123
```

**⚠️ PENTING:** Ganti password admin setelah login pertama!

### File Upload Configuration

Edit `config/filesystems.php` jika perlu custom storage:
```php
'default' => env('FILESYSTEM_DISK', 'public'),
```

### Email Configuration (Optional)

Untuk fitur email notifications:
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-app-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@tpl.ac.id
MAIL_FROM_NAME="${APP_NAME}"
```

---

## 🗄️ Struktur Database

### Tables (21 total)

| Table | Records | Description |
|-------|---------|-------------|
| `users` | 1 | Admin accounts |
| `mahasiswa` | 60 | Student data |
| `dosen` | 25 | Lecturer profiles |
| `projects` | 50 | Student projects |
| `pkm` | 35 | PKM programs |
| `pkm_mahasiswa` | ~120 | PKM-Student pivot |
| `penelitian` | 30 | Research projects |
| `alumni` | 45 | Alumni data |
| `tracer_study` | - | Alumni survey |
| `kisah_sukses` | - | Success stories |
| `berita` | - | News & achievements |
| `agenda` | - | Events |
| `galeri` | - | Photo gallery |
| `pengumuman` | - | Announcements |
| `peraturan` | 13 | Rules |
| `matakuliah` | 20 | Courses |
| `kurikulum` | - | Curriculum |
| `profil_prodi` | 1 | Department profile |
| `sessions` | - | User sessions |

### Entity Relationships

```
Mahasiswa (1) ←→ (N) Projects
Mahasiswa (1) ←→ (N) Alumni ←→ (N) TracerStudy
Mahasiswa (1) ←→ (N) Alumni ←→ (N) KisahSukses
Dosen (1) ←→ (N) Penelitian
PKM (N) ←→ (N) Mahasiswa (many-to-many)
PKM (N) ←→ (1) Dosen (pembimbing)
Berita (1) ←→ (1) Mahasiswa (for prestasi)
```

---

## 🌱 Seeder Data

### Comprehensive Seeders

Project ini menggunakan **ComprehensiveSeeder** yang otomatis membuat:

#### MahasiswaSeeder (60 records)
- Beragam tahun masuk: 2020-2024
- 3 kelas: TPL-A, TPL-B, TPL-C
- Mixed status: Aktif (70%) & Lulus (30%)
- Data realistis: Nama Indonesia, alamat, no HP

#### DosenSeeder (25 records)
- Beragam jabatan: Asisten Ahli, Lektor, Lektor Kepala, Profesor
- Bidang keahlian: Software Engineering, ML, Data Science, dll
- Academic links: Google Scholar (70%), SINTA (70%), Scopus (40%)

#### ComprehensiveSeeder (160 records)
1. **Projects (50)**: Student capstone projects
   - Kategori: Website, Mobile App, IoT, Game, Desktop App
   - Teknologi: Laravel, React, Vue, Flutter, Python, Java, dll
   - GitHub links (70%) & Demo links (50%)
   
2. **PKM (35)**: Community service programs
   - Jenis: PKM-R, PKM-K, PKM-M, PKM-T, PKM-KC, PKM-AI, PKM-GT
   - Many-to-many: 1 dosen + 3-5 mahasiswa per PKM
   - Dana: Rp 5jt - Rp 25jt
   
3. **Penelitian (30)**: Research projects
   - Jenis: Mandiri, Hibah, Kolaborasi
   - Dana: Rp 10jt - Rp 100jt
   - Output: Jurnal, Prosiding, Paten, Buku
   
4. **Alumni (45)**: Graduate data
   - Pekerjaan: Software Engineer, Developer, Data Analyst, dll
   - Gaji: Rp 4jt - Rp 20jt
   - Waktu tunggu kerja: 1-12 bulan
   - Social media: LinkedIn, Instagram

### Manual Seeding

Jika perlu re-seed:
```bash
# Fresh database + all seeders
php artisan migrate:fresh --seed

# Specific seeder only
php artisan db:seed --class=MahasiswaSeeder
php artisan db:seed --class=DosenSeeder
php artisan db:seed --class=ComprehensiveSeeder
```

---

## 📡 API Documentation

### Base URLs

```
Development: http://localhost:8000/api
Production:  https://tpl.ac.id/api
```

### Available Endpoints

| Method | Endpoint | Description |
|--------|----------|-------------|
| GET | `/api/projects` | All projects with mahasiswa data |
| GET | `/api/projects/{id}` | Single project detail |
| GET | `/api/pkm` | All PKM with dosen & mahasiswa |
| GET | `/api/pkm/{id}` | Single PKM detail |
| GET | `/api/penelitian` | All penelitian with dosen |
| GET | `/api/penelitian/by-dosen/{id}` | Filter by dosen |
| GET | `/api/tracer-study` | Alumni survey responses |
| GET | `/api/tracer-study/testimonials` | Alumni testimonials |
| GET | `/api/kisah-sukses` | Success stories |
| GET | `/api/kisah-sukses/featured` | Featured stories (top 6) |
| GET | `/api/prestasi` | Student achievements |
| GET | `/api/prestasi/statistics` | Achievement statistics |

### Query Parameters

All list endpoints support:
- `search` - Search in multiple fields
- `page` - Pagination (default: 1)
- `per_page` - Items per page (default: 15)

Specific filters:
- `tahun` - Filter by year
- `status` - Filter by status
- `kategori` - Filter by category

### Response Format

**Success:**
```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "mahasiswa": {
        "nim": "20200001",
        "nama": "Ahmad Rahman",
        "email": "ahmad@student.tpl.ac.id",
        "kelas": "TPL-A"
      },
      "judul_project": "E-Commerce Platform"
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

**Error:**
```json
{
  "success": false,
  "message": "Resource not found",
  "errors": {}
}
```

### Testing API

```bash
# Get all projects
curl http://localhost:8000/api/projects | python -m json.tool

# Search projects
curl "http://localhost:8000/api/projects?search=website&tahun=2024"

# Get PKM with relationships
curl http://localhost:8000/api/pkm/1 | python -m json.tool

# Get tracer study statistics
curl http://localhost:8000/api/tracer-study
```

**📖 Complete API Documentation:** See `API_DOCUMENTATION_COMPREHENSIVE.md`

---

## 🖥️ Admin Panel

### Access

Login ke: **http://localhost:8000/login**

```
Email:    admin@gmail.com
Password: admin123
```

### Features

#### Dashboard
- Statistics overview
- Recent activities
- Quick actions

#### Data Management
- **Mahasiswa**: CRUD + Export Excel
- **Dosen**: CRUD + Academic links
- **Projects**: CRUD + Gallery
- **PKM**: CRUD + Many-to-many management
- **Penelitian**: CRUD + File upload
- **Alumni**: CRUD + Conversion from mahasiswa
- **Tracer Study**: CRUD + Statistics
- **Kisah Sukses**: CRUD + Featured toggle

#### Content Management
- **Berita**: News articles + Prestasi
- **Agenda**: Event calendar
- **Galeri**: Photo gallery with categories
- **Pengumuman**: Announcements board
- **Peraturan**: Rules & regulations

#### Academic
- **Matakuliah**: Course management
- **Kurikulum**: Curriculum structure
- **Profil Prodi**: Department profile

---

## 🧪 Testing

### Run Tests
```bash
# All tests
php artisan test

# Specific test
php artisan test --filter=ProjectTest

# With coverage
php artisan test --coverage
```

### Manual Testing Checklist

- [ ] Login dengan admin credentials
- [ ] Dashboard statistics muncul
- [ ] Mahasiswa list ada 60 records
- [ ] Dosen list ada 25 records
- [ ] Projects list ada 50 records
- [ ] PKM list ada 35 records (dengan dosen & mahasiswa)
- [ ] Penelitian list ada 30 records
- [ ] Alumni list ada 45 records
- [ ] API `/api/projects` return data dengan mahasiswa nested
- [ ] API `/api/pkm/1` return array dosen & mahasiswa
- [ ] Create project form mahasiswa dropdown populated
- [ ] Upload file works (berita, peraturan)

---

## 🐛 Troubleshooting

### Database Connection Error

```bash
# Check MySQL service
sudo systemctl status mysql

# Restart MySQL
sudo systemctl restart mysql

# Verify credentials in .env
```

### Seeder Error: "Duplicate entry"

```bash
# Fresh database
php artisan migrate:fresh --seed
```

### Storage Symlink Not Working

```bash
# Remove old symlink
rm public/storage

# Create new symlink
php artisan storage:link
```

### Port Already in Use

```bash
# Check process using port 8000
lsof -ti:8000

# Kill process
kill -9 $(lsof -ti:8000)

# Or use different port
php artisan serve --port=8001
```

### Composer Install Fails

```bash
# Clear composer cache
composer clear-cache

# Update composer
composer self-update

# Install with verbose
composer install -vvv
```

### NPM Install Fails

```bash
# Clear npm cache
npm cache clean --force

# Delete node_modules
rm -rf node_modules package-lock.json

# Reinstall
npm install
```

### Permission Denied (Storage)

```bash
# Fix permissions
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
```

---

## 📁 Project Structure

```
uts-mvc/
├── app/
│   ├── Http/Controllers/          # Web & API Controllers
│   │   ├── Api/                   # API Controllers
│   │   ├── ProjectController.php
│   │   ├── PKMController.php
│   │   └── ...
│   ├── Models/                    # Eloquent Models
│   │   ├── Mahasiswa.php
│   │   ├── Dosen.php
│   │   ├── Project.php
│   │   └── ...
│   └── Exports/                   # Excel Exports
├── database/
│   ├── migrations/                # Database migrations
│   └── seeders/                   # Database seeders
│       ├── MahasiswaSeeder.php    # 60 mahasiswa
│       ├── DosenSeeder.php        # 25 dosen
│       ├── ComprehensiveSeeder.php # 160 records
│       └── DatabaseSeeder.php     # Main seeder
├── resources/
│   └── views/                     # Blade templates
│       ├── mahasiswa/
│       ├── dosen/
│       ├── project/
│       └── ...
├── routes/
│   ├── web.php                    # Web routes
│   └── api.php                    # API routes
├── public/
│   ├── storage/                   # Symlink to storage
│   └── template/                  # Admin template assets
├── API_DOCUMENTATION.md           # Legacy API docs
├── API_DOCUMENTATION_COMPREHENSIVE.md  # Complete API guide
├── CRUD_AUDIT_SUMMARY.md          # Audit report
└── README.md                      # This file
```

---

## 🤝 Contributing

1. Fork repository
2. Create feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to branch (`git push origin feature/AmazingFeature`)
5. Open Pull Request

---

## 📄 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

---

## 👥 Support

- **Developer**: Andrew Xu Turtle
- **Email**: support@tpl.ac.id
- **GitHub Issues**: [Report Bug](https://github.com/AndrewXuTurtle/uts-mvc/issues)

---

## 📝 Changelog

### Version 2.0 (January 2025)
- ✅ Complete CRUD audit
- ✅ Comprehensive seeders (245 records)
- ✅ Enhanced API with eager loading
- ✅ Complete API documentation
- ✅ Fixed all relationship issues
- ✅ Production-ready setup

### Version 1.0 (November 2024)
- Initial release
- Basic CRUD operations
- Simple API endpoints

---

**Last Updated:** January 12, 2025  
**Status:** ✅ Production Ready  
**Total Records After Seeding:** 245+

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
