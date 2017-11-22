<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('users')->insert([
            'type' => 'user',
            'email' => 'holyship@user.com',
            'password' => Hash::make('holyship123')
        ]);

//        DB::table('addresses')->insert([
//            'label' => 'Address of EUA',
//            'owner_name' => 'holyship',
//            'owner_surname' => 'holyship',
//            'company_name' => 'holyship',
//            'country' => 'BR',
//            'street' => 'Rua abelardo da silva guimarães barreto',
//            'city' => 'João Pessoa',
//            'state' => 'Paraiba',
//            'postal_code' => '58046110',
//            'phone' => '+5583999999999',
//            'addressable_id' => 1,
//            'addressable_type' => 'App\User',
//            'number' => 400,
//            'formatted_address' => 'Rua abelardo da silva guimarães barreto, 400, João Pessoa, Paraiba'
//        ]);
//        factory(App\User::class, 10)->create();
    }
}
