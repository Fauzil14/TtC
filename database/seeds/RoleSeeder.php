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
            [ 'role_name' => 'pengurus-1' ],
            [ 'role_name' => 'pengurus-2' ],
            [ 'role_name' => 'bendahara' ],
            [ 'role_name' => 'admin' ]
        ]);
    }
}
