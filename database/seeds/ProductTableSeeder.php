<?php

use App\Category;
use App\Product;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');

        for ($i = 1; $i < 30; $i++) {
            Product::create([
                'name'  => "Laptop " . $i,
                'slug'  => "laptop-" . $i,
                'details' => [13, 14, 15][array_rand([13, 14, 15])] . 'inch' . [1, 2, 3][array_rand([1, 2, 3])] . 'TB SSD, 326 RAM',
                'price' => rand(149999, 249999),
                'description' => $faker->text(1000),
                'image' => 'products/April2020/laptop-' . $i . '.jpg'
            ])->categories()->attach(1);
        }

        for ($i = 1; $i < 10; $i++) {
            Product::create([
                'name'  => "Desktop " . $i,
                'slug'  => "desktop-" . $i,
                'details' => [13, 14, 15][array_rand([13, 14, 15])] . 'inch' . [1, 2, 3][array_rand([1, 2, 3])] . 'TB SSD, 326 RAM',
                'price' => rand(149999, 249999),
                'description' => $faker->text(1000),
                'image' => 'products/April2020/desktop-' . $i . '.jpg'
            ])->categories()->attach(2);
        }

        for ($i = 1; $i < 10; $i++) {
            Product::create([
                'name'  => "Mobile Phones " . $i,
                'slug'  => "phone-" . $i,
                'details' => [13, 14, 15][array_rand([13, 14, 15])] . 'inch' . [1, 2, 3][array_rand([1, 2, 3])] . 'TB SSD, 326 RAM',
                'price' => rand(149999, 249999),
                'description' => $faker->text(1000),
                'image' => 'products/April2020/phone-' . $i . '.jpg'
            ])->categories()->attach(3);
        }

        for ($i = 1; $i < 10; $i++) {
            Product::create([
                'name'  => "Tvs " . $i,
                'slug'  => "tv-" . $i,
                'details' => [13, 14, 15][array_rand([13, 14, 15])] . 'inch' . [1, 2, 3][array_rand([1, 2, 3])] . 'TB SSD, 326 RAM',
                'price' => rand(149999, 249999),
                'description' => $faker->text(1000),
                'image' => 'products/April2020/tv-' . $i . '.jpg'
            ])->categories()->attach(4);
        }

        for ($i = 1; $i < 10; $i++) {
            Product::create([
                'name'  => "Digital Cameras  " . $i,
                'slug'  => "camera-" . $i,
                'details' => [13, 14, 15][array_rand([13, 14, 15])] . 'inch' . [1, 2, 3][array_rand([1, 2, 3])] . 'TB SSD, 326 RAM',
                'price' => rand(149999, 249999),
                'description' => $faker->text(1000),
                'image' => 'products/April2020/camera-' . $i . '.jpg'
            ])->categories()->attach(5);
        }

        for ($i = 1; $i < 10; $i++) {
            Product::create([
                'name'  => "Appliances  " . $i,
                'slug'  => "appliance-" . $i,
                'details' => [13, 14, 15][array_rand([13, 14, 15])] . 'inch' . [1, 2, 3][array_rand([1, 2, 3])] . 'TB SSD, 326 RAM',
                'price' => rand(149999, 249999),
                'description' => $faker->text(1000),
                'image' => 'products/April2020/appliance-' . $i . '.jpg'
            ])->categories()->attach(6);
        }
    }
}
