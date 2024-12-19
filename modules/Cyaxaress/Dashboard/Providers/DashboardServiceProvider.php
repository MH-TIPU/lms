<?php

namespace Cyaxaress\Dashboard\Providers;

use Illuminate\Support\ServiceProvider;

class DashboardServiceProvider extends ServiceProvider
{
    public function register()
    {
        // Load the routes from the specified file
        $this->loadRoutesFrom(__DIR__.'/../Routes/dashboard_routes.php');
        
        // Load the views from the specified directory and assign them a namespace
        $this->loadViewsFrom(__DIR__.'/../Resources/Views', 'Dashboard');
        
        // Merge the configuration from the specified file with the existing configuration
        $this->mergeConfigFrom(__DIR__.'/../Config/sidebar.php', 'sidebar');
    }

    public function boot()
    {
        // After the application has booted, set the sidebar configuration for the dashboard
        $this->app->booted(function () {
            config()->set('sidebar.items.dashboard', [
                'icon' => 'i-dashboard', // Icon for the dashboard
                'title' => 'Dashboard', // Title for the dashboard
                'url' => route('home'), // URL for the dashboard
            ]);
        });
    }
}
