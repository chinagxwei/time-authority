<?php

namespace App\Providers;

use App\Models\Order\Order;
use App\Models\SystemBaseModel;
use App\Models\Wallet\Wallet;
use App\Models\Wallet\WalletFund;
use App\Models\Wallet\WalletLog;
use App\Observers\CreatedAndUpdatedObserver;
use App\Services\System\RouterCheckService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    protected $observes = [
        CreatedAndUpdatedObserver::class => [
            Order::class,
            Wallet::class,
            WalletFund::class,
            WalletLog::class
        ]
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

        foreach ($this->observes as $observe => $modules) {
            /** @var SystemBaseModel $module */
            foreach ($modules as $module) {
                $module::observe($observe);
            }
        }

        foreach ($this->services as $service) {
            $this->app->singleton($service, function () use ($service) {
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
