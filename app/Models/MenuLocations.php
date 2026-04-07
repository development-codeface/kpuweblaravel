<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\MenuItem;

class MenuLocations extends Model
{
    public $table = 'menu_locations';

    protected $fillable = [
        'name',
        'slug',
        'status',
    ];

    // ✅ Level 1
    public function menuItems()
    {
        return $this->hasMany(MenuItem::class, 'menu_locations_id')
            ->orderBy('sort_order')
            ->orderBy('id');
    }

    // ✅ Single function to get full tree
    public function getFullMenuAttribute()
    {
        return $this->menuItems()->with('submenus')->get();
    }
}
