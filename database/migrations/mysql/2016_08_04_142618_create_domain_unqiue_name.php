<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDomainUnqiueName extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('domain_modeling_schema_domain_name_already_in_use', function (Blueprint $table) {
            $table->string('domain_id');
            $table->string('name');
            $table->string('database_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('domain_modeling_schema_domain_name_already_in_use');
    }
}