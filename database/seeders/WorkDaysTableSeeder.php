<?php

namespace Database\Seeders;

use App\Models\WorkDay;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WorkDaysTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i=0;$i<7;++$i){
            WorkDay::create(
                [
         'day'=>$i,
        'active'=>($i==4),
        'morning_start'=>($i==4 ? '07:00:00' :'05:00:00'),
        'morning_end'=>($i==4 ? '' :'09:30:00'),
        'afternoon_start'=>($i==4 ? '15:00:00' :'13:00:00'),
        'afternoon_end'=>($i==4 ? '18:00:00' :'13:00:00'),
        'user_id'=>2,

                ]
                );
        }
    }
}
