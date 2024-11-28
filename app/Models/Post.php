<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    // Mendefinisikan field yang boleh si isi
    protected $fillable = ['title', 'content', 'category_id', 'user_id', 'status'];

    // Relasi Post ke Category (One to One)
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Relasi Post ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi Post ke Gallery
    public function galleries()
    {
        return $this->hasMany(Gallery::class);
    }

    public function gallery()
    {
        return $this->hasOne(Gallery::class);
    }
}
