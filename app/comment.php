<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class comment extends Model
{
    public function commentable()
    {
        return $this->morphTo();
    }
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }  
}
