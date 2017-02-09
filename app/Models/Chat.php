<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $fillable = [
        'user_id', 'room_id','message', 'created_at'
    ];
    
    public function user()
    {
       return $this->belongsTo('App\Models\User','user_id','id');
    }
}
