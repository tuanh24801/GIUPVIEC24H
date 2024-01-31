<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EwIncome extends Model
{
    use HasFactory;
    protected $table = 'ew_income';

    protected $fillable = [
        'amount_in',
        'amount_out',
        'note',
        'errand_worker_id',
    ];
}
