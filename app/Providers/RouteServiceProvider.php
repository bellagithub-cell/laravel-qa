<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;
use App\Question;

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
     * The path to the "home" route for your application.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //bind costum route
         // The first argument is argument slug
        // and in second argument we can define a closure or anonymous function
        // which receive one argument let's call it slug.
        Route::bind('slug', function($slug){
            // jadi fungsi ini untuk cocokin slug mana yg ada di database cocok sama parameter yg kita kirim
        //    $question =  Question::with('answers.user')->where('slug', $slug)->first();
        // //    kalau gk ada di database kasih error kalau ada kirim isinya
        //    return $question ? $question : abort(404);

        //    untuk sort answer cara pertama
        // return Question::with(['answers.user', 'answers' =>function ($query){
        //     $query->orderBy('votes_count', 'DESC');
        // }])->where('slug', $slug)->first() ?? abort(404);
        
        return Question::with('user')->where('slug', $slug)->first() ?? abort(404);
        });
        parent::boot();
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
