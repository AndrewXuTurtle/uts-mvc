<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TracerStudy extends Model
{
    use HasFactory;

    protected $table = 'tracer_study';

    protected $fillable = [
        'nim',
        'tahun_survey',
        'status_pekerjaan',
        'nama_perusahaan',
        'posisi',
        'posisi_pekerjaan',
        'bidang_pekerjaan',
        'gaji',
        'gaji_pertama',
        'gaji_sekarang',
        'waktu_tunggu_kerja',
        'kesesuaian_bidang_studi',
        'kesesuaian_pekerjaan',
        'tingkat_pendidikan_pekerjaan',
        'cara_dapat_kerja',
        'bulan_sejak_lulus',
        'kompetensi_teknis',
        'kompetensi_bahasa_inggris',
        'kompetensi_komunikasi',
        'kompetensi_teamwork',
        'kompetensi_problem_solving',
        'kepuasan_prodi',
        'kepuasan_kurikulum',
        'kepuasan_dosen',
        'kepuasan_fasilitas',
        'saran_prodi',
        'saran_untuk_prodi',
        'pesan_untuk_juniors',
        'kompetensi_didapat',
        'saran_pengembangan',
        'tanggal_survey',
        'status_survey',
    ];

    protected $casts = [
        'tahun_survey' => 'integer',
        'gaji' => 'decimal:2',
        'waktu_tunggu_kerja' => 'integer',
        'kepuasan_prodi' => 'integer',
    ];

    /**
     * Relationship with Alumni
     */
    public function alumni()
    {
        return $this->belongsTo(Alumni::class, 'nim', 'nim');
    }

    /**
     * Relationship with Mahasiswa through Alumni
     */
    public function mahasiswa()
    {
        return $this->hasOneThrough(
            Mahasiswa::class,
            Alumni::class,
            'nim', // Foreign key on alumni table
            'nim', // Foreign key on mahasiswa table
            'nim', // Local key on tracer_study table
            'nim'  // Local key on alumni table
        );
    }

    /**
     * Scope for filtering by tahun
     */
    public function scopeTahun($query, $tahun)
    {
        return $query->where('tahun_survey', $tahun);
    }

    /**
     * Scope for filtering by status pekerjaan
     */
    public function scopeStatusPekerjaan($query, $status)
    {
        return $query->where('status_pekerjaan', $status);
    }

    /**
     * Get kesesuaian badge color
     */
    public function getKesesuaianBadgeColor()
    {
        return match($this->kesesuaian_bidang_studi) {
            'Sangat Sesuai' => 'success',
            'Sesuai' => 'primary',
            'Cukup Sesuai' => 'info',
            'Kurang Sesuai' => 'warning',
            'Tidak Sesuai' => 'danger',
            default => 'secondary'
        };
    }

    /**
     * Get status pekerjaan badge color
     */
    public function getStatusPekerjaanBadgeColor()
    {
        return match($this->status_pekerjaan) {
            'Bekerja Full Time' => 'success',
            'Bekerja Part Time' => 'info',
            'Wiraswasta' => 'primary',
            'Melanjutkan Studi' => 'warning',
            'Freelancer' => 'secondary',
            'Belum Bekerja' => 'danger',
            default => 'secondary'
        };
    }
}