<?php

namespace Database\Seeders;

use App\Models\Client;
use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $clients = [
            ['name'=>'client 1','phone'=>'01111111111','address'=>'Cairo',],
            ['name'=>'client 2','phone'=>'01222222222','address'=>'Alex',],
            ['name'=>'client 3','phone'=>'01000000000','address'=>'Giza',],
        ];
        foreach ($clients as $client)
        {
            Client::create($client);
        }
    }
}
