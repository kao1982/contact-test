<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //  指定された5つのカテゴリーを登録します
        $categories = [
            ['content' => '商品のお届けについて'],
            ['content' => '商品の交換について'],
            ['content' => '商品トラブル'],
            ['content' => 'ショップへのお問い合わせ'],
            ['content' => 'その他'],
        ];

        foreach ($categories as $category) {
            DB::table('categories')->insert([
                'content' => $category['content'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}