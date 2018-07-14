<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    public $timestamps = true;
    protected $guarded = array();
    protected $table = 'images';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'path', 'name'
    ];

    protected $dates = ['created_at', 'updated_at'];

    public function vehicles() {
        return $this->belongsToMany('App\Vehicle');
    }
}
