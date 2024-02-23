<?php

namespace App\Contracts;

interface UserSubscribable
{
    public function subscribed($name = 'default', $price = null);
}
