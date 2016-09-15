<?php

namespace App\Providers;

use App\Models\Relationship;
use App\Models\User;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer(['user.master', 'user.profile'], function($view) {
            $user = auth()->user();
            $users = User::where('id', '<>', $user->id)->where('roles', config('roles.user'))->get();
            $relationships = Relationship::where('follower_id', $user->id)->pluck('following_id');
            $view->with([
                'user'=> $user,
                'users'=> $users,
                'relationships' => $relationships,
            ]);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
