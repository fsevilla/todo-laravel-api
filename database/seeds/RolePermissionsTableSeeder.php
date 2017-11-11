<?php

use Illuminate\Database\Seeder;

class RolePermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sql = file_get_contents(__DIR__.'/sql/RolePermissionsTableSeeder.sql');
        \DB::connection()->getPdo()->exec($sql);
    }
}
