<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pm extends Model
{
    use HasFactory;

    protected $table = 'pm';

    protected $fillable = [
        'first_name',
        'last_name',
    ];
}
