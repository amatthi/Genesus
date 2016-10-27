<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddBrandToProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasColumn('profiles', 'brand_description')) {
            return;
        }
        Schema::table('profiles', function (Blueprint $table) {
            $table->text('brand_description')->nullable();
            $table->text('brand_city')->nullable();
            $table->text('brand_state')->nullable();
            $table->text('brand_zip')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('profiles', function (Blueprint $table) {
            $table->dropColumn(['brand_description', 'brand_city', 'brand_state', 'brand_zip']);
        });
    }
}
