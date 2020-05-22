<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $fillable = [
        'name', 'user_id'
    ];

    public function practitioner()
    {
        return $this->belongsTo(User::class, 'user_id')->with('job');
    }

    public function days()
    {
        return $this->hasMany(Day::class, 'schedule_id');
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'schedule_id');
    }
}
