<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\ErrandWorker;
use Illuminate\Support\Facades\Auth;


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
            if(Auth::guard('admin')->check()){
                $query = $query->where('name','like',"%".$s ."%")->orWhere('note','like',"%".$s."%");
            }
            if(Auth::guard('customer')->check()){
                $query = $query->where('name','like',"%".$s ."%");
            }
        }
        return $query;
    }

    public function errand_workers(): BelongsToMany
    {
        return $this->belongsToMany(ErrandWorker::class, 'job_rentals','job_id','errand_worker_id');
    }
}
