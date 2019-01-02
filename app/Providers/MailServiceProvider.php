<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Domains\UseCases\Accounts\Stylists\InviteStylistUseCase;
use App\Domains\UseCases\Mailers\MailerUseCaseCommand;
use App\Infrastructures\Mailers\LaravelMailer;

class MailServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app
            ->when(InviteStylistUseCase::class)
            ->needs(MailerUseCaseCommand::class)
            ->give(LaravelMailer::class);
    }
}
