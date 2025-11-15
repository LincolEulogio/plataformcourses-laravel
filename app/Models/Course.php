<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Storage;

use App\Enums\CourseStatus;
use App\Models\User;
use App\Models\Level;
use App\Models\Category;
use App\Models\Price;

class Course extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'summary',
        'description',
        'status',
        'image_path',
        'video_path',
        'welcome_message',
        'goodbye_message',
        'observation',
        'user_id',
        'category_id',
        'level_id',
        'price_id',
    ];

    // Casts

    protected $casts = [
        'status' => CourseStatus::class,
    ];

    protected function image(): Attribute
    {
        return Attribute::make(
            get: function() {
                return $this->image_path ? Storage::url($this->image_path) : null;
            },
        );
    }

    // Relationships

    public function teacher()
    {
        return $this->belongsTo(User::class);
    }

    public function level()
    {
        return $this->belongsTo(Level::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function price()
    {
        return $this->belongsTo(Price::class);
    }
}
