<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobRental extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_id',
        'type_rental_id',
        'cost',
        'note',
        'status',
    ];
}
