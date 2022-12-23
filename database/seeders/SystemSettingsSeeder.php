<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SystemSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $save = new Setting();
        $save->name = 'corporate_name';
        $save->content = 'PT Ngantre Indonesia Persada';
        $save->save();

        $save = new Setting();
        $save->name = 'system_name';
        $save->content = 'Ngantre';
        $save->save();
    }
}
