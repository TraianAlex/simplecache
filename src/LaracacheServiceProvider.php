<?php

namespace Vic\Laracache;

use Illuminate\Support\ServiceProvider;

class LaracacheServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \Blade::directive('cache', function($exp) {
            return "<?php if(! app('Vic\Laracache\BladeDirective')->setUp($exp)) { ?>";
        });
        \Blade::directive('endcache', function() {
            return "<?php } echo app('Vic\Laracache\BladeDirective')->tearDown() ?>";
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(BladeDirective::class, function(){
            //$cache = app('Illuminate\Contracts\Cache\Repository');
            //$russianDoll = new RussianCaching($cache);
            //return new BladeDirective($russianDoll);
            return new BladeDirective(new RussianCaching(app('cache.store')));
        });
    }
}
