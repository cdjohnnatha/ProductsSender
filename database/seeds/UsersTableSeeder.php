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
            'name' => 'Holyship',
            'surname' => 'User',
            'email' => 'holyship@user.com',
            'phone' => '08000800',
            'password' => Hash::make('holyship123'),
            'subscription_id' => 1,
            'rg' => '0000000',
            'cpf' => '00000000000',
            'default_address' => 1
        ]);

        DB::table('addresses')->insert([
            'label' => 'Address of EUA',
            'owner_name' => 'holyship',
            'owner_surname' => 'holyship',
            'company_name' => 'holyship',
            'country' => 'BR',
            'street' => 'Rua abelardo da silva guimarães barreto',
            'city' => 'João Pessoa',
            'state' => 'Paraiba',
            'postal_code' => '58046110',
            'phone' => '+5583999999999',
            'addressable_id' => 1,
            'addressable_type' => 'App\User',
            'number' => 400,
            'formatted_address' => 'Rua abelardo da silva guimarães barreto, 400, João Pessoa, Paraiba'
        ]);
//        factory(App\User::class, 10)->create();
    }
}
