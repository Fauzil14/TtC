<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ParticipantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::insert('INSERT INTO participants (room_id, user_id) VALUES  
            (1, 1), 
            (1, 3), 
            (2, 1), 
            (2, 4), 
            (3, 1), 
            (3, 5)
        ');
        

    }
}
