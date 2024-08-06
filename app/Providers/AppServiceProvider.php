<?php

namespace App\Providers;

use App\Models\SystemBaseModel;
use App\Services\System\RouterCheckService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    protected $observes = [

    ];

    protected $services = [
        RouterCheckService::class,
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

        foreach ($this->services as $service){
            $this->app->singleton($service, function () use ($service){
                return new $service();
            });
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
