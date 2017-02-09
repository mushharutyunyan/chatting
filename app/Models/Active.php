<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Active extends Model
{
    protected $fillable = [
        'user_id', 'room_id' , 'active', 'updated_at'
    ];
    public function user()
    {
       return $this->belongsTo('App\Models\User','user_id','id');
    }
}
