-- Mock Data SQL Inserts for Teknik Perangkat Lunak Academic Management System
-- Generated on October 1, 2025

-- ===========================================
-- DOSEN DATA (10 Lecturers)
-- ===========================================

INSERT INTO tbl_dosen (nidn, nama, email, program_studi, jabatan, bidang_keahlian, foto, created_at, updated_at) VALUES
('197001011998011001', 'Dr. Ahmad Surya, S.Kom., M.Kom.', 'ahmad.surya@tpl.ac.id', 'Teknik Perangkat Lunak', 'Lektor Kepala', 'Machine Learning, Artificial Intelligence, Data Science', 'dosen/ahmad_surya.jpg', '2025-01-01 08:00:00', '2025-01-01 08:00:00'),
('198002021999012002', 'Prof. Dr. Siti Nurhaliza, S.Kom., M.T.', 'siti.nurhaliza@tpl.ac.id', 'Teknik Perangkat Lunak', 'Guru Besar', 'Software Engineering, System Analysis, Database Design', 'dosen/siti_nurhaliza.jpg', '2025-01-01 08:00:00', '2025-01-01 08:00:00'),
('198503032000013003', 'Dr. Budi Santoso, S.Kom., M.Kom.', 'budi.santoso@tpl.ac.id', 'Teknik Perangkat Lunak', 'Lektor', 'Web Development, Mobile Applications, UI/UX Design', 'dosen/budi_santoso.jpg', '2025-01-01 08:00:00', '2025-01-01 08:00:00'),
('198706042001014004', 'Dra. Maya Sari, M.T.', 'maya.sari@tpl.ac.id', 'Teknik Perangkat Lunak', 'Lektor', 'Computer Networks, Cybersecurity, Cloud Computing', 'dosen/maya_sari.jpg', '2025-01-01 08:00:00', '2025-01-01 08:00:00'),
('199008052002015005', 'Dr. Rudi Hartono, S.Kom., M.Kom.', 'rudi.hartono@tpl.ac.id', 'Teknik Perangkat Lunak', 'Lektor', 'Software Testing, Quality Assurance, DevOps', 'dosen/rudi_hartono.jpg', '2025-01-01 08:00:00', '2025-01-01 08:00:00'),
('199201062003016006', 'Dr. Indah Permata, S.Kom., M.T.', 'indah.permata@tpl.ac.id', 'Teknik Perangkat Lunak', 'Lektor', 'Algorithm Design, Data Structures, Competitive Programming', 'dosen/indah_permata.jpg', '2025-01-01 08:00:00', '2025-01-01 08:00:00'),
('199403072004017007', 'Ir. Dedi Kurniawan, M.T.', 'dedi.kurniawan@tpl.ac.id', 'Teknik Perangkat Lunak', 'Asisten Ahli', 'Embedded Systems, IoT, Robotics', 'dosen/dedi_kurniawan.jpg', '2025-01-01 08:00:00', '2025-01-01 08:00:00'),
('199605082005018008', 'Dr. Nina Amelia, S.Kom., M.Kom.', 'nina.amelia@tpl.ac.id', 'Teknik Perangkat Lunak', 'Lektor', 'Human-Computer Interaction, User Experience, Design Thinking', 'dosen/nina_amelia.jpg', '2025-01-01 08:00:00', '2025-01-01 08:00:00'),
('199807092006019009', 'Dr. Fachri Muhammad, S.Kom., M.T.', 'fachri.muhammad@tpl.ac.id', 'Teknik Perangkat Lunak', 'Lektor', 'Blockchain Technology, Cryptography, Digital Security', 'dosen/fachri_muhammad.jpg', '2025-01-01 08:00:00', '2025-01-01 08:00:00'),
('200009102007011010', 'Mega Lestari, S.Kom., M.Kom.', 'mega.lestari@tpl.ac.id', 'Teknik Perangkat Lunak', 'Asisten Ahli', 'Game Development, Computer Graphics, Virtual Reality', 'dosen/mega_lestari.jpg', '2025-01-01 08:00:00', '2025-01-01 08:00:00');

-- ===========================================
-- PROJECT DATA (10 Student Projects)
-- ===========================================

INSERT INTO tbl_project (judul_proyek, deskripsi_singkat, nama_mahasiswa, nim_mahasiswa, program_studi, dosen_pembimbing, tahun_selesai, path_foto_utama, path_foto_galeri, keywords, created_at, updated_at) VALUES
('Sistem Informasi Akademik Berbasis Web', 'Pengembangan sistem informasi lengkap untuk manajemen data akademik mahasiswa dan dosen', 'Ahmad Rahman', '20210001', 'Teknik Perangkat Lunak', 'Dr. Ahmad Surya, S.Kom., M.Kom.', 2025, 'projects/siakad_main.jpg', 'projects/siakad_1.jpg,projects/siakad_2.jpg,projects/siakad_3.jpg', 'web, akademik, sistem informasi, laravel, mysql', '2025-06-15 10:00:00', '2025-06-15 10:00:00'),
('Aplikasi Mobile E-Commerce dengan AI Recommendation', 'Aplikasi mobile shopping dengan sistem rekomendasi produk berbasis artificial intelligence', 'Siti Aminah', '20210002', 'Teknik Perangkat Lunak', 'Dr. Budi Santoso, S.Kom., M.Kom.', 2025, 'projects/ecommerce_main.jpg', 'projects/ecommerce_1.jpg,projects/ecommerce_2.jpg,projects/ecommerce_3.jpg', 'mobile, android, ai, recommendation, e-commerce', '2025-06-20 10:00:00', '2025-06-20 10:00:00'),
('Sistem Monitoring IoT untuk Smart Farming', 'Sistem monitoring pertanian cerdas menggunakan sensor IoT dan analisis data real-time', 'Budi Santoso', '20210003', 'Teknik Perangkat Lunak', 'Ir. Dedi Kurniawan, M.T.', 2025, 'projects/iot_farming_main.jpg', 'projects/iot_farming_1.jpg,projects/iot_farming_2.jpg,projects/iot_farming_3.jpg', 'iot, sensor, monitoring, smart farming, real-time', '2025-07-01 10:00:00', '2025-07-01 10:00:00'),
('Game Edukasi Matematika Interaktif', 'Game pembelajaran matematika interaktif untuk anak SD dengan fitur gamification', 'Maya Sari', '20210004', 'Teknik Perangkat Lunak', 'Mega Lestari, S.Kom., M.Kom.', 2025, 'projects/math_game_main.jpg', 'projects/math_game_1.jpg,projects/math_game_2.jpg,projects/math_game_3.jpg', 'game, edukasi, matematika, children, gamification', '2025-07-10 10:00:00', '2025-07-10 10:00:00'),
('Aplikasi Health Tracking dengan Machine Learning', 'Aplikasi pelacakan kesehatan dengan prediksi penyakit menggunakan machine learning', 'Rudi Hartono', '20210005', 'Teknik Perangkat Lunak', 'Dr. Ahmad Surya, S.Kom., M.Kom.', 2025, 'projects/health_main.jpg', 'projects/health_1.jpg,projects/health_2.jpg,projects/health_3.jpg', 'health, tracking, machine learning, prediction, mobile', '2025-07-15 10:00:00', '2025-07-15 10:00:00'),
('Platform E-Learning dengan Video Conference', 'Platform pembelajaran online dengan fitur video conference dan collaborative learning', 'Indah Permata', '20210006', 'Teknik Perangkat Lunak', 'Dr. Nina Amelia, S.Kom., M.Kom.', 2025, 'projects/elearning_main.jpg', 'projects/elearning_1.jpg,projects/elearning_2.jpg,projects/elearning_3.jpg', 'e-learning, video conference, collaborative, online learning', '2025-07-20 10:00:00', '2025-07-20 10:00:00'),
('Sistem Keamanan Cyber dengan Blockchain', 'Sistem keamanan siber menggunakan teknologi blockchain untuk secure communication', 'Dedi Kurniawan', '20210007', 'Teknik Perangkat Lunak', 'Dr. Fachri Muhammad, S.Kom., M.T.', 2025, 'projects/cyber_main.jpg', 'projects/cyber_1.jpg,projects/cyber_2.jpg,projects/cyber_3.jpg', 'cybersecurity, blockchain, security, encryption, communication', '2025-08-01 10:00:00', '2025-08-01 10:00:00'),
('Aplikasi Augmented Reality untuk Museum', 'Aplikasi AR yang memberikan pengalaman interaktif di museum dengan informasi 3D', 'Nina Amelia', '20210008', 'Teknik Perangkat Lunak', 'Mega Lestari, S.Kom., M.Kom.', 2025, 'projects/ar_museum_main.jpg', 'projects/ar_museum_1.jpg,projects/ar_museum_2.jpg,projects/ar_museum_3.jpg', 'augmented reality, museum, 3d, interactive, mobile', '2025-08-10 10:00:00', '2025-08-10 10:00:00'),
('Sistem Manajemen Inventory dengan AI Forecasting', 'Sistem manajemen inventory dengan prediksi permintaan menggunakan artificial intelligence', 'Fachri Muhammad', '20210009', 'Teknik Perangkat Lunak', 'Dr. Indah Permata, S.Kom., M.T.', 2025, 'projects/inventory_main.jpg', 'projects/inventory_1.jpg,projects/inventory_2.jpg,projects/inventory_3.jpg', 'inventory, ai, forecasting, management, prediction', '2025-08-15 10:00:00', '2025-08-15 10:00:00'),
('Chatbot AI untuk Customer Service', 'Chatbot cerdas untuk layanan pelanggan dengan natural language processing', 'Mega Lestari', '20210010', 'Teknik Perangkat Lunak', 'Dr. Ahmad Surya, S.Kom., M.Kom.', 2025, 'projects/chatbot_main.jpg', 'projects/chatbot_1.jpg,projects/chatbot_2.jpg,projects/chatbot_3.jpg', 'chatbot, ai, nlp, customer service, automation', '2025-08-20 10:00:00', '2025-08-20 10:00:00');

-- ===========================================
-- MATA KULIAH DATA (48 Courses - 6 per semester)
-- ===========================================

-- SEMESTER 1
INSERT INTO tbl_matakuliah (kode_mk, nama_mk, sks, semester, program_studi, kurikulum_tahun, deskripsi_singkat, status_wajib, created_at, updated_at) VALUES
('TPL1101', 'Pengantar Teknologi Informasi', 2, 1, 'Teknik Perangkat Lunak', 2024, 'Mata kuliah ini memperkenalkan konsep dasar teknologi informasi dan perannya dalam kehidupan modern', 'Wajib', '2025-01-01 08:00:00', '2025-01-01 08:00:00'),
('TPL1102', 'Matematika Diskrit', 3, 1, 'Teknik Perangkat Lunak', 2024, 'Studi tentang struktur matematika yang mendasari ilmu komputer dan programming', 'Wajib', '2025-01-01 08:00:00', '2025-01-01 08:00:00'),
('TPL1103', 'Algoritma dan Pemrograman', 4, 1, 'Teknik Perangkat Lunak', 2024, 'Dasar-dasar algoritma dan pemrograman menggunakan bahasa pemrograman terstruktur', 'Wajib', '2025-01-01 08:00:00', '2025-01-01 08:00:00'),
('TPL1104', 'Bahasa Indonesia', 2, 1, 'Teknik Perangkat Lunak', 2024, 'Pengembangan kemampuan berkomunikasi dalam bahasa Indonesia untuk konteks akademik', 'Wajib', '2025-01-01 08:00:00', '2025-01-01 08:00:00'),
('TPL1105', 'Bahasa Inggris', 2, 1, 'Teknik Perangkat Lunak', 2024, 'Pengembangan kemampuan bahasa Inggris teknis untuk kebutuhan profesional', 'Wajib', '2025-01-01 08:00:00', '2025-01-01 08:00:00'),
('TPL1106', 'Pendidikan Pancasila', 2, 1, 'Teknik Perangkat Lunak', 2024, 'Pemahaman nilai-nilai Pancasila dalam konteks kehidupan bermasyarakat', 'Wajib', '2025-01-01 08:00:00', '2025-01-01 08:00:00'),

-- SEMESTER 2
('TPL1201', 'Struktur Data', 3, 2, 'Teknik Perangkat Lunak', 2024, 'Konsep dan implementasi berbagai struktur data dalam pemrograman', 'Wajib', '2025-01-01 08:00:00', '2025-01-01 08:00:00'),
('TPL1202', 'Basis Data', 3, 2, 'Teknik Perangkat Lunak', 2024, 'Konsep, desain, dan implementasi sistem basis data relasional', 'Wajib', '2025-01-01 08:00:00', '2025-01-01 08:00:00'),
('TPL1203', 'Pemrograman Berorientasi Objek', 4, 2, 'Teknik Perangkat Lunak', 2024, 'Konsep pemrograman berorientasi objek dan implementasinya dalam bahasa pemrograman', 'Wajib', '2025-01-01 08:00:00', '2025-01-01 08:00:00'),
('TPL1204', 'Sistem Operasi', 3, 2, 'Teknik Perangkat Lunak', 2024, 'Konsep dan prinsip kerja sistem operasi modern', 'Wajib', '2025-01-01 08:00:00', '2025-01-01 08:00:00'),
('TPL1205', 'Statistika dan Probabilitas', 3, 2, 'Teknik Perangkat Lunak', 2024, 'Konsep statistika dan probabilitas untuk analisis data', 'Wajib', '2025-01-01 08:00:00', '2025-01-01 08:00:00'),
('TPL1206', 'Pendidikan Agama', 2, 2, 'Teknik Perangkat Lunak', 2024, 'Pemahaman nilai-nilai agama dalam kehidupan sehari-hari', 'Wajib', '2025-01-01 08:00:00', '2025-01-01 08:00:00'),

-- SEMESTER 3
('TPL1301', 'Pemrograman Web', 3, 3, 'Teknik Perangkat Lunak', 2024, 'Pengembangan aplikasi web menggunakan HTML, CSS, JavaScript, dan framework modern', 'Wajib', '2025-01-01 08:00:00', '2025-01-01 08:00:00'),
('TPL1302', 'Jaringan Komputer', 3, 3, 'Teknik Perangkat Lunak', 2024, 'Konsep dan implementasi jaringan komputer serta protokol komunikasi', 'Wajib', '2025-01-01 08:00:00', '2025-01-01 08:00:00'),
('TPL1303', 'Analisis dan Perancangan Sistem', 3, 3, 'Teknik Perangkat Lunak', 2024, 'Metodologi analisis kebutuhan dan perancangan sistem informasi', 'Wajib', '2025-01-01 08:00:00', '2025-01-01 08:00:00'),
('TPL1304', 'Rekayasa Perangkat Lunak', 3, 3, 'Teknik Perangkat Lunak', 2024, 'Proses dan metodologi pengembangan perangkat lunak', 'Wajib', '2025-01-01 08:00:00', '2025-01-01 08:00:00'),
('TPL1305', 'Kalkulus', 3, 3, 'Teknik Perangkat Lunak', 2024, 'Konsep kalkulus diferensial dan integral untuk kebutuhan teknik', 'Wajib', '2025-01-01 08:00:00', '2025-01-01 08:00:00'),
('TPL1306', 'Kewarganegaraan', 2, 3, 'Teknik Perangkat Lunak', 2024, 'Pemahaman hak dan kewajiban sebagai warga negara', 'Wajib', '2025-01-01 08:00:00', '2025-01-01 08:00:00'),

-- SEMESTER 4
('TPL1401', 'Pemrograman Mobile', 3, 4, 'Teknik Perangkat Lunak', 2024, 'Pengembangan aplikasi mobile untuk platform Android dan iOS', 'Wajib', '2025-01-01 08:00:00', '2025-01-01 08:00:00'),
('TPL1402', 'Keamanan Informasi', 3, 4, 'Teknik Perangkat Lunak', 2024, 'Konsep keamanan informasi dan implementasi praktis', 'Wajib', '2025-01-01 08:00:00', '2025-01-01 08:00:00'),
('TPL1403', 'Manajemen Proyek Perangkat Lunak', 3, 4, 'Teknik Perangkat Lunak', 2024, 'Teknik dan metodologi manajemen proyek pengembangan perangkat lunak', 'Wajib', '2025-01-01 08:00:00', '2025-01-01 08:00:00'),
('TPL1404', 'Basis Data Lanjutan', 3, 4, 'Teknik Perangkat Lunak', 2024, 'Konsep advanced dalam basis data dan implementasi NoSQL', 'Wajib', '2025-01-01 08:00:00', '2025-01-01 08:00:00'),
('TPL1405', 'Machine Learning', 3, 4, 'Teknik Perangkat Lunak', 2024, 'Konsep dan aplikasi machine learning dalam pengembangan perangkat lunak', 'Wajib', '2025-01-01 08:00:00', '2025-01-01 08:00:00'),
('TPL1406', 'Etika Profesi', 2, 4, 'Teknik Perangkat Lunak', 2024, 'Etika dan kode etik dalam profesi teknologi informasi', 'Wajib', '2025-01-01 08:00:00', '2025-01-01 08:00:00'),

-- SEMESTER 5
('TPL1501', 'Pengembangan Aplikasi Enterprise', 3, 5, 'Teknik Perangkat Lunak', 2024, 'Pengembangan aplikasi berskala enterprise dengan arsitektur modern', 'Wajib', '2025-01-01 08:00:00', '2025-01-01 08:00:00'),
('TPL1502', 'Cloud Computing', 3, 5, 'Teknik Perangkat Lunak', 2024, 'Konsep dan implementasi layanan cloud computing', 'Wajib', '2025-01-01 08:00:00', '2025-01-01 08:00:00'),
('TPL1503', 'Testing dan Quality Assurance', 3, 5, 'Teknik Perangkat Lunak', 2024, 'Teknik testing perangkat lunak dan jaminan kualitas', 'Wajib', '2025-01-01 08:00:00', '2025-01-01 08:00:00'),
('TPL1504', 'Data Mining', 3, 5, 'Teknik Perangkat Lunak', 2024, 'Teknik ekstraksi pengetahuan dari data besar', 'Wajib', '2025-01-01 08:00:00', '2025-01-01 08:00:00'),
('TPL1505', 'Sistem Terdistribusi', 3, 5, 'Teknik Perangkat Lunak', 2024, 'Konsep dan implementasi sistem terdistribusi', 'Wajib', '2025-01-01 08:00:00', '2025-01-01 08:00:00'),
('TPL1506', 'Praktikum Kapita Selekta', 2, 5, 'Teknik Perangkat Lunak', 2024, 'Praktikum lanjutan dengan topik-topik terkini dalam bidang teknologi', 'Wajib', '2025-01-01 08:00:00', '2025-01-01 08:00:00'),

-- SEMESTER 6
('TPL1601', 'DevOps dan CI/CD', 3, 6, 'Teknik Perangkat Lunak', 2024, 'Praktik DevOps dan implementasi Continuous Integration/Continuous Deployment', 'Wajib', '2025-01-01 08:00:00', '2025-01-01 08:00:00'),
('TPL1602', 'Blockchain Technology', 3, 6, 'Teknik Perangkat Lunak', 2024, 'Konsep dan aplikasi teknologi blockchain', 'Wajib', '2025-01-01 08:00:00', '2025-01-01 08:00:00'),
('TPL1603', 'Internet of Things', 3, 6, 'Teknik Perangkat Lunak', 2024, 'Pengembangan aplikasi IoT dan integrasi dengan perangkat keras', 'Wajib', '2025-01-01 08:00:00', '2025-01-01 08:00:00'),
('TPL1604', 'Big Data Analytics', 3, 6, 'Teknik Perangkat Lunak', 2024, 'Teknik analisis data besar dan implementasi solusi', 'Wajib', '2025-01-01 08:00:00', '2025-01-01 08:00:00'),
('TPL1605', 'UI/UX Design', 3, 6, 'Teknik Perangkat Lunak', 2024, 'Prinsip desain interface dan user experience', 'Wajib', '2025-01-01 08:00:00', '2025-01-01 08:00:00'),
('TPL1606', 'Metodologi Penelitian', 2, 6, 'Teknik Perangkat Lunak', 2024, 'Metodologi penelitian dalam bidang teknologi informasi', 'Wajib', '2025-01-01 08:00:00', '2025-01-01 08:00:00'),

-- SEMESTER 7
('TPL1701', 'Kecerdasan Buatan', 3, 7, 'Teknik Perangkat Lunak', 2024, 'Konsep dan aplikasi kecerdasan buatan dalam pengembangan perangkat lunak', 'Wajib', '2025-01-01 08:00:00', '2025-01-01 08:00:00'),
('TPL1702', 'Augmented Reality/Virtual Reality', 3, 7, 'Teknik Perangkat Lunak', 2024, 'Pengembangan aplikasi AR/VR untuk berbagai kebutuhan', 'Wajib', '2025-01-01 08:00:00', '2025-01-01 08:00:00'),
('TPL1703', 'Cybersecurity Advanced', 3, 7, 'Teknik Perangkat Lunak', 2024, 'Teknik keamanan siber tingkat lanjut', 'Wajib', '2025-01-01 08:00:00', '2025-01-01 08:00:00'),
('TPL1704', 'Software Architecture', 3, 7, 'Teknik Perangkat Lunak', 2024, 'Desain arsitektur perangkat lunak yang scalable dan maintainable', 'Wajib', '2025-01-01 08:00:00', '2025-01-01 08:00:00'),
('TPL1705', 'Game Development', 3, 7, 'Teknik Perangkat Lunak', 2024, 'Pengembangan game interaktif dengan teknologi modern', 'Pilihan', '2025-01-01 08:00:00', '2025-01-01 08:00:00'),
('TPL1706', 'E-Commerce Platform', 3, 7, 'Teknik Perangkat Lunak', 2024, 'Pengembangan platform e-commerce dengan fitur lengkap', 'Pilihan', '2025-01-01 08:00:00', '2025-01-01 08:00:00'),

-- SEMESTER 8
('TPL1801', 'Skripsi/Tugas Akhir', 6, 8, 'Teknik Perangkat Lunak', 2024, 'Penelitian dan pengembangan proyek akhir mahasiswa', 'Wajib', '2025-01-01 08:00:00', '2025-01-01 08:00:00'),
('TPL1802', 'Praktik Kerja Lapangan', 4, 8, 'Teknik Perangkat Lunak', 2024, 'Pengalaman kerja praktis di industri teknologi', 'Wajib', '2025-01-01 08:00:00', '2025-01-01 08:00:00'),
('TPL1803', 'Seminar Teknologi', 2, 8, 'Teknik Perangkat Lunak', 2024, 'Presentasi dan diskusi topik-topik terkini dalam teknologi', 'Wajib', '2025-01-01 08:00:00', '2025-01-01 08:00:00'),
('TPL1804', 'Mobile Game Development', 3, 8, 'Teknik Perangkat Lunak', 2024, 'Pengembangan game untuk platform mobile', 'Pilihan', '2025-01-01 08:00:00', '2025-01-01 08:00:00'),
('TPL1805', 'Web Security', 3, 8, 'Teknik Perangkat Lunak', 2024, 'Teknik keamanan aplikasi web dan pencegahan serangan', 'Pilihan', '2025-01-01 08:00:00', '2025-01-01 08:00:00'),
('TPL1806', 'Cloud Architecture', 3, 8, 'Teknik Perangkat Lunak', 2024, 'Desain dan implementasi arsitektur cloud computing', 'Pilihan', '2025-01-01 08:00:00', '2025-01-01 08:00:00');

-- ===========================================
-- END OF MOCK DATA
-- ===========================================

-- INSTRUCTIONS:
-- 1. Run this SQL file in your Laravel application's database
-- 2. Make sure the database tables exist (run migrations first)
-- 3. The photo files referenced in the data should be placed in:
--    - storage/app/public/dosen/ for lecturer photos
--    - storage/app/public/projects/ for project photos
-- 4. After inserting data, run: php artisan storage:link (if not already done)
-- 5. Total records inserted: 10 dosen + 10 projects + 48 mata kuliah = 68 records