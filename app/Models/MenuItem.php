<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\SubMenu;

class MenuItem extends Model
{
      public $table = 'menu_items';

    protected $fillable = [
        'name',
        'menu_locations_id',
        'url',
        'sort_order',
    ];

     public function submenus()
    {
        return $this->hasMany(SubMenu::class, 'menu_items_id')
            ->orderBy('sort_order')
            ->orderBy('id');
    }
}
