<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penelitian extends Model
{
    use HasFactory;

    protected $table = 'penelitian';

    protected $fillable = [
        'judul_penelitian',
        'deskripsi',
        'tahun',
        'jenis_penelitian',
        'sumber_dana',
        'dana',
        'status',
        'tanggal_mulai',
        'tanggal_selesai',
        'output',
        'file_dokumen',
        'ketua_peneliti_id',
    ];

    protected $casts = [
        'tahun' => 'integer',
        'dana' => 'decimal:2',
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date',
    ];

    /**
     * Relationship with Dosen as ketua peneliti
     */
    public function ketuaPeneliti()
    {
        return $this->belongsTo(Dosen::class, 'ketua_peneliti_id');
    }

    /**
     * Alias for ketuaPeneliti relationship
     */
    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'ketua_peneliti_id');
    }

    /**
     * Relationship with Mahasiswa (many-to-many)
     */
    public function mahasiswas()
    {
        return $this->belongsToMany(Mahasiswa::class, 'penelitian_mahasiswa', 'penelitian_id', 'nim', 'id', 'nim')
                    ->withPivot('peran')
                    ->withTimestamps();
    }

    /**
     * Scope untuk filter berdasarkan status
     */
    public function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Scope untuk filter berdasarkan tahun
     */
    public function scopeTahun($query, $tahun)
    {
        return $query->where('tahun', $tahun);
    }

    /**
     * Scope untuk search
     */
    public function scopeSearch($query, $search)
    {
        return $query->where(function($q) use ($search) {
            $q->where('judul_penelitian', 'like', '%' . $search . '%')
              ->orWhere('deskripsi', 'like', '%' . $search . '%')
              ->orWhere('jenis_penelitian', 'like', '%' . $search . '%');
        });
    }
}
