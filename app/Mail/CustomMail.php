<?php

namespace App\Mail;
use Illuminate\Support\Facades\Log;

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

    public static function getSmtpConfig($failedcount = 0) {
        $smtp_config = array();
        $config = app('config')->get('mail', []);
        if(is_array($config) && count($config) > 0){
            $smtp_config = $config[$failedcount];
        } else {
            Log::error("No SMTP providers configured in config/mail.php");
        }
        return $smtp_config;
      }
    
      public static function processViaFallback($failedcount = 0, $params) {
        $config = app('config')->get('mail', []);
        if(is_array($config) && count($config) > 0){
          for ($i=1; $i < count($config); $i++) { 
            // Send email using fallback (starting index 1 from smtp config)
            $config = self::getSmtpConfig($i);
            $response = self::prepare($config,$params);
    
            if($response) break;
            else continue;
          }
        } else {
          Log::error("No Fallback SMTP providers configured in config/mail.php");
        }
      }

      
    public static function prepare($config, $params) {
        $mailer = app()->makeWith('user.mailer', $config);
        $response = self::send($mailer, $params);
        return $response;
    }
}
