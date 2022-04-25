<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('stamps', function (Blueprint $table) {
            $table->string('Monday')->nullable();
            $table->string('Tuesday')->nullable();
            $table->string('Wedneday')->nullable();
            $table->string('Thursday')->nullable();
            $table->string('Friday')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('stamps', function (Blueprint $table) {
            $table->dropColumn(['Monday', 'Tuesday', 'Wedneday', 'Thursday', 'Friday']);
        });
    }
};
