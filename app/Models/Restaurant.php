<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Restaurant extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'address',
        'phone',
        'user_id',
        'background_color',
        'text_color',
        'button_color',
        'logo',
        'is_active',
    ];

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($restaurant) {
            if (empty($restaurant->slug)) {
                $restaurant->slug = Str::slug($restaurant->name);
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function menuTypes()
    {
        return $this->hasMany(MenuType::class);
    }
}