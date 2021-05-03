<?php namespace App\Providers;

use Illuminate\Mail\MailServiceProvider as MailProvider;

class MailServiceProvider extends MailProvider
{
    protected function registerSwiftTransport()
    {
        $this->app->singleton('swift.transport', function ($app) {
            return new \CustomMailTransportManager($app);
        });
    }

}