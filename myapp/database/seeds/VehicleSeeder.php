<?php

use Illuminate\Database\Seeder;

class VehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = array(
    		array('year' => '2018-01-05', 'make' => 'Suzuki', 'model' => 'Swift Dezire', 'price' =>'20000', 'type_id'=>3, 'seller_id'=>1, 'created_at'=>"2013-01-10", 'updated_at'=>"2013-01-10"),
            array('year' => '2018-01-05', 'make' => 'TATA', 'model' => 'Truck series 1', 'price' =>'30000', 'type_id'=>2, 'seller_id'=>1, 'created_at'=>"2013-01-10", 'updated_at'=>"2013-01-10"),
            array('year' => '2018-01-05', 'make' => 'Pulsar', 'model' => '200 series', 'price' =>'40000', 'type_id'=>1, 'seller_id'=>1, 'created_at'=>"2013-01-10", 'updated_at'=>"2013-01-10"),

            array('year' => '2018-01-05', 'make' => 'BMW', 'model' => 'Series 1', 'price' =>'20000', 'type_id'=>3, 'seller_id'=>2, 'created_at'=>"2013-01-10", 'updated_at'=>"2013-01-10"),
            array('year' => '2018-01-05', 'make' => 'TATA', 'model' => 'Truck series 2', 'price' =>'30000', 'type_id'=>2, 'seller_id'=>2, 'created_at'=>"2013-01-10", 'updated_at'=>"2013-01-10"),
            array('year' => '2018-01-05', 'make' => 'Royal Enfiled', 'model' => '400 series', 'price' =>'40000', 'type_id'=>1, 'seller_id'=>2, 'created_at'=>"2013-01-10", 'updated_at'=>"2013-01-10"),

            array('year' => '2018-01-05', 'make' => 'Suzuki', 'model' => 'Swift Dezire 2', 'price' =>'20000', 'type_id'=>3, 'seller_id'=>3, 'created_at'=>"2013-01-10", 'updated_at'=>"2013-01-10"),
            array('year' => '2018-01-05', 'make' => 'Honda', 'model' => 'i 10', 'price' =>'30000', 'type_id'=>3, 'seller_id'=>3, 'created_at'=>"2013-01-10", 'updated_at'=>"2013-01-10"),
            array('year' => '2018-01-05', 'make' => 'KTM', 'model' => '300 series', 'price' =>'40000', 'type_id'=>1, 'seller_id'=>3, 'created_at'=>"2013-01-10", 'updated_at'=>"2013-01-10"),
    	);

    	foreach ($types as $type) {
    		DB::table('vehicles')->insert([
	            'year' => $type['year'],
                'make' => $type['make'],
                'model' => $type['model'],
                'price' => $type['price'],
                'type_id' => $type['type_id'],
                'seller_id' => $type['seller_id'],
                'created_at' => $type['created_at'],
                'updated_at' => $type['updated_at']
	        ]);
    	}
    }
}
