<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmailController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       
    }

    public function send(Request $request)
    {
        $params = array(
            "from_email" => $request->input("from_email"),
            "from_name" => $request->input("from_name"),
            "to_email" => $request->input("to_email"),
            "to_name" => $request->input("to_name"),
            "subject" => $request->input("subject"),
            "body" => $request->input("body")
        );
        //echo "<pre>";print_r($params);exit;
        $response = sendmail($params);

        // Insert in email history table
        if($response['success']) {
            $params['job_id'] = $response['job_id'];
            $params['status'] = "queued";
            insert_email_history($params);
        }
        return response()->json($response);

    }

    
    public function history(Request $request)
    {
        $history = get_email_history();
        return response()->json($history);
    }

}
