<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kegiatan extends Model
{
    use HasFactory;

    protected $table = 'tbl_kegiatan';

    protected $fillable = [
        'judul',
        'deskripsi',
        'tanggal',
        'lokasi'
    ];

    public function galeri(): HasMany
    {
        return $this->hasMany(Galeri::class, 'kegiatan_id');
    }
}
