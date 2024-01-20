<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Store;
use Carbon\Carbon;

class StoresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Store::where('id', '>', 0)->delete();

        Store::create([
            'name' => '魚民',
            'category_id' => 1,
            'discription' => '魚民は、魚介類を中心とした和食を提供する居酒屋チェーンである。株式会社魚民が運営する。本社は東京都港区にある。',
            'open_time' => '17:00',
            'close_time' => '23:00',
            'price_range' => 3000,
            'postal_code' => '123-4567',
            'address' => '東京都港区',
            'phone_number' => '03-1234-5678',
            'holiday' => '日曜日',
        ]);

        Store::create([
            'name' => '横浜家系ラーメン',
            'category_id' => 4,
            'discription' => '横浜家系ラーメンは、横浜市を中心に展開するラーメン店の呼称である。横浜家系ラーメンは、横浜市を中心に展開するラーメン店の呼称である。',
            'open_time' => '20:00',
            'close_time' => '23:00',
            'price_range' => 4000,
            'postal_code' => '123-4567',
            'address' => '東京都港区',
            'phone_number' => '03-1234-5678',
            'holiday' => '日曜日',
        ]);

        Store::create([
            'name' => '鳥貴族',
            'category_id' => 1,
            'discription' => '鳥貴族は、焼き鳥を中心とした和食を提供する居酒屋チェーンである。株式会社鳥貴族が運営する。本社は東京都港区にある。',
            'open_time' => '17:00',
            'close_time' => '23:00',
            'price_range' => 3000,
            'postal_code' => '123-4567',
            'address' => '東京都港区',
            'phone_number' => '03-1234-5678',
            'holiday' => '日曜日',
        ]);

        Store::create([
            'name' => '餃子の王将',
            'category_id' => 7,
            'discription' => '餃子の王将は、中華料理を提供するチェーン店である。株式会社王将フードサービスが運営する。本社は東京都港区にある。',
            'open_time' => '17:00',
            'close_time' => '23:00',
            'price_range' => 3000,
            'postal_code' => '123-4567',
            'address' => '東京都港区',
            'phone_number' => '03-1234-5678',
            'holiday' => '日曜日',
        ]);

        Store::create([
            'name' => '餃子の満州',
            'category_id' => 7,
            'discription' => '餃子の満州は、中華料理を提供するチェーン店である。株式会社満州飯店が運営する。本社は東京都港区にある。',
            'open_time' => '17:00',
            'close_time' => '23:00',
            'price_range' => 3000,
            'postal_code' => '123-4567',
            'address' => '東京都港区',
            'phone_number' => '03-1234-5678',
            'holiday' => '日曜日',
        ]);

        Store::create([
            'name' => 'スターバックス',
            'category_id' => 8,
            'discription' => 'スターバックスは、アメリカ合衆国ワシントン州シアトルに本社を置くコーヒー店チェーンである。日本法人はスターバックス コーヒー ジャパン株式会社で、本社は東京都港区にある。',
            'open_time' => '17:00',
            'close_time' => '23:00',
            'price_range' => 3000,
            'postal_code' => '123-4567',
            'address' => '東京都港区',
            'phone_number' => '03-1234-5678',
            'holiday' => '日曜日',
        ]);
        
    }
}
