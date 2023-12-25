<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Customer;


class Payment extends Model
{
    use HasFactory;

    protected $table = 'payment';

    protected $fillable = [
        'customer_id',
        'amount',
        'bank_code',
        'info_payment',
        'status',
    ];

    public function scopeSearch($query){
        if($s = request()->s ){
            $query = $query->join('customers', function($join) use($s)
            {
                $join->on('customers.id', '=', 'payment.customer_id')
                        ->where('customers.name','like',"%".$s ."%");
            });
        }
        return  $query;
    }

    public function customer(): BelongsTo{
        return $this->belongsTo(Customer::class);
    }
}
