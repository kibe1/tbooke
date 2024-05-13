<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNameColumnsToCreatorsTable extends Migration
{
    public function up()
    {
        Schema::table('creators', function (Blueprint $table) {
            $table->string('first_name')->nullable()->after('user_id');
            $table->string('surname')->nullable()->after('first_name');
        });
    }

    public function down()
    {
        Schema::table('creators', function (Blueprint $table) {
            $table->dropColumn(['first_name', 'surname']);
        });
    }
}
