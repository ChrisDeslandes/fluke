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
        Schema::create('test_results', function (Blueprint $table) {
            $table->id();
            $table->string('test_element');
            $table->string('test_type');
            $table->string('procedure', 1000);
            $table->unsignedBigInteger('test_record_id');

            $table->foreign('test_record_id')->references('id')->on('test_records');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('test_results');
    }
};
