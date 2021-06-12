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

    /**
     * Function to send email
     */
    public function send1(Request $request)
    {
        $params = array(
            "data" => array(
                "content" => $request->input("message")
            ),
            "to" => $request->input("to"),
            "from_email" => $request->input("from_email"),
            "from_name" => $request->input("from_name"),
            "subject" => $request->input("subject"),
            "template_type" => 'markdown',
            "template" => env('MAIL_DEFAULT_TEMPLATE')
        );
        //echo "<pre>";print_r($params);exit;
        $response = sendmail($params);
        //return response()->json($response);
        echo "email sent";
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
        //return response()->json($response);
        echo "email sent";
    }

}
