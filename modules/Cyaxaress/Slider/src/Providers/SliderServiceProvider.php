<?php

namespace Cyaxaress\Slider\Providers;

use Cyaxaress\RolePermissions\Models\Permission;
use Cyaxaress\Slider\Database\Seeds\SliderSeeder;
use Cyaxaress\Slider\Models\Slide;
use Cyaxaress\Slider\Policies\SlidePolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class SliderServiceProvider extends ServiceProvider
{
    private $namespace = "Cyaxaress\Slider\Http\Controllers";

    public function register()
    {
        // Load routes from the specified file
        $this->loadRoutesFrom(__DIR__.'/../Routes/slider_routes.php');
        // Load views from the specified directory and namespace them as 'Slider'
        $this->loadViewsFrom(__DIR__.'/../Resources/Views/', 'Slider');
        // Load migrations from the specified directory
        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations');
        
        // Define a route group with 'web' middleware and the specified namespace
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(__DIR__.'/../Routes/slider_routes.php');

        // Define a policy for the Slide model
        Gate::policy(Slide::class, SlidePolicy::class);

        // Add the SliderSeeder to the list of seeders
        \DatabaseSeeder::$seeders[] = SliderSeeder::class;
    }

    public function boot()
    {
        // Set a configuration for the sidebar items
        config()->set('sidebar.items.slider', [
            'icon' => 'i-courses',
            'title' => 'Slider',
            'url' => route('slides.index'),
            'permission' => [
                Permission::PERMISSION_MANAGE_SLIDES,
            ],
        ]);
    }
}
