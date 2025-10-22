<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Galeri extends Model
{
    use HasFactory;

    protected $table = 'galeri';

    protected $fillable = [
        'judul',
        'deskripsi',
        'foto',
        'kategori',
        'tanggal',
        'fotografer',
        'tampilkan_di_home',
        'urutan',
    ];

    protected $casts = [
        'tanggal' => 'date',
        'tampilkan_di_home' => 'boolean',
        'urutan' => 'integer',
    ];

    /**
     * Scope untuk filter berdasarkan kategori
     */
    public function scopeKategori($query, $kategori)
    {
        return $query->where('kategori', $kategori);
    }

    /**
     * Scope untuk foto yang ditampilkan di home
     */
    public function scopeTampilkanDiHome($query)
    {
        return $query->where('tampilkan_di_home', true);
    }

    /**
     * Scope untuk search berdasarkan judul atau deskripsi
     */
    public function scopeSearch($query, $search)
    {
        return $query->where(function($q) use ($search) {
            $q->where('judul', 'like', '%' . $search . '%')
              ->orWhere('deskripsi', 'like', '%' . $search . '%')
              ->orWhere('fotografer', 'like', '%' . $search . '%');
        });
    }
}
