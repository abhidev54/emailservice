<?php


use App\Jobs\MailerJob;

if (!function_exists('sendmail')) {

	function sendmail(array $data) {
		$success = false;
		$job_id = 0;
		try {	
			//$job = dispatch(new MailerJob($data));
			$job_id = app(\Illuminate\Contracts\Bus\Dispatcher::class)->dispatch(new MailerJob($data));
			$success = true;
			$message = "Email has been sent successfully";
		} catch (\Exception $e) {
			$message = $e->getMessage();
			throw $e;
		}
		$result = array(
			"success" => $success,
			"job_id" => $job_id,
			"message" => $message
		);
		return $result;
	}

}