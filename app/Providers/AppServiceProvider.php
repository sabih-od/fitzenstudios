<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*', function ($view) {
            if (Auth::check()) {
                $user = null;
                if (Auth::user()->role_id == 2) {
                    $user = \App\Models\Customer::where('user_id', Auth()->id())
                        ->first(['first_name', 'last_name', 'photo']);
                } elseif (Auth::user()->role_id == 3) {
                    $user = \App\Models\Trainer::where('user_id', Auth()->id())
                        ->first(['name', 'last_name', 'photo']);
                }
                $view->with('user', $user);
                // update the timezones as per the user location
                config(['app.timezone' => $user->time_zone]);
            }
        });
        Schema::defaultStringLength(191);
    }
}
