<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BalanceHistory extends Model
{
    protected $fillable = [
        'balance_id',
        'amount',
        'type',
        'description',
    ];

    public function balance()
    {
        return $this->belongsTo(Balance::class);
    }
}
