<?php

// app/Models/Menu.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = [
        'name',
        'description',
        'price',
        'image',
        'category_id',
        'status'
    ];

}
