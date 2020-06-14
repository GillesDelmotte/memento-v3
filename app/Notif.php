<?php

use App\Appointment;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


// $newAppointment = Appointment::create(['user_id' => 1, 'schedule_id' => 10, 'hour' => '10:0', 'date' => "2020-10-06"]);

$mail = new PHPMailer(true);

//Recipients
$mail->setFrom('memento@gillesdelmotte.be', 'Mailer');
$mail->addAddress('gilles.delmotte@outlook.be', 'gilles delmotte');     // Add a recipient

// Content
$mail->isHTML(true);                                  // Set email format to HTML
$mail->Subject = 'C‘est le Cron qui fonctionne';
$mail->Body    = 'This is the HTML message body <b>in bold!</b>';
$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

$mail->send();
