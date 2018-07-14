<?php

use Illuminate\Database\Seeder;

class SellerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = array(
    		array('name' => 'Rupa', 'email' => 'rupa.das@dreamorbit.com', 'phone' => '123456789', 'seller_type_id' => 1,'created_at'=>"2013-01-10", 'updated_at'=>"2013-01-10"),
            array('name' => 'Aditya', 'email' => 'aditya@dreamorbit.com', 'phone' => '123456788', 'seller_type_id' => 1,'created_at'=>"2013-01-10", 'updated_at'=>"2013-01-10"),
            array('name' => 'Anurag', 'email' => 'anurag@dreamorbit.com', 'phone' => '123456787', 'seller_type_id' => 2, 'created_at'=>"2013-01-10", 'updated_at'=>"2013-01-10"),
            array('name' => 'Vipin', 'email' => 'vipin@dreamorbit.com', 'phone' => '123456786', 'seller_type_id' => 2,'created_at'=>"2013-01-10", 'updated_at'=>"2013-01-10"),
    	);

    	foreach ($types as $type) {
    		DB::table('sellers')->insert([
	            'name' => $type['name'],
                'email' => $type['email'],
                'phone' => $type['phone'],
                'seller_type_id' => $type['seller_type_id'],
                'created_at' => $type['created_at'],
                'updated_at' => $type['updated_at']
	        ]);
    	}
    }
}
