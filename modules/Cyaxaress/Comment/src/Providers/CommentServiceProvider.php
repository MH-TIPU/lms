<?php

namespace Cyaxaress\Comment\Providers;

use Cyaxaress\Comment\Models\Comment;
use Cyaxaress\Comment\Policies\CommentPolicy;
use Cyaxaress\RolePermissions\Models\Permission;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class CommentServiceProvider extends ServiceProvider
{
    protected $namespace = "Cyaxaress\Comment\Http\Controllers";

    public function register()
    {
        // Load the migrations from the specified directory
        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations');
        
        // Load the views from the specified directory and namespace them as 'Comments'
        $this->loadViewsFrom(__DIR__.'/../Resources/Views', 'Comments');
        
        // Define the routes for comments with 'web' and 'auth' middleware
        Route::middleware(['web', 'auth'])
            ->namespace($this->namespace)
            ->group(__DIR__.'/../Routes/comments_routes.php');
        
        // Load the JSON translations from the specified directory
        $this->loadJsonTranslationsFrom(__DIR__.'/../Resources/Lang');

        // Define the policy for the Comment model
        Gate::policy(Comment::class, CommentPolicy::class);
    }

    public function boot()
    {
        // Set the configuration for the sidebar items
        config()->set('sidebar.items.comments', [
            'icon' => 'i-comments',
            'title' => 'Comments',
            'url' => route('comments.index'),
            'permission' => [Permission::PERMISSION_MANAGE_COMMENTS, Permission::PERMISSION_TEACH],
        ]);
    }
}
