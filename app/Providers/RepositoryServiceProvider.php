<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Domains\UseCases\Accounts\AccountUseCaseQuery;
use App\Infrastructures\Repositories\Applications\Auth\AuthManagerAccountQueryRepository;

use App\Domains\UseCases\Accounts\Stylists\StylistUseCaseQuery;
use App\Infrastructures\Repositories\Eloquents\Stylists\EloquentStylistQueryRepository;
use App\Domains\UseCases\Accounts\Stylists\StylistUseCaseCommand;
use App\Infrastructures\Repositories\Eloquents\Stylists\EloquentStylistCommandRepository;

// use App\Domains\UseCases\Accounts\Members\MemberUseCaseQuery;
// use App\Infrastructures\Repositories\Eloquents\Members\EloquentMemberQueryRepository;
use App\Domains\UseCases\Accounts\Members\MemberUseCaseCommand;
use App\Infrastructures\Repositories\Eloquents\Members\EloquentMemberCommandRepository;

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

        $this->app->bind(MemberUseCaseCommand::class, EloquentMemberCommandRepository::class);
    }
}
