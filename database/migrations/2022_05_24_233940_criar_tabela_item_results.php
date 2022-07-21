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
        Schema::create('item_results', function (Blueprint $table) {
            $table->id();
            $table->string('lead')->nullable()->default(null);
            $table->string('value');
            $table->string('unit');
            $table->string('high_limit')->nullable()->default(null);
            $table->string('low_limit')->nullable()->default(null);
            $table->string('standard');
            $table->unsignedBigInteger('test_item_id');

            $table->foreign('test_item_id')->references('id')->on('test_items');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('item_results');
    }
};
