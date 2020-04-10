<?php

use App\Coupon;
use Illuminate\Database\Seeder;

class CouponTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Coupon::create([
            'code'  => 'ABCD',
            'type'  => 'fixed',
            'value' => 30,
        ]);

        Coupon::create([
            'code'  => '1234',
            'type'  => 'percent',
            'value' => 50,
        ]);
    }
}
