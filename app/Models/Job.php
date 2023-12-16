<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
