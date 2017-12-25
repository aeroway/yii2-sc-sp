<?php

namespace common\libs;

use phpmailer\phpmailer\PHPMailerAutoload;

class sendEmail
{
    public function sendEmail($sendEmail, $subject, $body = "no body")
    {
        $mail = new PHPMailer(true);

        $mail->isSMTP();                             // Set mailer to use SMTP
        $mail->Host = Yii::$app->params['host'];     // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                      // Enable SMTP authentication
        $mail->Username = Yii::$app->params['smtp_username'];  //SMTP username
        $mail->Password = Yii::$app->params['smtp_password'];  //SMTP password
        $mail->SMTPSecure = 'ssl';               // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 465;                       // TCP port to connect to
        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';
        $mail->setFrom(Yii::$app->params['mail'], Yii::$app->params['mail_name']);

        if(is_array($sendEmail))
        {
            foreach($sendEmail as $value)
            {
                $mail->addAddress($value); // Add a recipient
            }
        }
        else
        {
            $mail->addAddress($sendEmail); // Add a recipient
        }

        $mail->Subject = $subject;
        $mail->Body = $body;

        if(!$mail->send())
        {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
            die('1');
        }
        else
        {
            echo 'Message has been sent';
            die('2');
        }
    }
}