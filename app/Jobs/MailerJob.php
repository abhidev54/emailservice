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
      // Update the delivered status in history table
      $this->update_status($this->job->getJobId(),'delivered');

      Log::info("Email sent successfully using default smtp provider! , JOB ID : ".$this->job->getJobId());
    } else {
      Log::error("Error occured while sending email using default smtp provider, Activating fallback mechanism , JOB ID : ".$this->job->getJobId());
      $response = CustomMail::processViaFallback(1,$this->params);

      if($response) {
        // Update the delivered status in history table
        $this->update_status($this->job->getJobId(),'delivered');
      } else {
        // Update the delivered status in history table
        $this->update_status($this->job->getJobId(),'bounced');
      }
    }
  }


  public function update_status($job_id, $status) {
    $this->params['status'] = $status;
    $response = update_history($job_id,$this->params);
  }
}