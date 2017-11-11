<?php

use Illuminate\Database\Seeder;

class ResourcesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sql = file_get_contents(__DIR__.'/sql/ResourcesTableSeeder.sql');
        \DB::connection()->getPdo()->exec($sql);
    }
}
