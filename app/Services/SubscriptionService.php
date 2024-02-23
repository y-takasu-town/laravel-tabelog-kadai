<?php

namespace App\Services;

use App\Models\User;

class SubscriptionService
{
    public function isSubscribed(User $user, $name = 'default', $price = 300): bool
    {
        return $user->subscribed($name, $price);
    }
}
