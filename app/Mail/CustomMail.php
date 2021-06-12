<?php

namespace App\Mail;

class CustomMail
{
    public static function send($swift_mailer, $data=array())
    {
        $from_email = $data['from_email'];
        $from_name = $data['from_name'];
        $to_email = $data['to_email'];
        $to_name = $data['to_name'];
        $subject = $data['subject'];
        $body = $data['body'];

        $message   = (new \Swift_Message($subject))
            ->setFrom($from_email, $from_name)
            ->setTo($to_email, $to_name)
            ->setBody($body);

        return $swift_mailer->send($message);
    }
}

?>