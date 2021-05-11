<?php

namespace App\Providers;

use App\Repositories\ClubRepository;
use App\Repositories\CountryRepository;
use App\Repositories\LeagueRepository;
use App\Repositories\PlayerRepository;
use Illuminate\Pagination\Paginator;
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
        $this->app->bind(CountryRepository::class);
        $this->app->bind(LeagueRepository::class);
        $this->app->bind(ClubRepository::class);
        $this->app->bind(PlayerRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
    }
}
