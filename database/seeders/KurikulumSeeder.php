<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KurikulumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kurikulum = [
            // Semester 1
            ['kode_matkul' => 'TPL101', 'nama_matkul' => 'Dasar Pemrograman', 'semester' => 1, 'sks' => 4, 'deskripsi' => 'Mata kuliah pengenalan konsep dasar pemrograman menggunakan bahasa C/C++, mencakup algoritma, struktur data dasar, dan logika pemrograman.'],
            ['kode_matkul' => 'TPL102', 'nama_matkul' => 'Matematika Diskrit', 'semester' => 1, 'sks' => 3, 'deskripsi' => 'Mempelajari logika matematika, teori himpunan, relasi, fungsi, graf, dan pohon yang menjadi dasar ilmu komputer.'],
            ['kode_matkul' => 'TPL103', 'nama_matkul' => 'Pengantar Teknologi Informasi', 'semester' => 1, 'sks' => 3, 'deskripsi' => 'Pengenalan konsep dasar TI, hardware, software, jaringan komputer, dan aplikasi teknologi informasi dalam kehidupan.'],
            ['kode_matkul' => 'TPL104', 'nama_matkul' => 'Bahasa Inggris Teknik', 'semester' => 1, 'sks' => 2, 'deskripsi' => 'Meningkatkan kemampuan berbahasa Inggris dalam konteks teknik dan teknologi informasi.'],
            
            // Semester 2
            ['kode_matkul' => 'TPL201', 'nama_matkul' => 'Pemrograman Berorientasi Objek', 'semester' => 2, 'sks' => 4, 'deskripsi' => 'Mempelajari paradigma OOP dengan Java, mencakup class, object, inheritance, polymorphism, encapsulation, dan abstraction.'],
            ['kode_matkul' => 'TPL202', 'nama_matkul' => 'Struktur Data dan Algoritma', 'semester' => 2, 'sks' => 4, 'deskripsi' => 'Mempelajari struktur data lanjut (linked list, stack, queue, tree, graph) dan algoritma sorting, searching, dan graph traversal.'],
            ['kode_matkul' => 'TPL203', 'nama_matkul' => 'Basis Data', 'semester' => 2, 'sks' => 3, 'deskripsi' => 'Konsep database relasional, normalisasi, SQL, ER diagram, dan implementasi database dengan MySQL/PostgreSQL.'],
            ['kode_matkul' => 'TPL204', 'nama_matkul' => 'Sistem Digital', 'semester' => 2, 'sks' => 3, 'deskripsi' => 'Mempelajari logika digital, aljabar boolean, gerbang logika, flip-flop, dan rangkaian digital.'],
            
            // Semester 3
            ['kode_matkul' => 'TPL301', 'nama_matkul' => 'Pemrograman Web', 'semester' => 3, 'sks' => 4, 'deskripsi' => 'Pengembangan aplikasi web menggunakan HTML, CSS, JavaScript, PHP, dan framework Laravel.'],
            ['kode_matkul' => 'TPL302', 'nama_matkul' => 'Desain dan Analisis Algoritma', 'semester' => 3, 'sks' => 3, 'deskripsi' => 'Analisis kompleksitas algoritma, divide and conquer, dynamic programming, greedy algorithm, dan algoritma lanjutan.'],
            ['kode_matkul' => 'TPL303', 'nama_matkul' => 'Rekayasa Perangkat Lunak', 'semester' => 3, 'sks' => 3, 'deskripsi' => 'SDLC, requirement engineering, software design, testing, dan project management dalam pengembangan software.'],
            ['kode_matkul' => 'TPL304', 'nama_matkul' => 'Sistem Operasi', 'semester' => 3, 'sks' => 3, 'deskripsi' => 'Konsep OS, process management, memory management, file system, I/O, dan Linux system administration.'],
            
            // Semester 4
            ['kode_matkul' => 'TPL401', 'nama_matkul' => 'Pemrograman Mobile', 'semester' => 4, 'sks' => 4, 'deskripsi' => 'Pengembangan aplikasi mobile native dengan Kotlin/Swift atau cross-platform dengan Flutter/React Native.'],
            ['kode_matkul' => 'TPL402', 'nama_matkul' => 'Jaringan Komputer', 'semester' => 4, 'sks' => 3, 'deskripsi' => 'Protokol jaringan, TCP/IP, OSI layer, routing, switching, network security, dan wireless network.'],
            ['kode_matkul' => 'TPL403', 'nama_matkul' => 'Interaksi Manusia dan Komputer', 'semester' => 4, 'sks' => 3, 'deskripsi' => 'Prinsip UI/UX design, user research, wireframing, prototyping, usability testing, dan design thinking.'],
            ['kode_matkul' => 'TPL404', 'nama_matkul' => 'Keamanan Informasi', 'semester' => 4, 'sks' => 3, 'deskripsi' => 'Kriptografi, authentication, authorization, penetration testing, secure coding, dan cyber security best practices.'],
            
            // Semester 5
            ['kode_matkul' => 'TPL501', 'nama_matkul' => 'Cloud Computing', 'semester' => 5, 'sks' => 3, 'deskripsi' => 'Konsep cloud, IaaS/PaaS/SaaS, deployment menggunakan AWS/Azure/GCP, containerization dengan Docker, dan orchestration dengan Kubernetes.'],
            ['kode_matkul' => 'TPL502', 'nama_matkul' => 'Kecerdasan Buatan', 'semester' => 5, 'sks' => 3, 'deskripsi' => 'Konsep AI, search algorithms, knowledge representation, machine learning basics, neural networks, dan AI applications.'],
            ['kode_matkul' => 'TPL503', 'nama_matkul' => 'Manajemen Proyek TI', 'semester' => 5, 'sks' => 3, 'deskripsi' => 'Project management methodologies (Agile, Scrum, Kanban), sprint planning, team collaboration, dan project tools (Jira, Trello).'],
            ['kode_matkul' => 'TPL504', 'nama_matkul' => 'Data Mining', 'semester' => 5, 'sks' => 3, 'deskripsi' => 'Data preprocessing, classification, clustering, association rules, text mining, dan implementasi dengan Python (scikit-learn, pandas).'],
            
            // Semester 6
            ['kode_matkul' => 'TPL601', 'nama_matkul' => 'DevOps dan CI/CD', 'semester' => 6, 'sks' => 3, 'deskripsi' => 'DevOps culture, continuous integration, continuous deployment, pipeline automation dengan Jenkins/GitLab CI, infrastructure as code.'],
            ['kode_matkul' => 'TPL602', 'nama_matkul' => 'Machine Learning', 'semester' => 6, 'sks' => 4, 'deskripsi' => 'Supervised/unsupervised learning, regression, classification, neural networks, deep learning dengan TensorFlow/PyTorch.'],
            ['kode_matkul' => 'TPL603', 'nama_matkul' => 'Arsitektur Perangkat Lunak', 'semester' => 6, 'sks' => 3, 'deskripsi' => 'Software architecture patterns (MVC, microservices, event-driven), design patterns, scalability, dan performance optimization.'],
            ['kode_matkul' => 'TPL604', 'nama_matkul' => 'Etika Profesi TI', 'semester' => 6, 'sks' => 2, 'deskripsi' => 'Kode etik profesi, intellectual property, privacy, hukum siber, dan tanggung jawab profesional di bidang TI.'],
        ];

        foreach ($kurikulum as $item) {
            DB::table('kurikulum')->insert(array_merge($item, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
    }
}
