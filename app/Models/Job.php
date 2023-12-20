<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\ErrandWorker;

class Job extends Model
{
    use HasFactory;

    protected $table = 'jobs';

    protected $fillable = [
        'name',
        'note',
        'status',
    ];

    public function scopeSearch($query){
        if($s = request()->s){
            $query = $query->where('name','like',"%".$s ."%")->orWhere('note','like',"%".$s."%");
        }
        return $query;
    }

    public function errand_workers(): BelongsToMany
    {
        return $this->belongsToMany(ErrandWorker::class, 'job_rentals','job_id','errand_worker_id');
    }
}
