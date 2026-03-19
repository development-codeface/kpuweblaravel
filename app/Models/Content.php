<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\SubContent;

class Content extends Model
{
    public $table = 'contents';

    protected $fillable = [
        'pages_id',
        'button_text',
        'heading',
        'sub_heading'
    ];

    public function subContent()
    {
        return $this->hasMany(SubContent::class, 'contents_id', 'id');
    }
}
