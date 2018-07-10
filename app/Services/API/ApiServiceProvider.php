<?php

namespace API;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class ApiServiceProvider extends ServiceProvider
{
    protected $namespace = 'API\Http\Controllers';

    /**
     * Listeners
     *
     * @var array
     */
    protected $listeners = [

    ];

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        Route::group([
            'prefix' => 'api/v1',
        ], function () {

            Route::group([
                'namespace' => $this->namespace,
            ], function() {
                require __DIR__ . '/Http/routes.php';
            });

            // if no matches in group
            Route::any('{all}', 'API\Http\Controllers\OtherRouteController@index')->where('all', '.*');
        });
    }
}
