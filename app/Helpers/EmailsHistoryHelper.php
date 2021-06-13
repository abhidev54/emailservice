<?php


use App\Models\EmailHistory;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

if (!function_exists('insert_email_history')) {

	/**
	 * Get email history
	 */
	function get_email_history() {
		return EmailHistory::orderByDesc("updated_at")->get();
	}

	/**
	 * Insert email history
	 */
	function insert_email_history(array $data) {
		$current_timestamp = Carbon::now()->toDateTimeString();

		$email_history = new EmailHistory();
        $email_history->job_id = $data['job_id'];
		$email_history->to_email = $data['to_email'];
		$email_history->to_name = $data['to_name'];
		$email_history->from_email = $data['from_email'];
		$email_history->from_name = $data['from_name'];
		$email_history->subject = $data['subject'];
		$email_history->body = $data['body'];
		$email_history->status = $data['status'];

        $email_history->created_at = $current_timestamp;
        $email_history->updated_at = $current_timestamp;
        $response = $email_history->save();

		return $response;
	}

	/**
	 * Update status of email in history table
	 */
	function update_history($job_id, array $data) {
		if(!empty($job_id) && $job_id > 0) {
			$email_history = EmailHistory::where('job_id', '=', $job_id)->first();

            if (!empty($email_history)) {
				Log::info("Updating status ".$data['status']." for JOB ID : ".$job_id);
                // If entry exist, update the status
				$current_timestamp = Carbon::now()->toDateTimeString();
        		$email_history->status = $data['status'];
				$email_history->updated_at = $current_timestamp;
				$response = $email_history->save();
				return $response;
            } 
		}
	}

}