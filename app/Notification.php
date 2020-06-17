<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

echo 'On est sur le model Notification qui n‘est pas dans app';


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

class Notification extends Model
{

}
