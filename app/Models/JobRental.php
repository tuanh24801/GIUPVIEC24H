<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\TypeRental;
use App\Models\ErrandWorker;
use App\Models\Job;
use App\Models\RentalHistory;


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

    public function errand_workers(): BelongsTo{
        return $this->belongsTo(ErrandWorker::class, 'errand_worker_id', 'id');
    }

    public function rental_histories(): HasMany{
        return $this->hasMany(RentalHistory::class, 'job_rental_id');
    }


    public function jobs(): BelongsTo{
        return $this->belongsTo(Job::class, 'job_id', 'id');
    }

}
