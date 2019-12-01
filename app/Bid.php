<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bid extends Model
{
    protected $table = 'bids';
    protected $fillable = [
       'user_id','email', 'price',
    ];

    public function bids() {
        return $this->belongsTo('App\User');
    }
}
