<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogExternoWhi extends Model
{
    protected $connection = 'mysql_second';
    protected $table = 'blogs';

    public function category()
    {
        return $this->belongsTo(BlogCategoriaExternaWhi::class, 'blog_category_id');
    }

    public function getThumbnailUrlAttribute()
    {
        if (!$this->path_image_thumbnail) {
            return 'https://placehold.co/600x400?text=Sem+imagem&font=poppins';
        }

        return 'https://www.whi.dev.br/storage/' . $this->path_image_thumbnail;
    }
}
