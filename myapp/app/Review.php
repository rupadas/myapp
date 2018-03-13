<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
   

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'comment', 'seller_id', 'vehicle_id',
    ];

    protected $dates = ['created_at', 'updated_at'];

    public function vehicles() {
        return $this->belongsTo('App\vehicle');
    }
}
