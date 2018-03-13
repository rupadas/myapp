<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'year', 'make', 'model', 'price', 'meta_deta', 'type_id', 'seller_id'
    ];

    protected $dates = ['created_at', 'updated_at'];

    public function seller() {
        return $this->belongsTo('App\Seller');
    }

   	public function images() {
        return $this->belongsToMany('App\Image');
    }

    public function reviews() {
        return $this->hasMany('App\Review');
    }

}
