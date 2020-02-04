<?php

use Illuminate\Database\Seeder;

class EventTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::table('events')->insert([
            [
                'title'=> 'Reunião',
                'start'=>'2020-02-02 12:00:00',
                'end'=>'2020-02-02 14:00:00',
                'color'=>'#c40233',
                'description' => 'Reunião com o cliente'
            ],
            [
                'title'=> 'Ligar p/ cliente',
                'start'=>'2020-02-02 ',
                'end'=>'2020-02-02 ',
                'color'=>'#c40233',
                'description' => 'falar com cliente',
            ]
        ]);
    }
}
