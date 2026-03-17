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
        'url'
    ];

     public function submenus()
    {
        return $this->hasMany(SubMenu::class, 'menu_items_id');
    }
}
