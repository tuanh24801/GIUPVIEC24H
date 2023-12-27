<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\JobRental;

class RentalHistory extends Model
{
    use HasFactory;

    protected $table = 'rental_history';

    protected $fillable = [
        'customer_id',
        'job_rental_id',
        'amount',
        'location',
        'errand_worker_status',
        'customer_status',
    ];

    public function job_rental(): BelongsTo
    {
        return $this->belongsTo(JobRental::class, 'job_rental_id');
    }


}
