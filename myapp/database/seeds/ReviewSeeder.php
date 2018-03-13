<?php

use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = array(
    		array('comment' => 'Good', 'vehicle_id'=>1, 'seller_id'=>1, 'created_at'=>"2013-01-10", 'updated_at'=>"2013-01-10" ),
            array('comment' => 'Bad', 'vehicle_id'=>2, 'seller_id'=>1, 'created_at'=>"2013-01-10", 'updated_at'=>"2013-01-10" ),
            array('comment' => 'Good', 'vehicle_id'=>3, 'seller_id'=>1, 'created_at'=>"2013-01-10", 'updated_at'=>"2013-01-10" ),
            array('comment' => 'Bad', 'vehicle_id'=>4, 'seller_id'=>1, 'created_at'=>"2013-01-10", 'updated_at'=>"2013-01-10" ),
    	);

    	foreach ($types as $type) {
    		DB::table('reviews')->insert([
	            'comment' => $type['comment'],
                'vehicle_id' => $type['vehicle_id'],
                'seller_id' => $type['seller_id'],
                'created_at' => $type['created_at'],
                'updated_at' => $type['updated_at']
	        ]);
    	}


        //Image Sedder
        $types1 = array(
            array('path' => 'https://fopcontainer.blob.core.windows.net/dev/test.jpg', 'name'=>'test.jpg',  'created_at'=>"2013-01-10", 'updated_at'=>"2013-01-10" ),
            array('path' => 'https://fopcontainer.blob.core.windows.net/dev/test2.jpg', 'name'=>'test2.jpg',  'created_at'=>"2013-01-10", 'updated_at'=>"2013-01-10" ),
            array('path' => 'https://fopcontainer.blob.core.windows.net/dev/test3.png', 'name'=>'tes3.jpg',  'created_at'=>"2013-01-10", 'updated_at'=>"2013-01-10" ),
            array('path' => 'https://fopcontainer.blob.core.windows.net/dev/test1.jpg', 'name'=>'test1.jpg',  'created_at'=>"2013-01-10", 'updated_at'=>"2013-01-10" ),
        );

        foreach ($types1 as $type) {
            DB::table('images')->insert([
                'path' => $type['path'],
                'name' => $type['name'],
                'created_at' => $type['created_at'],
                'updated_at' => $type['updated_at']
            ]);
        }

        //Vehicle Image Sedder
        $types2 = array(
            array('image_id' =>2, 'vehicle_id'=>1),
            array('image_id' =>1, 'vehicle_id'=>1),
            array('image_id' =>3, 'vehicle_id'=>1),
            array('image_id' =>2, 'vehicle_id'=>2),
            array('image_id' =>1, 'vehicle_id'=>2),
            array('image_id' =>4, 'vehicle_id'=>2),
            array('image_id' =>2, 'vehicle_id'=>3),
            array('image_id' =>1, 'vehicle_id'=>3),
            array('image_id' =>4, 'vehicle_id'=>3),
        );

        foreach ($types2 as $type) {
            DB::table('image_vehicle')->insert([
                'image_id' => $type['image_id'],
                'vehicle_id' => $type['vehicle_id'],
            ]);
        }
    }
}
