<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameEnvironmentsTableToDatabase extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::rename(
            'domain_ddd_schema_environment_name_already_in_use',
                'domain_modeling_schema_database_name_already_in_use'
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::rename(
            'domain_modeling_schema_database_name_already_in_use',
                'domain_ddd_schema_environment_name_already_in_use'
        );
    }
}
