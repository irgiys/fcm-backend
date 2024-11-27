<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Kreait\Firebase\Factory;

class FirebaseServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('firebase', function () {
            $credentials = base_path(env('FIREBASE_CREDENTIALS'));
            return (new Factory())->withServiceAccount($credentials);
        });
    }
}
