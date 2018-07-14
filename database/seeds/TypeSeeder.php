<?php

use Illuminate\Database\Seeder;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = array(
    		array('name' => 'MotorCycle','created_at'=>"2013-01-10", 'updated_at'=>"2013-01-10"),
            array('name' => 'Truck','created_at'=>"2013-01-10", 'updated_at'=>"2013-01-10"),
            array('name' => 'Car','created_at'=>"2013-01-10", 'updated_at'=>"2013-01-10"),
            array('name' => 'RV','created_at'=>"2013-01-10", 'updated_at'=>"2013-01-10"),
    	);

    	foreach ($types as $type) {
    		DB::table('types')->insert([
	            'name' => $type['name'],
                'created_at' => $type['created_at'],
                'updated_at' => $type['updated_at']
	        ]);
    	}

    	$types1 = array(
    		array('name' => 'Dealer', 'created_at'=>"2013-01-10", 'updated_at'=>"2013-01-10"),
            array('name' => 'Broker', 'created_at'=>"2013-01-10", 'updated_at'=>"2013-01-10"),
            array('name' => 'Private Party','created_at'=>"2013-01-10", 'updated_at'=>"2013-01-10")
    	);

    	foreach ($types1 as $type) {
    		DB::table('seller_type')->insert([
	            'name' => $type['name'],
                'created_at' => $type['created_at'],
                'updated_at' => $type['updated_at']
	        ]);
    	}
    }
}
