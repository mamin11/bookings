<?php

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i < 100; $i++) { 
            DB::table('products')->insert([
                'name' => Str::random(10),
                'description' => Str::random(20),
                'price' => rand(10, 100),
                'material_id' => rand(1, 7),
                'size_id' => rand(1, 6),
                'category_id' => rand(1, 5),
                'quantity' => rand(1, 20),
                'created_at' => '2021-03-12 20:30:45',
                'updated_at' => '2021-03-12 20:30:45'
            ]);
        }
    }
}
