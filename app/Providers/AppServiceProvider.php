<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Mail\Mailer;
use Illuminate\Support\Arr;
use Illuminate\Contracts\View\Factory as ViewFactory;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('user.mailer', function ($app, $parameters) {
            $smtp_host = Arr::get($parameters, 'smtp_host');
            $smtp_port = Arr::get($parameters, 'smtp_port');
            $smtp_username = Arr::get($parameters, 'smtp_username');
            $smtp_password = Arr::get($parameters, 'smtp_password');
            $smtp_encryption = Arr::get($parameters, 'smtp_encryption');

            $transport = new \Swift_SmtpTransport($smtp_host, $smtp_port);
            $transport->setUsername($smtp_username);
            $transport->setPassword($smtp_password);
            $transport->setEncryption($smtp_encryption);

            $swift_mailer = new \Swift_Mailer($transport);
            //print_r($app);exit;
            //$mailer = new Mailer('',view('emails.default-mailer'), $swift_mailer, $app->get('events'));
            //$mailer = new Mailer('emails.default-mailer',$app->get('view'), $swift_mailer, $app->get('events'));
            //$mailer = new Mailer(view('emails.default-mailer',['data' =>['content' => ""]]), $swift_mailer);
            //$mailer = new Mailer(app('view')->addNamespace('mail', resource_path('views') . '/emails'), $swift_mailer);
            //$mailer->alwaysFrom($from_email, $from_name);
            //$mailer->alwaysReplyTo($from_email, $from_name);

            return $swift_mailer;
        });
    }
}
