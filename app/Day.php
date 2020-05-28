<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Day extends Model
{
    protected $fillable = [
        'name', 'schedule_id', 'ms', 'me', 'as', 'ae', 'time','color'
    ];
}
