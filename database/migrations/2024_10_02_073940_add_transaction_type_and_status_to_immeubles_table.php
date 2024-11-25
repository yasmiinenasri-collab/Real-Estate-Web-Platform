<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('immeubles', function (Blueprint $table) {
        $table->string('transaction_type')->default('a_vendre'); // Possible values: 'a_vendre', 'a_louer'
        $table->string('status')->default('disponible'); // Possible values: 'disponible', 'vendu', 'loué'
    });
}

public function down()
{
    Schema::table('immeubles', function (Blueprint $table) {
        $table->dropColumn('transaction_type');
        $table->dropColumn('status');
    });
}
};
