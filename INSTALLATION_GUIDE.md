# 🚀 Quick Installation Guide

## Langkah Cepat (5 Menit)

### 1. Clone & Install
```bash
git clone https://github.com/AndrewXuTurtle/uts-mvc.git
cd uts-mvc
composer install
npm install
```

### 2. Setup Environment
```bash
cp .env.example .env
php artisan key:generate
```

### 3. Konfigurasi Database

Edit `.env`:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=db_mytpl
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Create & Seed Database
```bash
# Buat database
mysql -u root -p -e "CREATE DATABASE db_mytpl CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"

# Run migrations & seeders
php artisan migrate:fresh --seed
```

**Output yang diharapkan:**
```
✅ Mahasiswa seeder completed! 60 mahasiswa created
✅ Dosen seeder completed! 25 dosen created
✅ 50 projects created
✅ 35 PKM programs created
✅ 30 penelitian created
✅ 45 alumni created

🎉 Database seeded successfully!
   - 60 Mahasiswa
   - 25 Dosen
   - 50 Projects
   - 35 PKM
   - 30 Penelitian
   - 45 Alumni
```

### 5. Setup Storage & Assets
```bash
php artisan storage:link
npm run build
```

### 6. Run Application
```bash
php artisan serve
```

Buka: **http://localhost:8000**

---

## 🔑 Default Login

```
Email:    admin@gmail.com
Password: admin123
```

**⚠️ Ganti password setelah login!**

---

## ✅ Verifikasi Installation

Cek apakah semua data sudah ter-seed:

```bash
# Login ke admin panel
# http://localhost:8000/login

# Check mahasiswa count (harus 60)
# Navigate ke: Mahasiswa menu

# Check dosen count (harus 25)
# Navigate ke: Dosen menu

# Check projects count (harus 50)
# Navigate ke: Projects menu

# Test API
curl http://localhost:8000/api/projects | python -m json.tool
```

---

## 🆘 Troubleshooting Quick Fixes

### Error: "Access denied for user"
```bash
# Check MySQL credentials di .env
# Pastikan DB_USERNAME dan DB_PASSWORD benar
```

### Error: "Base table or view not found"
```bash
# Re-run migrations
php artisan migrate:fresh --seed
```

### Error: "Port 8000 already in use"
```bash
# Gunakan port lain
php artisan serve --port=8001
```

### Error: "Storage not writable"
```bash
# Fix permissions
chmod -R 775 storage bootstrap/cache
```

---

## 📚 Next Steps

1. **Baca dokumentasi lengkap:** `README.md`
2. **Pelajari API:** `API_DOCUMENTATION_COMPREHENSIVE.md`
3. **Review audit:** `CRUD_AUDIT_SUMMARY.md`
4. **Ganti admin password**
5. **Upload logo & gambar di profil prodi**
6. **Customize template sesuai kebutuhan**

---

## 🎯 Data Yang Tersedia Setelah Seeding

| Module | Count | Description |
|--------|-------|-------------|
| Admin Users | 1 | admin@gmail.com |
| Mahasiswa | 60 | Mixed status & years |
| Dosen | 25 | With academic links |
| Projects | 50 | Student projects |
| PKM | 35 | With relationships |
| Penelitian | 30 | Research projects |
| Alumni | 45 | Graduate data |
| Matakuliah | 20 | Courses |
| Peraturan | 13 | Rules |

**Total Records:** 245+

---

**Last Updated:** January 12, 2025  
**Setup Time:** ~5 minutes  
**Status:** ✅ Production Ready
