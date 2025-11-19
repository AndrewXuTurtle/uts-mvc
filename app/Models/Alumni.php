<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alumni extends Model
{
    protected $table = 'alumni';
    protected $primaryKey = 'id';

    protected $fillable = [
        'nim',
        'tahun_lulus',
    ];

    protected $casts = [
        'tahun_lulus' => 'integer',
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
}
