<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    public function practitioner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}