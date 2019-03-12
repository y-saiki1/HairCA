<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Domains\UseCases\Accounts\Members\ICreateMemberUseCase;
use App\Interactors\Accounts\Members\CreateMemberInteractor;

use App\Domains\UseCases\Accounts\Stylists\ICreateStylistUseCase;
use App\Interactors\Accounts\Stylists\AuthenticateInvitationInteractor;

use App\Domains\UseCases\Accounts\Stylists\IAuthenticateInvitationUseCase;
use App\Interactors\Accounts\Stylists\CreateStylistInteractor;

use App\Domains\UseCases\Accounts\StylistProfiles\ICreateStylistProfileUseCase;
use App\Interactors\Accounts\StylistProfiles\CreateStylistProfileInteractor;


use App\Domains\UseCases\Accounts\Stylists\IInviteStylistUseCase;
use App\Interactors\Accounts\Stylists\InviteStylistInteractor;

class UseCaseServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(ICreateMemberUseCase::class, CreateMemberInteractor::class);

        $this->app->bind(IAuthenticateInvitationUseCase::class, AuthenticateInvitationInteractor::class);
        $this->app->bind(ICreateStylistUseCase::class, CreateStylistInteractor::class);
        $this->app->bind(ICreateStylistProfileUseCase::class, CreateStylistProfileInteractor::class);
        $this->app->bind(IInviteStylistUseCase::class, InviteStylistInteractor::class);
    }
}
