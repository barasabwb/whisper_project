<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require BASE.'vendor/phpmailer/phpmailer/src/Exception.php';
require BASE.'vendor/phpmailer/phpmailer/src/PHPMailer.php';
require BASE.'vendor/phpmailer/phpmailer/src/SMTP.php';
require BASE.'vendor/autoload.php';
session_start();

function checkLogin(){
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
        return true;
    }
    return false;
}

function getTimeDifference($date){
    $d = time() - strtotime($date);
    if ($d < 60)
        $time_posted = $d." s"." ago";
    else
    {
        $d = floor($d / 60);
        if($d < 60)
            $time_posted = $d." min".(($d==1)?'':'s')." ago";
        else
        {
            $d = floor($d / 60);
            if($d < 24)
                $time_posted = $d." hour".(($d==1)?'':'s')." ago";
            else
            {
                $d = floor($d / 24);
                if($d < 7)
                    $time_posted = $d." day".(($d==1)?'':'s')." ago";
                else
                {
                    $d = floor($d / 7);
                    if($d < 4){
                        $time_posted = $d." week".(($d==1)?'':'s')." ago";
                    }else{
                        $d = floor($d/4);
                        if($d < 12){
                            $time_posted = $d." month".(($d==1)?'':'s')." ago";
                        }else{
                            $time_posted = $d." year".(($d==1)?'':'s')." ago";
                        }
                    }
                }//Week
            }//Day
        }//Hour
    }//Minute
    return $time_posted;
}

function send_email($to, $subject, $body){
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'brian.dev329@gmail.com';                     //SMTP username
        $mail->Password   = 'ooagimptfunelivy';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        $mail->setFrom('brian.dev329@gmail.com', 'Whisper');
        $mail->addAddress($to);               //Name is optional

        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body    = $body;

        $mail->send();
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}