<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alumni extends Model
{
    protected $table = 'alumni';

    protected $fillable = [
        'nama',
        'nim',
        'program_studi',
        'tahun_lulus',
        'ipk',
        'foto',
        'email',
        'telepon',
        'linkedin',
        'pekerjaan_sekarang',
        'nama_perusahaan',
        'posisi',
        'alamat_perusahaan',
        'tanggal_mulai_kerja',
        'gaji_range',
        'testimoni',
        'pencapaian',
    ];

    protected $casts = [
        'tanggal_mulai_kerja' => 'date',
        'ipk' => 'decimal:2',
        'gaji_range' => 'decimal:2',
    ];

    /**
     * Scope untuk filter berdasarkan tahun lulus
     */
    public function scopeTahunLulus($query, $tahun)
    {
        return $query->where('tahun_lulus', $tahun);
    }

    /**
     * Scope untuk filter berdasarkan program studi
     */
    public function scopeProgramStudi($query, $prodi)
    {
        return $query->where('program_studi', 'like', '%' . $prodi . '%');
    }

    /**
     * Scope untuk filter yang sudah bekerja
     */
    public function scopeBekerja($query)
    {
        return $query->whereIn('pekerjaan_sekarang', ['Bekerja', 'Wirausaha']);
    }

    /**
     * Scope untuk search berdasarkan nama atau nim
     */
    public function scopeSearch($query, $search)
    {
        return $query->where(function($q) use ($search) {
            $q->where('nama', 'like', '%' . $search . '%')
              ->orWhere('nim', 'like', '%' . $search . '%')
              ->orWhere('nama_perusahaan', 'like', '%' . $search . '%');
        });
    }
}
