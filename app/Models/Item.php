<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $tableName = 'items';

    protected $guarded = [];

    protected $fillable = [];

    protected $dates = [];

    protected $casts = [];
}
