<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('addresses')->insert([
            'label' => 'Principal',
            'owner_name' => 'Holyship',
            'owner_surname' => 'Testing',
            'company_name' => 'Holyship',
            'country' => 'Brasil',
            'address' => 'Avenida Epitacio Pessoa, sem nº',
            'city' => 'João Pessoa',
            'state' => 'PB',
            'postal_code' => '58000',
            'phone' => '08003330800',
            'addressable_id' => 1,
            'addressable_type' => 'warehouse',
            'default_address' => true
        ]);


        DB::table('addresses')->insert([
            'label' => 'Principal',
            'owner_name' => 'Holyship',
            'owner_surname' => 'Testing',
            'company_name' => 'Holyship',
            'country' => 'Brasil',
            'address' => 'Avenida Epitacio Pessoa, sem nº',
            'city' => 'João Pessoa',
            'state' => 'PB',
            'postal_code' => '58000',
            'phone' => '08003330800',
            'addressable_id' => 1,
            'addressable_type' => 'user',
            'default_address' => true
        ]);

        DB::table('addresses')->insert([
            'label' => 'Principal',
            'owner_name' => 'Holyship',
            'owner_surname' => 'Testing',
            'company_name' => 'Holyship',
            'country' => 'Brasil',
            'address' => 'Avenida Epitacio Pessoa, sem nº',
            'city' => 'João Pessoa',
            'state' => 'PB',
            'postal_code' => '58000',
            'phone' => '08003330800',
            'addressable_id' => 1,
            'addressable_type' => 'admin',
            'default_address' => true
        ]);


        //Subscriptions
        DB::table('subscriptions')->insert([
            'title' => 'Free',
            'amount' => 0.0
        ]);

        DB::table('subscriptions')->insert([
            'title' => 'Medium',
            'amount' => 10.00
        ]);

        DB::table('subscriptions')->insert([
            'title' => 'Pro',
            'amount' => 20.00
        ]);

        //Benefits
        DB::table('benefits')->insert([
            'message' => 'Primeiras 10 caixas gratuitas',
            'subscription_id' => 1
        ]);

        DB::table('benefits')->insert([
            'message' => 'Fotos das caixas.',
            'subscription_id' => 1
        ]);

        DB::table('benefits')->insert([
            'message' => 'Seu próprio endereço nos EUA',
            'subscription_id' => 1
        ]);

        DB::table('benefits')->insert([
            'message' => 'Seu próprio endereço nos EUA',
            'subscription_id' => 2
        ]);

        DB::table('benefits')->insert([
            'message' => '3 fotos gratuitas de cada pacote',
            'subscription_id' => 2
        ]);

        DB::table('benefits')->insert([
            'message' => 'Economize até 80% em fretes',
            'subscription_id' => 2
        ]);


        DB::table('benefits')->insert([
            'message' => '180 dias gratuitos',
            'subscription_id' => 3
        ]);

        DB::table('benefits')->insert([
            'message' => 'Taxa grátis para o armazém EUA',
            'subscription_id' => 3
        ]);

        DB::table('benefits')->insert([
            'message' => 'Envios de vários pacotes',
            'subscription_id' => 3
        ]);



    }
}
