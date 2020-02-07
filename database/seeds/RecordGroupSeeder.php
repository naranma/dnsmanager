<?php

use Illuminate\Database\Seeder;
use App\Models\RecordGroup;

class RecordGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        RecordGroup::create(['id'=> '1', 'name' => 'Server', 'description' => 'Host']);
    }
}
