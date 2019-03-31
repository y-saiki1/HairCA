<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Packages\Domain\UseCases\Accounts\Members\CreateMemberUseCase;
use App\Interactors\Accounts\Members\CreateMemberInteractor;

use Packages\Domain\UseCases\Accounts\Stylists\CreateStylistUseCase;
use App\Interactors\Accounts\Stylists\AuthenticateInvitationInteractor;

use Packages\Domain\UseCases\Accounts\Stylists\AuthenticateInvitationUseCase;
use App\Interactors\Accounts\Stylists\CreateStylistInteractor;

use Packages\Domain\UseCases\Accounts\StylistProfiles\CreateStylistProfileUseCase;
use App\Interactors\Accounts\StylistProfiles\CreateStylistProfileInteractor;


use Packages\Domain\UseCases\Accounts\Stylists\InviteStylistUseCase;
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
        $this->app->bind(CreateMemberUseCase::class, CreateMemberInteractor::class);
        $this->app->bind(AuthenticateInvitationUseCase::class, AuthenticateInvitationInteractor::class);
        $this->app->bind(CreateStylistUseCase::class, CreateStylistInteractor::class);
        $this->app->bind(CreateStylistProfileUseCase::class, CreateStylistProfileInteractor::class);
        $this->app->bind(InviteStylistUseCase::class, InviteStylistInteractor::class);
    }
}