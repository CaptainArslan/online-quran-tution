<?php

namespace App\Providers;

use App\Models\EmailNotification;
use App\Models\Setting;
use Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Validator;

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
        Validator::extend('recaptcha', 'App\\Validators\\ReCaptcha@validate');
        \Illuminate\Support\Facades\Schema::defaultStringLength(191);
        View::composer('*', function ($view) {
            $user = Auth::user();
            $view->with('settings', Setting::pluck('value', 'name')->toArray());
            $view->with('allowed_mails', EmailNotification::first());
            $view->with('user', $user);
        });
    }
}
