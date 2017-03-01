<?php

use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
            	'name' =>  'Category_First'
            ],
            [
            	'name' =>  'Category_Second'
            ],
            [
            	'name' =>  'Category_Third',
            ],
        ];
        DB::table('categories')->insert($categories);
    }
}
