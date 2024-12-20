<?php

namespace Cyaxaress\Category\Providers;

use Cyaxaress\Category\Database\Seeds\CategoriesTableSeeder;
use Cyaxaress\Category\Models\Category;
use Cyaxaress\Category\Policies\CategoryPolicy;
use Cyaxaress\RolePermissions\Models\Permission;
use DatabaseSeeder;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class CategoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->loadRoutesFrom(__DIR__.'/../Routes/categories_routes.php');
        $this->loadViewsFrom(__DIR__.'/../Resources/Views/', 'Categories');
        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations');
        $this->loadJsonTranslationsFrom(__DIR__.'/../Lang');
        DatabaseSeeder::$seeders[] = CategoriesTableSeeder::class;
        Gate::policy(Category::class, CategoryPolicy::class);
    }

    public function boot()
    {
        config()->set('sidebar.items.categories', [
            'icon' => 'i-categories',
            'title' => 'Categories',
            'url' => route('categories.index'),
            'permission' => Permission::PERMISSION_MANAGE_CATEGORIES,
        ]);
    }
}
