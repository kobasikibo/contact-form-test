<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Contact;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // カテゴリのシードを実行
        $this->call(CategorySeeder::class);

        // contacts テーブルに 35 件のダミーデータを作成
        Contact::factory()->count(35)->create();
    }
}
