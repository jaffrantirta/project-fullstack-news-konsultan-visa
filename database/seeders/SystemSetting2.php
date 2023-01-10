<?php

namespace Database\Seeders;
use App\Models\Setting;

use Illuminate\Database\Seeder;

class SystemSetting2 extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $save = new Setting();
        $save->name = 'limit_toilet_free_user';
        $save->content = '1';
        $save->save();

        $save = new Setting();
        $save->name = 'slogan';
        $save->content = 'Everyone Can Overseas!';
        $save->save();
    }
}
