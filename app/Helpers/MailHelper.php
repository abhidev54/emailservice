<?php


use App\Jobs\MailerJob;
use App\Jobs\UserMailerJob;
use App\Mail\AppMailer;

if (!function_exists('sendmail')) {

	function sendmail(array $data) {
		$success = false;
		try {	
			dispatch(new MailerJob($data));
			//UserMailerJob::dispatch($configuration, 'recipient', new AppMailer($data));
			$success = true;
			$message = "Email has been sent successfully";
		} catch (\Exception $e) {
			$message = $e->getMessage();
			throw $e;
		}
		$result = array(
			"success" => $success,
			"message" => $message
		);
		return $result;
	}

}