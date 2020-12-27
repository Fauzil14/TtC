<?php

use App\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            [ 'role_name' => 'nasabah' ],
            [ 'role_name' => 'pengurus satu' ],
            [ 'role_name' => 'pengurus dua' ],
            [ 'role_name' => 'bendahara' ],
            [ 'role_name' => 'admin' ]
        ]);
    }
}
