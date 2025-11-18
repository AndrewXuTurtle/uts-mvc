<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Dosen extends Model
{
    use HasFactory;

    protected $table = 'dosen';

    protected $fillable = [
        'nidn',
        'nama',
        'email',
        'no_hp',
        'jenis_kelamin',
        'jabatan',
        'pendidikan_terakhir',
        'bidang_keahlian',
        'alamat',
        'foto',
        'prodi',
        'status',
        'google_scholar_link',
        'sinta_link',
        'scopus_link',
    ];

    protected $attributes = [
        'prodi' => 'Teknik Perangkat Lunak',
        'status' => 'Aktif',
    ];

    /**
     * Relasi ke Penelitian sebagai ketua
     */
    public function penelitianAsKetua()
    {
        return $this->hasMany(Penelitian::class, 'ketua_peneliti_id');
    }

    /**
     * Relasi ke PKM sebagai pembimbing
     */
    public function pkmAsPembimbing()
    {
        return $this->hasMany(PKM::class, 'dosen_pembimbing_id');
    }

    // Scope for searching
    public function scopeSearch(Builder $query, $search)
    {
        return $query->where(function($query) use ($search) {
            $query->where('nama', 'like', "%{$search}%")
                  ->orWhere('nidn', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('bidang_keahlian', 'like', "%{$search}%");
        });
    }

    // Scope for active dosen
    public function scopeActive(Builder $query)
    {
        return $query->where('status', 'Aktif');
    }

    // Custom method for handling file uploads
    public static function uploadFoto($file)
    {
        $filename = time() . '_' . $file->getClientOriginalName();
        return $file->storeAs('dosen', $filename, 'public');
    }
}
