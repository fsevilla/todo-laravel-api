<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolePermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::connection()->getPdo()->exec(file_get_contents(__DIR__.'/sql/2016_11_16_170041_create_role_permissions_table_up.sql'));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::connection()->getPdo()->exec(file_get_contents(__DIR__.'/sql/2016_11_16_170041_create_role_permissions_table_down.sql'));
    }
}
