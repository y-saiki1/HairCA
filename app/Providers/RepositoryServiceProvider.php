<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Packages\Domain\Repositories\Accounts\AccountQuery;
use Packages\Infrastructures\Repositories\Applications\Auth\AuthManagerAccountQuery;

use Packages\Domain\Repositories\Accounts\Stylists\StylistQuery;
use Packages\Infrastructures\Repositories\Eloquents\Stylists\EloquentStylistQuery;

use Packages\Domain\Repositories\Accounts\Stylists\StylistCommand;
use Packages\Infrastructures\Repositories\Eloquents\Stylists\EloquentStylistCommand;

use Packages\Domain\Repositories\Accounts\Members\MemberQuery;
use Packages\Infrastructures\Repositories\Eloquents\Members\EloquentMemberQuery;

use Packages\Domain\Repositories\Accounts\Members\MemberCommand;
use Packages\Infrastructures\Repositories\Eloquents\Members\EloquentMemberCommand;

use Packages\Domain\Repositories\StyleBooks\StyleBookCommand;
use Packages\Infrastructures\Repositories\Eloquents\StyleBooks\EloquentStyleBookCommand;

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

        $this->app->bind(StyleBookCommand::class, EloquentStyleBookCommand::class);
    }
}
