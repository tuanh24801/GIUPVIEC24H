<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Customer extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'Customers';

    protected $fillable = [
        'name',
        'email',
        'account_balance',
        'address',
        'phone',
        'avatar',
        'password',
    ];

    public function scopeSearch($query){
        if($s = request()->s){
            $query = $query->where('name','like',"%".$s ."%")->orWhere('email','like',"%".$s."%")->orWhere('phone','like',"%".$s."%");
        }
        return $query;
    }
}
