<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\models\setting\TokoModel;

class TokoProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $toko = TokoModel::all();
        \View::share('tokodata',[$toko]);
    }
}
