<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $now = Carbon::now();

        DB::table('messages')->insert([
            [ 
                'room_id' => 1, 
                'from_id' => 1, 
                'message' => "hey pengurus 1",
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [ 
                'room_id' => 1, 
                'from_id' => 3, 
                'message' => "hey fauzil",
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [ 
                'room_id' => 1, 
                'from_id' => 3, 
                'message' => "saya akan menjemput request anda",
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [ 
                'room_id' => 1, 
                'from_id' => 1, 
                'message' => "ok saya tunggu kedatanganya",
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [ 
                'room_id' => 1, 
                'from_id' => 1, 
                'message' => "hey pengurus 1",
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }
}
