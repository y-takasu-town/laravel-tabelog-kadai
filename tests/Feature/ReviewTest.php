<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Store;
use App\Models\Review;

class ReviewTest extends TestCase
{
    /**
     * レビュー投稿に成功することをテスト
     *
     * @return void
     */
    public function test_review_store_success()
    {
        $user = User::factory()->create();
        $store = Store::factory()->create();
        $reviewData = [
            'comment' => 'Great place!',
            'star' => 5,
            'store_id' => $store->id,
        ];

        $response = $this->actingAs($user)->post('/reviews', $reviewData);

        $response->assertStatus(302);
    }

    /**
     * リクエスト内の comment が空の場合、バリデーションエラーになることをテスト
     *
     * @return void
     */
    public function test_review_store_validation_error()
    {
        $user = User::factory()->create();
        $store = Store::factory()->create();
        $reviewData = [
            'comment' => null,
            'star' => 5,
            'store_id' => $store->id,
        ];

        $response = $this->actingAs($user)->post('/reviews', $reviewData);

        $response->assertSessionHasErrors(['comment']);
    }
}
