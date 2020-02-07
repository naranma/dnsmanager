<?php

use Illuminate\Database\Seeder;
use App\Models\RecordType;

class RecordTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        RecordType::create(['id'=> '1', 'name' => 'A', 'description' => 'Host address']);
        RecordType::create(['id'=> '2', 'name' => 'CNAME', 'description' => 'Canonical name for an alias']);
        RecordType::create(['id'=> '3', 'name' => 'MX', 'description' => 'Mail eXchange']);
        RecordType::create(['id'=> '4', 'name' => 'NS', 'description' => 'Name Server']);
        RecordType::create(['id'=> '5', 'name' => 'PTR', 'description' => 'Pointer']);
        RecordType::create(['id'=> '6', 'name' => 'SRV', 'description' => 'Location of service']);
        RecordType::create(['id'=> '7', 'name' => 'TXT', 'description' => 'Descriptive text']);

    }
}
