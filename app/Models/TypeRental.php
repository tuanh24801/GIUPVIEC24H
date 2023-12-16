<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeRental extends Model
{
    use HasFactory;

    protected $table = 'type_rentals';

    protected $fillable = [
        'name',
        'status',
    ];
}
