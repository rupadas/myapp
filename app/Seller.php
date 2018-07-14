<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Seller extends Model
{
    

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'phone', 'website', 'address', 'seller_type_id'
    ];

    protected $dates = ['created_at', 'updated_at'];

    public function vehicles() {
        return $this->hasMany('App\Vehicle');
    }

    public function sellerType() {
        return $this->belongsTo('App\SellerType');
    }
}
