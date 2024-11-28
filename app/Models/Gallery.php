<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;

    // Mendefinisikan kolom yang boleh di isi
    protected $fillable = [
        'post_id',
        'position',
        'status',
    ];

    // Relasi ke Post
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    // Relasi ke Image
    public function images()
    {
        return $this->hasMany(Image::class);
    }


}