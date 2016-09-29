<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FishType extends Model
{
    public function fishRecords() 
    {
        return $this->hasMany('App\FishType');
    }
}
