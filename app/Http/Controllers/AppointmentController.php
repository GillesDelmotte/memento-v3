<?php

namespace App\Http\Controllers;

use App\Appointment;
use App\Schedule;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

use App\Mail\NewUserMail;
use App\Mail\NewAppointmentMail;
use App\Mail\DeleteAppointmentMail;

use App\Events\NewAppointment;

//require 'phpmailer/PHPMailerAutoload.php';

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $appointments = [];
        $schedules = Schedule::where('user_id', auth()->id())->get();

        foreach($schedules as $schedule){
            $allAppointments = Appointment::where('schedule_id', $schedule->id)->get();
            $allAppointments->load('user');
            foreach($allAppointments as $appointment){
                $appointments[] = $appointment;
            }
        }

        return $appointments;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Appointment $appointment, Request $request)
    {

        $user_id = $request['user_id'];
        $schedule_id = $request['schedule_id'];
        $hour = $request['hour'];
        $date = $request['date'];

        $userAppointments = Appointment::where('date', $date)->where('user_id', $user_id)->get();

        if( count($userAppointments) >= 1 ){
            return 'false';
        };

        $appointment = Appointment::create(['user_id' => $user_id, 'schedule_id' => $schedule_id, 'hour' => $hour, 'date' => $date]);
        $appointment->load('user');

        NewAppointment::dispatch($appointment);



        if($request['sendEmail']){
            $user = User::where('id', $user_id)->first();
            Mail::to($user->email)->send(new NewAppointmentMail($user, $appointment));
        }



    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function show(Appointment $appointment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function edit(Appointment $appointment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Appointment $appointment)
    {

        $userAppointments = Appointment::where('date', $request['newDate'])->where('user_id', $request['user_id'])->get();

        if( count($userAppointments) >= 1){
            return 'false';
        };

        $appointment = Appointment::where('date', $request['lastDate'])->where('hour', $request['lastHour'])->where('schedule_id', $request['schedule_id'])->first();

        $appointment->date = $request['newDate'];
        $appointment->hour = $request['newHour'];

        $appointment->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Appointment $appointment, Request $request)
    {
        $schedule_id = $request['schedule_id'];
        $hour = $request['hour'];
        $date = $request['date'];

        $appointment = Appointment::where('schedule_id', $schedule_id)->where('hour', $hour)->where('date', $date)->first();

        if($request['sendEmail']){
            $user = User::where('id', $appointment->user_id)->first();
            if($user){
                Mail::to($user->email)->send(new DeleteAppointmentMail($user, $appointment));
            }
        }

        $appointment->delete();
    }

    public function sendMail(){

        $mail = new PHPMailer;

        $mail->From = 'memento@gillesdelmotte.be';
        $mail->FromName = 'Mailer';
        $mail->addAddress('gilles.delmotte@outlook.be');
        $mail->isHTML(true);

        $mail->Subject = 'Here is the subject';
        $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();

    }

    public function myAppointments(Appointment $appointment){
        $myAppointments = Appointment::where('user_id', Auth()->id())->whereDate('date', '>=', Carbon::now())->orderBy('date', 'asc')->get();
        return $myAppointments->load('schedule');
    }

    public function createAppointmentWithNewUser(Request $request){

        if($request['email']){

            $checkEmail = User::where('email', $request['email'])->first();
            if(!$checkEmail){
                $token = Str::random(32);
                $user = User::create(['name' => $request['name'], 'email' => $request['email'], 'token' => $token]);
                $appointment = Appointment::create(['user_id' => $user->id, 'schedule_id' => $request['schedule_id'], 'hour' => $request['hour'], 'date' => $request['date']]);

                $appointment->load('schedule');

                Mail::to($user->email)->send(new NewUserMail($user, $appointment));

            }else{
                // error 'cette email existe deja';
            }

        }else{
            $appointment = Appointment::create(['name' => $request['name'], 'schedule_id' => $request['schedule_id'], 'hour' => $request['hour'], 'date' => $request['date']]);
        }
    }
}
