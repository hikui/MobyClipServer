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
}
