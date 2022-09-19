<?php

namespace App\Providers;

use App\Contracts\IOrganizationService;
use App\Http\Services\OrganizationService;
use App\Contracts\IUserService;
use App\Http\Services\UserService;
use App\Models\User;
use App\Observers\UserObserver;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        App::bind(IOrganizationService::class, OrganizationService::class);
        App::bind(IUserService::class, UserService::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        User::observe(UserObserver::class);
    }
}
