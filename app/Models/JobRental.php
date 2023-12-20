<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\TypeRental;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

    public function type_rental(): BelongsTo{
        return $this->belongsTo(TypeRental::class, 'type_rental_id');
    }
}
