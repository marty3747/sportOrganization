<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
}
