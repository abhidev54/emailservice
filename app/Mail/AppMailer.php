<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AppMailer extends Mailable
{
    use Queueable, SerializesModels;
    public $params;
    public $subject;
    public $from_email;
    public $from_name;
    public $template;
    public $template_type;
    public $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(array $params)
    {
        $this->params  = $params;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if ($this->params['template_type'] == 'view') {

            return $this->view($this->template)
                ->from($this->from_email, $this->from_name)
                ->with('data', $this->data);
        } else {

            return $this->markdown($this->template)
                ->from($this->from_email, $this->from_name)
                ->with('data', $this->data)
                ->subject($this->subject);
        }
    }
}
