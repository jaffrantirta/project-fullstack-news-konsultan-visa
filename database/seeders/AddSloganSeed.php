<?php

namespace Database\Seeders;
use App\Models\Setting;

use Illuminate\Database\Seeder;

class AddSloganSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $save = new Setting();
        $save->name = 'slogan';
        $save->content = 'Everyone Can Overseas!';
        $save->save();
    }
}
