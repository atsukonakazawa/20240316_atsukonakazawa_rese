<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReservationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'user_id' => '1',
            'shop_id' => '1',
            'rese_date' => '2024-07-01',
            'rese_time' => '11:00:00',
            'rese_people' => '1',
        ];
        DB::table('reservations')->insert($param);

        $param = [
            'user_id' => '1',
            'shop_id' => '5',
            'rese_date' => '2024-08-01',
            'rese_time' => '15:00:00',
            'rese_people' => '1',
        ];
        DB::table('reservations')->insert($param);

        $param = [
            'user_id' => '2',
            'shop_id' => '2',
            'rese_date' => '2024-07-02',
            'rese_time' => '12:00:00',
            'rese_people' => '2',
        ];
        DB::table('reservations')->insert($param);

        $param = [
            'user_id' => '2',
            'shop_id' => '6',
            'rese_date' => '2024-08-02',
            'rese_time' => '16:00:00',
            'rese_people' => '2',
        ];
        DB::table('reservations')->insert($param);

        $param = [
            'user_id' => '3',
            'shop_id' => '3',
            'rese_date' => '2024-07-03',
            'rese_time' => '13:00:00',
            'rese_people' => '3',
        ];
        DB::table('reservations')->insert($param);

        $param = [
            'user_id' => '3',
            'shop_id' => '7',
            'rese_date' => '2024-08-03',
            'rese_time' => '17:00:00',
            'rese_people' => '3',
        ];
        DB::table('reservations')->insert($param);

        $param = [
            'user_id' => '1',
            'shop_id' => '11',
            'rese_date' => '2024-11-01',
            'rese_time' => '11:00:00',
            'rese_people' => '1',
        ];
        DB::table('reservations')->insert($param);

        $param = [
            'user_id' => '2',
            'shop_id' => '12',
            'rese_date' => '2024-12-01',
            'rese_time' => '12:00:00',
            'rese_people' => '2',
        ];
        DB::table('reservations')->insert($param);

        $param = [
            'user_id' => '3',
            'shop_id' => '13',
            'rese_date' => '2025-01-01',
            'rese_time' => '13:00:00',
            'rese_people' => '3',
        ];
        DB::table('reservations')->insert($param);

    }
}
