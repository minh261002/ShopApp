<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    protected $repositories = [
        'App\Repositories\BaseRepositoryInterface' => 'App\Repositories\BaseRepository',
        'App\Repositories\Module\ModuleRepositoryInterface' => 'App\Repositories\Module\ModuleRepository',
        'App\Repositories\Permission\PermissionRepositoryInterface' => 'App\Repositories\Permission\PermissionRepository',
        'App\Repositories\Role\RoleRepositoryInterface' => 'App\Repositories\Role\RoleRepository',
        'App\Repositories\Admin\AdminRepositoryInterface' => 'App\Repositories\Admin\AdminRepository',
        'App\Repositories\User\UserRepositoryInterface' => 'App\Repositories\User\UserRepository',
        'App\Repositories\Slider\SliderRepositoryInterface' => 'App\Repositories\Slider\SliderRepository',
        'App\Repositories\Slider\SliderItemRepositoryInterface' => 'App\Repositories\Slider\SliderItemRepository',
        'App\Repositories\Post\PostRepositoryInterface' => 'App\Repositories\Post\PostRepository',
        'App\Repositories\Post\PostCatalogueRepositoryInterface' => 'App\Repositories\Post\PostCatalogueRepository',
    ];

    public function register(): void
    {
        foreach ($this->repositories as $interface => $repository) {
            $this->app->bind($interface, $repository);
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}