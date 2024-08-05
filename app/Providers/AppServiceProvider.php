<?php

namespace App\Providers;

use App\Models\SystemBaseModel;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    protected $observes = [

    ];

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        /**
         * @var SystemBaseModel $model
         * @var  $observers
         */
        foreach ($this->observes as $model => $observers){
            $model::observe($observers);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
