# 📌 Quick Reference Card

## 🚀 Essential Commands

### Setup
```bash
composer install              # Install PHP dependencies
npm install                   # Install Node dependencies
cp .env.example .env         # Copy environment file
php artisan key:generate     # Generate app key
php artisan migrate:fresh --seed  # Setup database with data
php artisan storage:link     # Link storage folder
npm run build                # Compile assets
```

### Development
```bash
php artisan serve            # Start dev server (port 8000)
php artisan serve --port=8001  # Custom port
npm run dev                  # Watch & compile assets
php artisan tinker           # Interactive console
php artisan route:list       # List all routes
```

### Database
```bash
php artisan migrate          # Run migrations
php artisan migrate:fresh    # Drop & recreate tables
php artisan migrate:fresh --seed  # + Run seeders
php artisan db:seed          # Run all seeders
php artisan db:seed --class=MahasiswaSeeder  # Specific seeder
```

### Testing
```bash
php artisan test             # Run all tests
php artisan test --filter=ProjectTest  # Specific test
php artisan test --coverage  # With coverage
```

### Cache
```bash
php artisan cache:clear      # Clear cache
php artisan config:clear     # Clear config cache
php artisan route:clear      # Clear route cache
php artisan view:clear       # Clear view cache
php artisan optimize:clear   # Clear all cache
```

---

## 🔑 Default Credentials

```
Admin Panel
Email:    admin@gmail.com
Password: admin123
```

---

## 📊 Seeded Data Counts

| Module | Count |
|--------|-------|
| Admin Users | 1 |
| Mahasiswa | 60 |
| Dosen | 25 |
| Projects | 50 |
| PKM | 35 |
| Penelitian | 30 |
| Alumni | 45 |
| Matakuliah | 20 |
| Peraturan | 13 |
| **TOTAL** | **279** |

---

## 🌐 Important URLs

```
Web:      http://localhost:8000
Admin:    http://localhost:8000/login
API Base: http://localhost:8000/api
```

---

## 📡 API Endpoints

### Projects
```
GET  /api/projects           # List all projects
GET  /api/projects/{id}      # Single project
GET  /api/projects?search=website&tahun=2024
```

### PKM
```
GET  /api/pkm                # List all PKM
GET  /api/pkm/{id}           # Single PKM
GET  /api/pkm?status=Didanai
```

### Penelitian
```
GET  /api/penelitian         # List all penelitian
GET  /api/penelitian/{id}    # Single penelitian
GET  /api/penelitian/by-dosen/{id}
```

### Alumni
```
GET  /api/tracer-study       # Survey responses
GET  /api/kisah-sukses       # Success stories
GET  /api/prestasi           # Achievements
```

---

## 🧪 Quick Test

```bash
# Test API
curl http://localhost:8000/api/projects | python -m json.tool

# Test with filters
curl "http://localhost:8000/api/projects?search=website"

# Count records
mysql -u root -e "SELECT COUNT(*) FROM db_mytpl.mahasiswa;"
```

---

## 📁 Key Files

```
Controllers:  app/Http/Controllers/
API:          app/Http/Controllers/Api/
Models:       app/Models/
Views:        resources/views/
Routes:       routes/web.php, routes/api.php
Seeders:      database/seeders/
Migrations:   database/migrations/
```

---

## 🐛 Quick Fixes

### Port already in use
```bash
kill -9 $(lsof -ti:8000)
php artisan serve --port=8001
```

### Permission denied
```bash
chmod -R 775 storage bootstrap/cache
```

### Database error
```bash
php artisan migrate:fresh --seed
```

### Composer error
```bash
composer clear-cache
composer install --no-cache
```

---

## 📚 Documentation Files

- `README.md` - Complete project documentation
- `INSTALLATION_GUIDE.md` - Quick setup (5 min)
- `API_DOCUMENTATION_COMPREHENSIVE.md` - API reference
- `CRUD_AUDIT_SUMMARY.md` - Audit report
- `CONTRIBUTING.md` - Contribution guidelines

---

## 🎯 Common Tasks

### Add new mahasiswa
```php
Mahasiswa::create([
    'nim' => '20250001',
    'nama' => 'John Doe',
    'email' => 'john@student.tpl.ac.id',
    // ... other fields
]);
```

### Query with relationship
```php
$projects = Project::with('mahasiswa')->get();
$pkm = PKM::with(['dosen', 'mahasiswa'])->find(1);
```

### Export data
```php
// In controller
return Excel::download(new MahasiswaExport, 'mahasiswa.xlsx');
```

---

**Last Updated:** January 12, 2025  
**Quick Setup Time:** ~5 minutes  
**Total Seeded Records:** 279+
