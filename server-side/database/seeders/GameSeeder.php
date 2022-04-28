<?php

namespace Database\Seeders;

use App\Models\Game;
use Illuminate\Database\Seeder;

class GameSeeder extends Seeder
{
    public function run()
    {
        Game::insert([
            [
                'id'   => 8,
                'name' => '168幸运飞艇',
            ],
            [
                'id'   => 22,
                'name' => '台湾宾果',
            ],
            [
                'id'   => 24,
                'name' => '腾讯分分彩',
            ],
            [
                'id'   => 25,
                'name' => '168极速赛车',
            ],
            [
                'id'   => 26,
                'name' => '168极速飞艇',
            ],
            [
                'id'   => 27,
                'name' => '168极速时时彩',
            ],
            [
                'id'   => 37,
                'name' => '台湾赛车A区',
            ],
            [
                'id'   => 38,
                'name' => '台湾赛车B区',
            ],
            [
                'id'   => 201,
                'name' => '极速赛车',
            ],
            [
                'id'   => 202,
                'name' => '极速飞艇',
            ],
            [
                'id'   => 203,
                'name' => '皇家赛马',
            ],
            [
                'id'   => 204,
                'name' => '幸运赛车',
            ],
            [
                'id'   => 301,
                'name' => '极速时时彩',
            ],
            [
                'id'   => 302,
                'name' => '幸运夺金',
            ],
            [
                'id'   => 304,
                'name' => '幸运时时彩',
            ],
            [
                'id'   => 501,
                'name' => '极速快乐8',
            ],
            [
                'id'   => 702,
                'name' => '幸运快3',
            ],
        ]);
    }
}
