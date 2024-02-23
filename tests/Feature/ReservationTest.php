<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Store;
use App\Models\Reservation;
use App\Services\SubscriptionService;
use Mockery;

class ReservationTest extends TestCase
{
    use RefreshDatabase;

    public function test_access_create_reservation_page()
    {
        // メールアドレスが検証済みのユーザーを作成
        $user = User::factory()->create([
            'email_verified_at' => now(),
        ]);
        $mock = Mockery::mock(SubscriptionService::class);
        $mock->shouldReceive('isSubscribed')->andReturn(true);    

        $this->app->instance(SubscriptionService::class, $mock);

        $store = Store::factory()->create();

        $response = $this->actingAs($user)->get("/stores/{$store->id}/reservation");

        $response->assertStatus(200);
    }

    public function test_store_reservation()
    {
        $user = User::factory()->create([
            'email_verified_at' => now(),
        ]);
        $store = Store::factory()->create([
            'open_time' => '09:00:00',
            'close_time' => '22:00:00',
        ]);

        $response = $this->actingAs($user)->post("/stores/{$store->id}/reservation", [
            'amount' => 2,
            'reserved_time' => now()->addDay()->setHour(12)->setMinute(0)->toDateTimeString(),
        ]);

        $response->assertRedirect(route('mypage'));
        $this->assertDatabaseHas('reservations', [
            'user_id' => $user->id,
            'store_id' => $store->id,
            'amount' => 2,
        ]);
    }

    public function test_destroy_reservation()
    {
        $user = User::factory()->create([
            'email_verified_at' => now(),
        ]);
        $reservation = Reservation::factory()->create([
            'user_id' => $user->id,
        ]);

        $response = $this->actingAs($user)->delete("/reservation/{$reservation->id}/delete");

        $response->assertRedirect();
        $this->assertDatabaseMissing('reservations', [
            'id' => $reservation->id,
        ]);
    }
}