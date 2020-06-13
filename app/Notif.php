<?php

use App\Appointment;


$newAppointment = Appointment::create(['user_id' => 1, 'schedule_id' => 10, 'hour' => '10:0', 'date' => "2020-10-06"]);
