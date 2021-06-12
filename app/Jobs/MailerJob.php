<?php

namespace App\Jobs;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use App\Mail\AppMailer;
use App\Mail\CustomMail;
use Illuminate\Support\Facades\Log;

class MailerJob implements ShouldQueue
{
  use InteractsWithQueue, Queueable, SerializesModels;

  public $configuration;
  public $to;
  public $mailable;
  public $params;
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
    // Send email
    $config = CustomMail::getSmtpConfig();
    $response = CustomMail::prepare($config,$this->params);

    if($response) {
      // Success
      Log::info("Email sent successfully using default smtp provider!");
    } else {
      Log::error("Error occured while sending email using default smtp provider, Activating fallback mechanism");
  
    }
  }
}