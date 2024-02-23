<?php

namespace Tests\Unit;

use App\Models\User;
use App\Services\SubscriptionService;
use PHPUnit\Framework\TestCase;

class SubscriptionServiceTest extends TestCase
{
    public function testIsSubscribedReturnsTrueWhenSubscribed()
    {
        // User モデルのモックを作成
        $user = $this->createMock(User::class);
        // subscribed メソッドが呼ばれたときに true を返すように設定
        $user->method('subscribed')->willReturn(true);

        $service = new SubscriptionService();

        // isSubscribed メソッドが true を返すことを確認
        $this->assertTrue($service->isSubscribed($user));
    }

    public function testIsSubscribedReturnsFalseWhenNotSubscribed()
    {
        // User モデルのモックを作成
        $user = $this->createMock(User::class);
        // subscribed メソッドが呼ばれたときに false を返すように設定
        $user->method('subscribed')->willReturn(false);

        $service = new SubscriptionService();

        // isSubscribed メソッドが false を返すことを確認
        $this->assertFalse($service->isSubscribed($user));
    }
}
