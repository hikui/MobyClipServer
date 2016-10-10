<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FishRecord extends Model
{
    public function fishType() 
    {
        return $this->belongsTo('App\FishType');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    protected $hidden = [
        'user_id',
    ];

    protected $casts = [
        'latitude' => 'float',
        'longitude' => 'float',
        'weight' => 'float',
        'length' => 'float'
    ];
}
