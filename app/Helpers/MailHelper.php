<?php


use App\Jobs\MailerJob;


if (!function_exists('sendmail')) {

	function sendmail(array $data) {
		$success = false;
		try {	
			dispatch(new MailerJob($data));
			$success = true;
			$message = "Email has been sent successfully";
		} catch (\Exception $e) {
			$message = $e->getMessage();
		}
		$result = array(
			"success" => $success,
			"message" => $message
		);
		return $result;
	}

}