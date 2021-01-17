<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::insert('INSERT INTO rooms (name) VALUES 
            ("user_private_chat"), 
            ("user_private_chat"), 
            ("user_private_chat")
        ');
    }
}
