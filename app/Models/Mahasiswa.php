<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $table = 'tbl_mahasiswa';

    protected $fillable = [
        'nim',
        'nama',
        'email',
        'jurusan',
        'angkatan',
        'foto',
    ];

    // Custom method for handling file uploads
    public static function uploadFoto($file)
    {
        $filename = time() . '_' . $file->getClientOriginalName();
        return $file->storeAs('mahasiswa', $filename, 'public');
    }
}
