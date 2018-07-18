<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use App\Type;
use App\Image;

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

    public function type() {
        return $this->belongsTo('App\Type');
    }

    public function displayImage() {
        $image = Image::join('image_vehicle','image_vehicle.image_id','images.id')->where('image_vehicle.vehicle_id',$this->id)->select('images.*')->first();
        return $image;
    }

}
