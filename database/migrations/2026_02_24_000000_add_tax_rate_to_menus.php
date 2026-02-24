<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 *
 */
return new class extends Migration {

    public function up()
    {
        Schema::table('menus', function (Blueprint $table) {
            $table->decimal('vat_rate')->nullable();
            $table->text('epos_sku')->nullable();
            $table->text('reporting_category')->nullable();

        });
    }

    public function down()
    {
        Schema::table('menus', function (Blueprint $table) {
            $table->dropColumn('vat_rate');
            $table->dropColumn('epos_sku');
            $table->dropColumn('reporting_category');

        });
    }
};