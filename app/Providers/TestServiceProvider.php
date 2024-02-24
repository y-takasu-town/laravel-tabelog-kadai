<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Contracts\UserSubscribable;
use App\Models\User;

class TestServiceProvider extends ServiceProvider
{
    public function register()
    {
        if ($this->app->environment('testing')) {
            $this->app->bind(UserSubscribable::class, function ($app) {
                $mock = \Mockery::mock(UserSubscribable::class);
                $mock->shouldReceive('subscribed')
                     ->andReturn(true);
                return $mock;
            });
        }
    }
}
