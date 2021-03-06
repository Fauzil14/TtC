<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([ 
                        RoleSeeder::class,
                        UserSeeder::class,
                        PengepulSeeder::class,
                        GolonganSampahSeeder::class,
                        SampahSeeder::class,
                        GudangSeeder::class,
                        // RoomSeeder::class,
                        // ParticipantSeeder::class,
                        // MessageSeeder::class,
                    ]);
    }
}
