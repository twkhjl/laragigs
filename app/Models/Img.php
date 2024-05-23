<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Img extends Model
{
    use HasFactory;

    protected $fillable = [
        'img_url',
        'delete_hash',
        'table_name',
        'column_name',
        'table_id',
    ];

    
}
