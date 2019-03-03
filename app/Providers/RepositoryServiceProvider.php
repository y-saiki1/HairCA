<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Domains\Repositories\Accounts\AccountQuery;
use App\Infrastructures\Repositories\Applications\Auth\AuthManagerAccountQuery;

use App\Domains\Repositories\Accounts\Stylists\StylistQuery;
use App\Infrastructures\Repositories\Eloquents\Stylists\EloquentStylistQuery;
use App\Domains\Repositories\Accounts\Stylists\StylistCommand;
use App\Infrastructures\Repositories\Eloquents\Stylists\EloquentStylistCommand;

use App\Domains\Repositories\Accounts\Members\MemberQuery;
use App\Infrastructures\Repositories\Eloquents\Members\EloquentMemberQuery;
use App\Domains\Repositories\Accounts\Members\MemberCommand;
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
        $this->app->bind(AccountQuery::class, AuthManagerAccountQuery::class);
        
        $this->app->bind(StylistQuery::class, EloquentStylistQuery::class);
        $this->app->bind(StylistCommand::class, EloquentStylistCommand::class);

        $this->app->bind(MemberQuery::class, EloquentMemberQuery::class);
        $this->app->bind(MemberCommand::class, EloquentMemberCommand::class);
    }
}
