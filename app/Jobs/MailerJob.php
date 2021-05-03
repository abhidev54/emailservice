<?php

namespace App\Jobs;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use App\Mail\AppMailer;
use Illuminate\Support\Facades\Log;

class MailerJob implements ShouldQueue
{
  use InteractsWithQueue, Queueable, SerializesModels;

  public $configuration;
  public $to;
  public $mailable;

  /**
  * Create a new job instance.
  *
  * @param array $configuration
  * @param string $to
  * @param Mailable $mailable
  */
  public function __construct(array $params)
  {
    $this->params = $params;
  }

  /**
  * Execute the job.
  *
  * @return void
  */
  public function handle()
  {
    $config = $this->getSmtpConfig();
    $mailer = app()->makeWith('user.mailer', $config);
    $response = $mailer->to($this->params['to'])->send(new AppMailer($this->params));
  }

  public function getSmtpConfig($failedcount = 0) {
    $smtp_config = array();
    $config = app('config')->get('mail', []);
    if(is_array($config) && count($config) > 0){
        $smtp_config = $config[$failedcount];
    } else {
        Log::error("No SMTP providers configured in config/mail.php");
    }
    return $smtp_config;
  }
}