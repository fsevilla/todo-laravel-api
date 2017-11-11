<?php

use Illuminate\Database\Seeder;

class OAuthClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sql = file_get_contents(__DIR__.'/sql/OAuthClientSeeder.sql');
        \DB::connection()->getPdo()->exec($sql);
    }
}
