<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectionAppDomainNameToIdTable extends Migration
{
    public function up()
    {
        Schema::create('app_domain_name_to_id', function (Blueprint $table) {
            $table->string('domain_id');
            $table->string('name');
            $table->string('database_id');
        });
    }

    public function down()
    {
        Schema::drop('app_domain_name_to_id');
    }
}
