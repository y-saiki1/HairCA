<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Domains\UseCases\Accounts\AccountUseCaseQuery;
use App\Infrastructures\Repositories\Applications\Auth\AuthManagerAccountQueryRepository;

use App\Domains\UseCases\Accounts\AccountUseCaseCommand;
use App\Infrastructures\Repositories\Eloquents\EloquentAccountCommandRepository;

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
        $this->app->bind(AccountUseCaseCommand::class, EloquentAccountCommandRepository::class);
    }
}
