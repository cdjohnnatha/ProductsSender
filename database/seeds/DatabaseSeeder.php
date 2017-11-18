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
            'street' => 'Avenida Epitacio Pessoa, sem nº',
            'street2' => null,
            'city' => 'João Pessoa',
            'state' => 'PB',
            'postal_code' => '58000',
            'phone' => '08003330800',
            'addressable_id' => 1,
            'addressable_type' => 'App\CompanyWarehouse',
            'number' => 400,
            'formatted_address' => 'Avenida Epitacio Pessoa, sem nº, João Pessoa, Paraiba'
        ]);


        DB::table('addresses')->insert([
            'label' => 'Principal',
            'owner_name' => 'Holyship',
            'owner_surname' => 'Testing',
            'company_name' => 'Holyship',
            'country' => 'Brasil',
            'street' => 'Avenida Epitacio Pessoa, sem nº',
            'street2' => null,
            'city' => 'João Pessoa',
            'state' => 'PB',
            'postal_code' => '58000',
            'phone' => '08003330800',
            'addressable_id' => 1,
            'addressable_type' => 'App\User',
            'number' => 400,
            'formatted_address' => 'Avenida Epitacio Pessoa, sem nº, João Pessoa, Paraiba'
        ]);

        DB::table('addresses')->insert([
            'label' => 'Principal',
            'owner_name' => 'Holyship',
            'owner_surname' => 'Testing',
            'company_name' => 'Holyship',
            'country' => 'Brasil',
            'street' => 'Avenida Epitacio Pessoa, sem nº',
            'street2' => null,
            'city' => 'João Pessoa',
            'state' => 'PB',
            'postal_code' => '58000',
            'phone' => '08003330800',
            'addressable_id' => 1,
            'addressable_type' => 'App\Admin',
            'number' => 400,
            'formatted_address' => 'Avenida Epitacio Pessoa, sem nº, João Pessoa, Paraiba'
        ]);


        //Subscriptions
        DB::table('subscriptions')->insert([
            'title' => 'Free',
            'amount' => 0.0,
            'active' => true,
            'principal' => true,
            'period' => 1,
            'discounts' => 10.0,
            'slots' => 5
        ]);

        DB::table('subscriptions')->insert([
            'title' => 'Medium',
            'amount' => 10.00,
            'active' => true,
            'principal' => true,
            'period' => 1,
            'discounts' => 10.0,
            'slots' => 5
        ]);

        DB::table('subscriptions')->insert([
            'title' => 'Pro',
            'amount' => 20.00,
            'active' => true,
            'principal' => true,
            'period' => 12,
            'discounts' => 10.0,
            'slots' => 5
        ]);

        //Benefits
        DB::table('benefits')->insert([
            'message' => 'Primeiras 10 caixas gratuitas',
            'subscription_id' => 1,
            'active' => true
        ]);

        DB::table('benefits')->insert([
            'message' => 'Fotos das caixas.',
            'subscription_id' => 1,
            'active' => true
        ]);

        DB::table('benefits')->insert([
            'message' => 'Seu próprio endereço nos EUA',
            'subscription_id' => 1,
            'active' => true
        ]);

        DB::table('benefits')->insert([
            'message' => 'Primeiras 10 caixas gratuitas',
            'subscription_id' => 1,
            'active' => true
        ]);

        DB::table('benefits')->insert([
            'message' => 'Primeiras 10 caixas gratuitas',
            'subscription_id' => 1,
            'active' => true
        ]);

        DB::table('benefits')->insert([
            'message' => 'Primeiras 10 caixas gratuitas',
            'subscription_id' => 1,
            'active' => true
        ]);

        //-------- second benefit

        DB::table('benefits')->insert([
            'message' => 'Seu próprio endereço nos EUA',
            'subscription_id' => 2,
            'active' => true
        ]);

        DB::table('benefits')->insert([
            'message' => '3 fotos gratuitas de cada pacote',
            'subscription_id' => 2,
            'active' => true
        ]);

        DB::table('benefits')->insert([
            'message' => 'Economize até 80% em fretes',
            'subscription_id' => 2,
            'active' => true
        ]);

        DB::table('benefits')->insert([
            'message' => '3 fotos gratuitas de cada pacote',
            'subscription_id' => 2,
            'active' => true
        ]);

        DB::table('benefits')->insert([
            'message' => '3 fotos gratuitas de cada pacote',
            'subscription_id' => 2,
            'active' => true
        ]);

        DB::table('benefits')->insert([
            'message' => '3 fotos gratuitas de cada pacote',
            'subscription_id' => 2,
            'active' => true
        ]);

        // ----- end benefit 2


        DB::table('benefits')->insert([
            'message' => '180 dias gratuitos',
            'subscription_id' => 3,
            'active' => true
        ]);

        DB::table('benefits')->insert([
            'message' => 'Taxa grátis para o armazém EUA',
            'subscription_id' => 3,
            'active' => true
        ]);

        DB::table('benefits')->insert([
            'message' => 'Envios de vários pacotes',
            'subscription_id' => 3,
            'active' => true
        ]);

        DB::table('benefits')->insert([
            'message' => 'Envios de vários pacotes',
            'subscription_id' => 3,
            'active' => true
        ]);

        DB::table('benefits')->insert([
            'message' => 'Envios de vários pacotes',
            'subscription_id' => 3,
            'active' => true
        ]);

        DB::table('benefits')->insert([
            'message' => 'Envios de vários pacotes',
            'subscription_id' => 3,
            'active' => true
        ]);

        DB::table('warehouses')->insert([
            'storage_time' => 30,
            'box_price' => 5.00
        ]);

    }
}
