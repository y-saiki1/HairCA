<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Packages\Domain\UseCases\Accounts\Members\CreateMemberUseCase;
use Packages\Interactors\Accounts\Members\CreateMemberInteractor;

use Packages\Domain\UseCases\Accounts\Stylists\CreateStylistUseCase;
use Packages\Interactors\Accounts\Stylists\AuthenticateInvitationInteractor;

use Packages\Domain\UseCases\Accounts\Stylists\AuthenticateInvitationUseCase;
use Packages\Interactors\Accounts\Stylists\CreateStylistInteractor;

use Packages\Domain\UseCases\Profiles\StylistProfiles\CreateStylistProfileUseCase;
use Packages\Interactors\Profiles\StylistProfiles\CreateStylistProfileInteractor;


use Packages\Domain\UseCases\Accounts\Stylists\InviteStylistUseCase;
use Packages\Interactors\Accounts\Stylists\InviteStylistInteractor;

use Packages\Domain\UseCases\StyleBooks\CreateStyleBookUseCase;
use Packages\Interactors\StyleBooks\CreateStyleBookInteractor;

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
        $this->app->bind(CreateStyleBookUseCase::class, CreateStyleBookInteractor::class);
    }
}
