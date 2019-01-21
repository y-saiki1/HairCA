<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Domains\UseCases\Accounts\AccountUseCaseQuery;
use App\Infrastructures\Repositories\Applications\Auth\AuthManagerAccountQueryRepository;

use App\Domains\UseCases\Accounts\Stylists\StylistUseCaseQuery;
use App\Infrastructures\Repositories\Eloquents\Stylists\EloquentStylistQueryRepository;

use App\Domains\UseCases\Accounts\Stylists\StylistUseCaseCommand;
use App\Infrastructures\Repositories\Eloquents\Stylists\EloquentStylistCommandRepository;

class RepositoryServiceProvider extends ServiceProvider
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
        $this->app->bind(AccountUseCaseQuery::class, AuthManagerAccountQueryRepository::class);
        
        $this->app->bind(StylistUseCaseQuery::class, EloquentStylistQueryRepository::class);
        $this->app->bind(StylistUseCaseCommand::class, EloquentStylistCommandRepository::class);
    }
}
