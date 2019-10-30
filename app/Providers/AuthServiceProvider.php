<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        $user = \Auth::user();

        
        // Auth gates for: User management
        Gate::define('user_management_access', function ($user) {
            return in_array($user->role_id, [1]);
        });
        // Auth gates for: User management
        Gate::define('blog_management_access', function ($user) {
            return in_array($user->role_id, [1,2]);
        });

        // Auth gates for: Roles
        Gate::define('role_access', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('role_create', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('role_edit', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('role_view', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('role_delete', function ($user) {
            return in_array($user->role_id, [1]);
        });

        // Auth gates for: Users
        Gate::define('user_access', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('user_create', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('user_edit', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('user_view', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('user_delete', function ($user) {
            return in_array($user->role_id, [1]);
        });

        // Auth gates for: Category
        Gate::define('category_access', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });
        Gate::define('category_create', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });
        Gate::define('category_edit', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });
        Gate::define('category_view', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });
        Gate::define('category_delete', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });

        // Auth gates for: Tags
        Gate::define('tags_access', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });
        Gate::define('tags_create', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });
        Gate::define('tags_edit', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });
        Gate::define('tags_view', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });
        Gate::define('tags_delete', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });

        // Auth gates for: Blogs
        Gate::define('blog_access', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });
        Gate::define('blog_create', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });
        Gate::define('blog_edit', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });
        Gate::define('blog_view', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });
        Gate::define('blog_delete', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });

        // Auth gates for: Comment
        Gate::define('comment_update', function($user){
            return in_array($user->role_id, [1,2]);
        });
        Gate::define('comment_delete', function($user){
            return in_array($user->role_id, [1,2]);
        });

        // Auth gates for: Celoteh Kopang
        Gate::define('celoteh_access', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });
        Gate::define('celoteh_create', function ($user) {
            return in_array($user->role_id, [1,2]);
        });
        Gate::define('celoteh_edit', function ($user) {
            return in_array($user->role_id, [1,2]);
        });
        Gate::define('celoteh_view', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });
        Gate::define('celoteh_delete', function ($user) {
            return in_array($user->role_id, [1,2]);
        });
        Gate::define('celoteh_booking', function ($user){
            return in_array($user->role_id, [3]);
        });

        // Auth gates for: City
        Gate::define('city_access', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('city_create', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('city_edit', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('city_view', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('city_delete', function ($user) {
            return in_array($user->role_id, [1]);
        });

        // Auth gates for: Payments
        Gate::define('payment_access', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });
        Gate::define('payment_create', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });
        Gate::define('payment_view', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });

        //user profile
         Gate::define('profile_view', function ($user) {
            return in_array($user->role_id, [3, 4]);
        });

        //Order Moderate
         Gate::define('order_view', function ($user) {
            return in_array($user->role_id, [1, 2]);
         });

         Gate::define('order_moderate', function ($user) {
            return in_array($user->role_id, 1);
         });

         Gate::define('order_delete', function ($user)
         {
            return in_array($user->role_id, [1,3,4]);
         });

    }
}
