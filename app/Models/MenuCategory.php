<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'menu_type_id',
        'name',
        'description',
        'display_order',
        'restaurant_id',
    ];

    public function menuType()
    {
        return $this->belongsTo(MenuType::class);
    }

    public function menuItems()
    {
        return $this->hasMany(MenuItem::class);
    }
}