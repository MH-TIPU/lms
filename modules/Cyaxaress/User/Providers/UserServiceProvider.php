<?php

namespace Cyaxaress\User\Providers;

use Cyaxaress\RolePermissions\Models\Permission;
use Cyaxaress\User\Database\Seeds\UsersTableSeeder;
use Cyaxaress\User\Http\Middleware\StoreUserIp;
use Cyaxaress\User\Models\User;
use Cyaxaress\User\Policies\UserPolicy;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class UserServiceProvider extends ServiceProvider
{
    public function register()
    {
        // Load routes from the specified file
        $this->loadRoutesFrom(__DIR__.'/../Routes/user_routes.php');
        
        // Load migrations from the specified directory
        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations');
        
        // Load factories from the specified directory
        $this->loadFactoriesFrom(__DIR__.'/../Database/Factories');
        
        // Load views from the specified directory and namespace them as 'User'
        $this->loadViewsFrom(__DIR__.'/../Resources/Views', 'User');
        
        // Load JSON translations from the specified directory
        $this->loadJsonTranslationsFrom(__DIR__.'/../Resources/Lang');
        
        // Add middleware to the 'web' group
        $this->app['router']->pushMiddlewareToGroup('web', StoreUserIp::class);

        // Guess factory names using the specified callback
        Factory::guessFactoryNamesUsing(function (string $modelName) {
            return 'Cyaxaress\User\Database\Factories\\'.class_basename($modelName).'Factory';
        });

        // Set the user model for authentication
        config()->set('auth.providers.users.model', User::class);
        
        // Define a policy for the User model
        Gate::policy(User::class, UserPolicy::class);
        
        // Add the UsersTableSeeder to the list of seeders
        \DatabaseSeeder::$seeders[] = UsersTableSeeder::class;
    }

    public function boot()
    {
        // Set the sidebar configuration for users
        config()->set('sidebar.items.users', [
            'icon' => 'i-users',
            'title' => 'Users',
            'url' => route('users.index'),
            'permission' => Permission::PERMISSION_MANAGE_USERS,
        ]);

        // Set the sidebar configuration for user information
        config()->set('sidebar.items.usersInformation', [
            'icon' => 'i-user__information',
            'title' => 'User Information',
            'url' => route('users.profile'),
        ]);
    }
}
