<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Image extends Model
{
    use HasFactory;

    // Mendefinisikan field yang boleh di isi
    protected $fillable = [
        'gallery_id',
        'file',
        'title'
    ];

    /**
     * Get the post that owns the image.
     */
    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }

    public function gallery(): BelongsTo
    {
        return $this->belongsTo(Gallery::class);
    }

}
