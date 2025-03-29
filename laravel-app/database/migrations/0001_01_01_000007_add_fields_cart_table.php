<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('cart', function($table) {
            $table->string('price');
            $table->string('tax_rate');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('cart', function($table) {
            $table->dropColumn('price');
            $table->dropColumn('tax_rate');
        });
    }
};
