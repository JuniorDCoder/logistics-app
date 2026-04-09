<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        DB::table('contacts')->insert([
            'contact_email' => 'logisticstransglobal652@gmail.com',
            'contact_phone' => '+1 (929) 796-3621',
        ]);
    }
}
