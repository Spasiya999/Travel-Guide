<?php

namespace App\Providers;

use App\Models\Config;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        config([
            'mail.mailer'       => Config::getValue('mail_mailer', config('mail.mailer')),
            'mail.host'         => Config::getValue('mail_host', config('mail.host')),
            'mail.port'         => Config::getValue('mail_port', config('mail.port')),
            'mail.username'     => Config::getValue('mail_username', config('mail.username')),
            'mail.password'     => Config::getValue('mail_password', config('mail.password')),
            'mail.encryption'   => Config::getValue('mail_encryption', config('mail.encryption')),
            'mail.from.address' => Config::getValue('mail_from_address', config('mail.from.address')),
            'mail.from.name'    => Config::getValue('mail_from_name', config('mail.from.name')),
        ]);
    }
}
