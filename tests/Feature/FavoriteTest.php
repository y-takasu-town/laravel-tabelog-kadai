<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Store;
use App\Models\Favorite;

class FavoriteTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_favorite_a_store()
    {
        $user = User::factory()->create();
        $store = Store::factory()->create();

        $response = $this->actingAs($user)->post(route('stores.favorite', ['store' => $store->id]));

        $response->assertRedirect();
        $response->assertSessionHas('success', 'お気に入り登録しました');
        
        $this->assertDatabaseHas('favorites', [
            'user_id' => $user->id,
            'store_id' => $store->id,
        ]);
    }

    // データが存在する場合は、データを削除する
    public function test_user_can_unfavorite_a_store()
    {
        $user = User::factory()->create();
        $store = Store::factory()->create();
        $favorite = Favorite::factory()->create([
            'user_id' => $user->id,
            'store_id' => $store->id,
        ]);

        $response = $this->actingAs($user)->post(route('stores.favorite', ['store' => $store->id]));

        $response->assertRedirect();
        $response->assertSessionHas('success', 'お気に入り登録を解除しました');
        $this->assertDatabaseMissing('favorites', [
            'user_id' => $user->id,
            'store_id' => $store->id,
        ]);
    }

    public function test_guest_cannot_favorite_a_store()
    {
        $store = Store::factory()->create();

        $response = $this->post(route('stores.favorite', ['store' => $store->id]));

        $response->assertRedirect('/login');
    }
}
