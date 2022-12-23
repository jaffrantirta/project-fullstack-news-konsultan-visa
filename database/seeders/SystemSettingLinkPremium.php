<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SystemSettingLinkPremium extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $save = new Setting();
        $save->name = 'link_premium_user';
        $save->content = 'https://ngantre.com';
        $save->save();

        $save = new Setting();
        $save->name = 'link_free_user';
        $save->content = 'https://jagoanqr.com';
        $save->save();
    }
}
