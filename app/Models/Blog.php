<?php

namespace App\Models;

use Spatie\Activitylog\LogOptions;
use App\Services\ActivityLogService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Blog extends Model
{
    
    use Notifiable, HasFactory, LogsActivity;
    
    protected $fillable = [
        'blog_category_id',
        'title',
        'slug',
        'date',
        'text',
        'path_image',
        'path_image_thumbnail',
        'active',
        'super_highlight',
        'highlight',
        'sorting',
        'source',
        'external_link',
        'is_rss',
    ];

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function category(){
        return $this->belongsTo(BlogCategory::class, 'blog_category_id');
    }

    public function scopeActive($query){
        return $query->where('active', 1);
    }

    public function scopeSuperHighlightOnly($query)
    {
        return $query->where('super_highlight', 1)->where('highlight', 0);
    }

    public function scopeHighlightOnly($query)
    {
        return $query->where('highlight', 1)->where('super_highlight', 0);
    }

    public function scopeSorting($query){
        return $query->orderBy('date', 'DESC')->orderby('sorting', 'DESC');
    }

    public function getActivitylogOptions(): LogOptions
    {
        $activityLogService = new ActivityLogService($this);
        
        return LogOptions::defaults()
            ->logOnly($activityLogService->getLoggableAttributes());
    }
}
