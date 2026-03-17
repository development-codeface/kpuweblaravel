<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubMenu extends Model
{
      public $table = 'sub_menus';

    protected $fillable = [
        'name',
        'menu_items_id',
        'url'
    ];
}
