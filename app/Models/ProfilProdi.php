<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfilProdi extends Model
{
    protected $table = 'profil_prodi';
    protected $primaryKey = 'id';

    protected $fillable = [
        'nama_prodi',
        'visi',
        'misi',
        'deskripsi',
        'akreditasi',
        'logo',
        'kontak_email',
        'kontak_telepon',
        'alamat',
    ];

    protected $attributes = [
        'nama_prodi' => 'Teknik Perangkat Lunak',
    ];
}
