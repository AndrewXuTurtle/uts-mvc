<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alumni extends Model
{
    protected $table = 'alumni';
    protected $primaryKey = 'id';

    protected $fillable = [
        'nim',
        'pekerjaan_saat_ini',
        'nama_perusahaan',
        'posisi_jabatan',
        'alamat_perusahaan',
        'no_hp_perusahaan',
        'gaji_pertama',
        'gaji_saat_ini',
        'waktu_tunggu_pekerjaan',
        'kesesuaian_bidang',
        'status_data',
        'linkedin',
        'instagram',
        'facebook',
        'pesan_alumni',
        'foto_alumni',
    ];

    protected $casts = [
        'gaji_pertama' => 'decimal:2',
        'gaji_saat_ini' => 'decimal:2',
        'waktu_tunggu_pekerjaan' => 'integer',
    ];

    /**
     * Relasi ke Mahasiswa (satu alumni adalah satu mahasiswa)
     */
    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'nim', 'nim');
    }

    /**
     * Relationship with KisahSukses
     */
    public function kisahSukses()
    {
        return $this->hasMany(KisahSukses::class, 'nim', 'nim');
    }

    /**
     * Relationship with TracerStudy
     */
    public function tracerStudies()
    {
        return $this->hasMany(TracerStudy::class, 'nim', 'nim');
    }

    /**
     * Scope untuk alumni dengan data lengkap
     */
    public function scopeLengkap($query)
    {
        return $query->where('status_data', 'Lengkap');
    }

    /**
     * Scope untuk alumni dengan data belum lengkap
     */
    public function scopeBelumLengkap($query)
    {
        return $query->where('status_data', 'Belum Lengkap');
    }

    /**
     * Check if data alumni sudah lengkap
     */
    public function isDataComplete()
    {
        $requiredFields = [
            'pekerjaan_saat_ini',
            'nama_perusahaan',
            'posisi_jabatan',
            'waktu_tunggu_pekerjaan',
            'kesesuaian_bidang',
        ];

        foreach ($requiredFields as $field) {
            if (empty($this->$field)) {
                return false;
            }
        }

        return true;
    }

    /**
     * Auto update status data based on completion
     */
    public function updateDataStatus()
    {
        $this->status_data = $this->isDataComplete() ? 'Lengkap' : 'Belum Lengkap';
        $this->save();
    }

    /**
     * Get kesesuaian badge color
     */
    public function getKesesuaianBadgeColor()
    {
        return match($this->kesesuaian_bidang) {
            'Sangat Sesuai' => 'success',
            'Sesuai' => 'primary',
            'Cukup Sesuai' => 'info',
            'Kurang Sesuai' => 'warning',
            'Tidak Sesuai' => 'danger',
            default => 'secondary'
        };
    }
}
