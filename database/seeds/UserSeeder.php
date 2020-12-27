<?php

use App\Role;
use App\User;
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

        $nasabahRole = Role::where('role_name', 'nasabah')->first();
        $pengurus_1Role = Role::where('role_name', 'pengurus_1')->first();
        $pengurus_2Role = Role::where('role_name', 'pengurus_2')->first();
        $bendaharaRole = Role::where('role_name', 'bendahara')->first();
        $adminRole = Role::where('role_name', 'admin')->first();
        
        $nasabah1 = User::create([ 
                'name' => 'Fauzil',
                'email' => 'fauzil@gmail.com',
                'email_verified_at' => now(),
                'password' => $password,
                'no_telephone' => $faker->phonenumber,
                'profile_picture' => 'https://via.placeholder.com/150/0000FF/000000?text=User'
            ]);

        $nasabah2 = User::create([ 
                'name' => 'Yamin',
                'email' => 'yamin@gmail.com',
                'email_verified_at' => now(),
                'password' => $password,
                'no_telephone' => $faker->phonenumber,
                'profile_picture' => 'https://via.placeholder.com/150/0000FF/000000?text=User'
            ]);

        $pengurus_1 = User::create([ 
                'name' => 'Pengurus 1',
                'email' => 'pengurus1@gmail.com',
                'email_verified_at' => now(),
                'password' => $password,
                'no_telephone' => $faker->phonenumber,
                'profile_picture' => 'https://via.placeholder.com/150/0000FF/000000?text=User'
            ]);

        $pengurus_2 = User::create([ 
                'name' => 'Pengurus 2',
                'email' => 'pengurus2@gmail.com',
                'email_verified_at' => now(),
                'password' => $password,
                'no_telephone' => $faker->phonenumber,
                'profile_picture' => 'https://via.placeholder.com/150/0000FF/000000?text=User'
            ]);

        $bendahara = User::create([ 
                'name' => 'Bendahara',
                'email' => 'bendahara@gmail.com',
                'email_verified_at' => now(),
                'password' => $password,
                'no_telephone' => $faker->phonenumber,
                'profile_picture' => 'https://via.placeholder.com/150/0000FF/000000?text=User'
            ]);

        $admin = User::create([ 
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'email_verified_at' => now(),
                'password' => $password,
                'no_telephone' => $faker->phonenumber,
                'profile_picture' => 'https://via.placeholder.com/150/0000FF/000000?text=User'
        ]);

        $nasabah1->roles()->attach($nasabahRole);
        $nasabah2->roles()->attach($nasabahRole);
        $pengurus_1->roles()->attach($pengurus_1Role);
        $pengurus_2->roles()->attach($pengurus_2Role);
        $bendahara->roles()->attach($bendaharaRole);
        $admin->roles()->attach($adminRole);
    }
}
