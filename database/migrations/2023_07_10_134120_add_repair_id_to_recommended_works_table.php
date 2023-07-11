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
        Schema::table('recommended_works', function (Blueprint $table) {
            $table->bigInteger('repair_id', false, true);
            $table->foreign('repair_id')->references('id')->on('repairs')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('recommended_works', function (Blueprint $table) {
            $table->dropForeign('recommended_works_repair_id_foreign');
            $table->dropColumn('repair_id');
        });
    }
};
