<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'user_id', 'client_id', 'comment'
    ];

    public function owner(){
        return $this->belongsTo(User::class, 'client_id');
    }
}
