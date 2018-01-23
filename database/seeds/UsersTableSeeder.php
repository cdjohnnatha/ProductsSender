<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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

        DB::table('users')->insert([
            'type' => 'admin',
            'email' => 'holyship@admin.com',
            'password' => Hash::make('holyship123'),
        ]);

        DB::table('clients')->insert([
            'name' => 'Holyship',
            'surname' => 'ships',
            'identity_document' => '00000000000',
            'tax_document' => '111111',
            'default_address' => 1,
            'user_id' => 1
        ]);

        DB::table('client_phones')->insert([
            'number' => '09999999999',
            'client_id' => 1
        ]);

        DB::table('client_addresses')->insert([
            'label' => 'default',
            'owner_name' => 'Holyship',
            'owner_surname' => 'Holyship',
            'country' => 'BR',
            'street' => 'Rua rita porfirio chaves',
            'street2' => '',
            'city' => 'João Pessoa',
            'state' => 'PB',
            'postal_code' => '58065216',
            'phone' => '8899999999',
            'number' => '95',
            'formatted_address' => 'Rua Rita porfirio chaves, João Pessoa/PB, BR',
            'client_id' => 1,

        ]);
    }

}
