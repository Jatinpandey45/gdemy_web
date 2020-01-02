<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateCategoryIconColumnType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('gk_category', function(Blueprint $table)
        {
            $table->dropColumn('category_icon');
        });
        
        Schema::table('gk_category', function (Blueprint $table) {
            $table->text('category_icon');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('gk_category', function (Blueprint $table) {
            //
        });
    }
}
