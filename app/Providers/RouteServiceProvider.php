<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        Route::bind('client', function ($value) {
            return \App\Client::path($value)
                ->currentuserteam()
                ->firstorfail();
        });

        Route::bind('project', function ($value) {
            return \App\Project::path($value)
                ->currentuserteam()
                ->firstorfail();
        });

        Route::bind('release', function ($value) {
            return \App\Release::path($value)->firstorfail();
        });

        Route::bind('feature', function ($value) {
            return \App\Feature::where('id', $value)->firstorfail();
        });

        Route::bind('document', function ($value) {
            return \App\Document::find($value)->firstorfail();
        });


        Route::bind('team', function ($value) {
            return \App\Team::slug($value);
        });
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();

        //
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/web.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
             ->middleware('api')
             ->namespace($this->namespace)
             ->group(base_path('routes/api.php'));
    }
}
