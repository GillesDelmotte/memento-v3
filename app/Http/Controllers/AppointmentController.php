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
use App\Events\DeleteAppointment;
use App\Events\ModifyAppointment;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

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
            //Mail::to($user->email)->send(new NewAppointmentMail($user, $appointment));
            $subject = 'Nouveau rendez-vous';
            $email = $user->email;
            $name = $user->name;

            $body = 'Bonjour ' . $user->name . ', votre praticien ' . $appointment->schedule->practitioner->name . ' vient de vous ajouter sur son horaire. </br> Le rendez-vous se prestera le ' . \Carbon\Carbon::parse($appointment->date)->format('j F, Y') . ' a '. $appointment->hour . '. </br> Si vous voulez changer ou supprimer ce rendez-vous, cliquer sur le lien ci-dessous pour accéder a vos rendez-vous. </br> https://' . config('app.url');

            $this->sendMail($subject, $email, $name, $body);
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

        ModifyAppointment::dispatch($appointment->load('user'));
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
                //Mail::to($user->email)->send(new DeleteAppointmentMail($user, $appointment));

                $subject = 'Suppression de votre rendez-vous';
                $email = $user->email;
                $name = $user->name;

                $body = 'Bonjour ' . $user->name . ', votre praticien ' . $appointment->schedule->practitioner->name . ' vient de supprimer votre rendez-vous du ' . \Carbon\Carbon::parse($appointment->date)->format('j F, Y') . ' a '. $appointment->hour . '. </br> Si vous voulez reprendre rendez-vous avec ' . $appointment->schedule->practitioner->name . ' n‘hésitez pas à cliquer sur le lien ci-dessous. </br> https://' . config('app.url');

                $this->sendMail($subject, $email, $name, $body);
            }
        }

        DeleteAppointment::dispatch($appointment);

        $appointment->delete();

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

                //Mail::to($user->email)->send(new NewUserMail($user, $appointment));

                $subject = 'Notification de votre rendez-vous';
                $email = $user->email;
                $name = $user->name;

                $body = 'Bonjour ' . $user->name . ', vous venez de prendre rendez-vous avec ' . $appointment->schedule->practitioner->name . '. </br> Le rendez-vous se prestera le ' . \Carbon\Carbon::parse($appointment->date)->format('j F, Y') . ' a '. $appointment->hour . '. </br> vous n‘êtes pas encore inscrit au sein de l‘application Memento ? </br> N‘attendez plus! Votre compte à déjà été créé. Cliqué sur le lien ci-dessous pour finialiser votre inscritpion. Il ne vous reste plus qu‘à entré un mot de passe! </br> https://' . config('app.url') .  '/verifyToken/' . $user->token . ' </br> Cependant, si vous ne voulez pas faire partie de l‘aventure avec nous, cliqué sur le lien ci-dessous pour supprimer votre compte. Votre rendez-vous sera malgré tout concervé. </br>' . config('app.url') .  '/deletedProfil/' . $user->token;

                $this->sendMail($subject, $email, $name, $body);

            }else{
                // error 'cette email existe deja';
            }

        }else{
            $appointment = Appointment::create(['name' => $request['name'], 'schedule_id' => $request['schedule_id'], 'hour' => $request['hour'], 'date' => $request['date']]);
        }
    }

    public function sendMail($subject, $email, $name, $body){

        $mail = new PHPMailer(true);

        //Recipients
        $mail->setFrom('memento@gillesdelmotte.be', 'Mailer');
        $mail->addAddress($email, $name);

        // Content
        $mail->IsHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $body;

         $mail->send();

    }
}
