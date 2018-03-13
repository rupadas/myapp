<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(TypeSeeder::class);
        $this->call(SellerSeeder::class);
        $this->call(VehicleSeeder::class);
        $this->call(ReviewSeeder::class);
    }
}
