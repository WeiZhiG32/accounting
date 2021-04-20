<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class money_record_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //測試資料
        $pay_name = array('水餃之家','辣媽','麵王'); 
        $money_amount = array('80','160','210'); 
        $record_date = array('2021-03-26','2021-03-27','2021-03-28');
        for ($i=0; $i < count($pay_name); $i++) { 
            DB::table('money_record')->insert([
                'pay_name' => $pay_name[$i],
                'money_amount' => $money_amount[$i],
                'record_date' => $record_date[$i],
                'created_at' => Carbon::now(),
                // 'created_at' => Carbon::now()->subMinutes(rand(1, 55)),//隨機產生時間
            ]);
        }
    }
}
