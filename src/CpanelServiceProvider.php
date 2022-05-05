<?php 
namespace Amarneche\CpanelApi;

use Illuminate\Support\ServiceProvider;


class CpanelServiceProvider extends ServiceProvider{

    public function boot() {
        $this->publishes([
            __DIR__ . '../config/cpanel.php'=>config_path('cpanel.php'),
        ]);
    }
    public function register (){
        $this->app->singleton(Cpanel::class,function($app){
            return new Cpanel();
        });
    }
}