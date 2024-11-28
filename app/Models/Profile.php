<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika berbeda dengan nama model
    protected $table = 'profiles';

    // Tentukan kolom yang bisa diisi (Mass Assignment)
    protected $fillable = [
        'judul',
        'isi'
    ];

    // Tentukan kolom yang tidak boleh diubah
    protected $guarded = ['id'];

    // Menentukan format tanggal jika menggunakan timestamps
    protected $dates = ['created_at', 'updated_at'];
}
