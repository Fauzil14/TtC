<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        $faker = Faker\Factory::create();
        $password = Hash::make('password');

        DB::table('users')->insert([
            [ 
                'name' => 'Fauzil',
                'role_id' => 1,
                'email' => 'fauzil@gmail.com',
                'email_verified_at' => now(),
                'password' => $password,
                'no_telephone' => $faker->phonenumber,
                'profile_picture' => 'https://via.placeholder.com/150/0000FF/000000?text=User'
            ],
            [ 
                'name' => 'Yamin',
                'role_id' => 1,
                'email' => 'yamin@gmail.com',
                'email_verified_at' => now(),
                'password' => $password,
                'no_telephone' => $faker->phonenumber,
                'profile_picture' => 'https://via.placeholder.com/150/0000FF/000000?text=User'
            ],
            [ 
                'name' => 'Pengurus 1',
                'role_id' => 2,
                'email' => 'pengurus1@gmail.com',
                'email_verified_at' => now(),
                'password' => $password,
                'no_telephone' => $faker->phonenumber,
                'profile_picture' => 'https://via.placeholder.com/150/0000FF/000000?text=User'
            ],
            [ 
                'name' => 'Pengurus 2',
                'role_id' => 3,
                'email' => 'pengurus2@gmail.com',
                'email_verified_at' => now(),
                'password' => $password,
                'no_telephone' => $faker->phonenumber,
                'profile_picture' => 'https://via.placeholder.com/150/0000FF/000000?text=User'
            ],
            [ 
                'name' => 'Bendahara',
                'role_id' => 4,
                'email' => 'bendahara@gmail.com',
                'email_verified_at' => now(),
                'password' => $password,
                'no_telephone' => $faker->phonenumber,
                'profile_picture' => 'https://via.placeholder.com/150/0000FF/000000?text=User'
            ],
            [ 
                'name' => 'Admin',
                'role_id' => 5,
                'email' => 'admin@gmail.com',
                'email_verified_at' => now(),
                'password' => $password,
                'no_telephone' => $faker->phonenumber,
                'profile_picture' => 'https://via.placeholder.com/150/0000FF/000000?text=User'
            ],
        ]);
    }
}
