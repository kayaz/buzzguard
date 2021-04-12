<?php

use Illuminate\Database\Seeder;

class BuildingPropertySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 20; $i++)
        {
            DB::table('properties')->insert([
                'investment_id' => 1,
                'building_id' => 3,
                'floor_id' => rand(18, 19),
                'name' => 'Mieszkanie '.rand(3, 10),
                'rooms' => rand(1, 3),
                'area' => rand(10, 50),
                'type' => 0,
                'status' => rand(1, 4)
            ]);
        }
    }
}
