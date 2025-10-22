<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Dosen extends Model
{
    use HasFactory;

    protected $table = 'tbl_dosen';

    protected $fillable = [
        'nidn',
        'nama',
        'email',
        'program_studi',
        'jabatan',
        'bidang_keahlian',
        'foto',
    ];

    protected $attributes = [
        'program_studi' => 'Teknik Perangkat Lunak',
    ];

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

    // Custom method for handling file uploads
    public static function uploadFoto($file)
    {
        $filename = time() . '_' . $file->getClientOriginalName();
        // Changed to store directly in public disk
        return $file->storeAs('dosen', $filename, 'public');
    }
}
