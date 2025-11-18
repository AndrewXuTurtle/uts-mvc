<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KisahSukses extends Model
{
    use HasFactory;

    protected $table = 'kisah_sukses';

    protected $fillable = [
        'nim',
        'judul',
        'kisah',
        'pencapaian',
        'tahun_pencapaian',
        'foto',
        'status',
    ];

    protected $casts = [
        'tahun_pencapaian' => 'integer',
    ];

    /**
     * Direct relationship with Mahasiswa
     */
    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'nim', 'nim');
    }

    /**
     * Scope for published stories
     */
    public function scopePublished($query)
    {
        return $query->where('status', 'Published');
    }

    /**
     * Scope for search
     */
    public function scopeSearch($query, $search)
    {
        return $query->where(function($q) use ($search) {
            $q->where('judul', 'like', "%{$search}%")
              ->orWhere('kisah', 'like', "%{$search}%")
              ->orWhere('nim', 'like', "%{$search}%")
              ->orWhereHas('mahasiswa', function($q) use ($search) {
                  $q->where('nama', 'like', "%{$search}%");
              });
        });
    }
}