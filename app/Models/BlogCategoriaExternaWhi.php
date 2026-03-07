<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogCategoriaExternaWhi extends Model
{
    protected $connection = 'mysql_second';
    protected $table = 'blog_categories';

    public function blogs()
    {
        return $this->hasMany(BlogExternoWhi::class, 'blog_category_id');
    }
}
