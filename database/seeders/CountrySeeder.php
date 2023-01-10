<?php

namespace Database\Seeders;

use App\Models\Country;
use App\Models\Service;
use App\Models\Position;
use App\Models\CountryPosition;
use App\Models\CountryService;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //add countries
        $save = new Country();
        $save->name = 'USA';
        $save->save();
        $usa = $save->id;

        $save = new Country();
        $save->name = 'Middle East';
        $save->save();
        $me = $save->id;

        $save = new Country();
        $save->name = 'Australia';
        $save->save();
        $au = $save->id;

        $save = new Country();
        $save->name = 'Canada';
        $save->note = 'Currently the possible way to get into this country is by continuing your education';
        $save->save();
        $ca = $save->id;

        $save = new Country();
        $save->name = 'Switzerland';
        $save->note = 'Currently the possible way to get into this country is by continuing your education';
        $save->save();
        $sw = $save->id;


        //add servoices
        $save = new Service();
        $save->name = 'Internship/Training Program';
        $save->isContinues = true;
        $save->save();
        $intern = $save->id;

        $save = new Service();
        $save->name = 'Study';
        $save->save();
        $study = $save->id;


        //add country services

        //usa
        $save = new CountryService();
        $save->country_id = $usa;
        $save->service_id = $intern;
        $save->save();

        $save = new CountryService();
        $save->country_id = $usa;
        $save->service_id = $study;
        $save->save();

        //middle east
        $save = new CountryService();
        $save->country_id = $me;
        $save->service_id = $intern;
        $save->save();

        $save = new CountryService();
        $save->country_id = $me;
        $save->service_id = $study;
        $save->save();

        //aussie
        $save = new CountryService();
        $save->country_id = $au;
        $save->service_id = $intern;
        $save->save();

        $save = new CountryService();
        $save->country_id = $au;
        $save->service_id = $study;
        $save->save();

        //canada
        $save = new CountryService();
        $save->country_id = $ca;
        $save->service_id = $study;
        $save->save();

        //switzerland
        $save = new CountryService();
        $save->country_id = $sw;
        $save->service_id = $study;
        $save->save();


        //add positions
        $save = new Position();
        $save->name = 'Front Office (Room Division) / Housekeeping';
        $save->save();
        $hk = $save->id;

        $save = new Position();
        $save->name = 'F&B Service';
        $save->save();
        $fbs = $save->id;

        $save = new Position();
        $save->name = 'F&B Product';
        $save->save();
        $fbp = $save->id;

        $save = new Position();
        $save->name = 'IT/Mechanical';
        $save->save();
        $it = $save->id;

        $save = new Position();
        $save->name = 'Law';
        $save->save();
        $law = $save->id;

        $save = new Position();
        $save->name = 'Management';
        $save->save();
        $man = $save->id;

        //country positions

        //usa
        $save = new CountryPosition();
        $save->country_id = $usa;
        $save->position_id = $hk;
        $save->save();

        $save = new CountryPosition();
        $save->country_id = $usa;
        $save->position_id = $fbs;
        $save->save();

        $save = new CountryPosition();
        $save->country_id = $usa;
        $save->position_id = $fbp;
        $save->save();

        $save = new CountryPosition();
        $save->country_id = $usa;
        $save->position_id = $it;
        $save->save();

        $save = new CountryPosition();
        $save->country_id = $usa;
        $save->position_id = $law;
        $save->save();

        $save = new CountryPosition();
        $save->country_id = $usa;
        $save->position_id = $man;
        $save->save();

        //aussie
        $save = new CountryPosition();
        $save->country_id = $au;
        $save->position_id = $hk;
        $save->save();

        $save = new CountryPosition();
        $save->country_id = $au;
        $save->position_id = $fbs;
        $save->save();

        $save = new CountryPosition();
        $save->country_id = $au;
        $save->position_id = $fbp;
        $save->save();

        $save = new CountryPosition();
        $save->country_id = $au;
        $save->position_id = $it;
        $save->save();

        $save = new CountryPosition();
        $save->country_id = $au;
        $save->position_id = $law;
        $save->save();

        $save = new CountryPosition();
        $save->country_id = $au;
        $save->position_id = $man;
        $save->save();

        //middle east
        $save = new CountryPosition();
        $save->country_id = $me;
        $save->position_id = $hk;
        $save->save();

        $save = new CountryPosition();
        $save->country_id = $me;
        $save->position_id = $fbs;
        $save->save();

        $save = new CountryPosition();
        $save->country_id = $me;
        $save->position_id = $fbp;
        $save->save();

        $save = new CountryPosition();
        $save->country_id = $me;
        $save->position_id = $man;
        $save->save();


    }
}
