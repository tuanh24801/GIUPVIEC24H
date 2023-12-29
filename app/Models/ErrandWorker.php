<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\Job;
use App\Models\RentalHistory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;


class ErrandWorker extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'errand_workers';

    protected $fillable = [
        'name',
        'email',
        'password',
        'address',
        'phone',
        'avatar',
        'identification_card',
        'account_balance'
    ];

    public function scopeSearch($query){
        if($s = request()->s){
            if(Auth::guard('admin')->check()){
                    $query = $query->where('name','like',"%".$s ."%")->orWhere('email','like',"%".$s."%")->orWhere('phone','like',"%".$s."%");
            }
            if(Auth::guard('customer')->check()){
                    $query = $query->where('name','like',"%".$s ."%");
            }
        }
        return $query;
    }

    public function job_rentals(): HasMany{
        return $this->hasMany(JobRental::class, 'errand_worker_id');
    }


    public function jobs(): BelongsToMany
    {
        return $this->belongsToMany(Job::class, 'job_rentals','errand_worker_id','job_id');
    }

    public function rental_histories(): HasManyThrough
    {
        return $this->hasManyThrough(RentalHistory::class, JobRental::class);
    }

}
