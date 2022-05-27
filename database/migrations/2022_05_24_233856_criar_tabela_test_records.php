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
        Schema::create('test_records', function (Blueprint $table) {
            $table->id();
            $table->string('date');
            $table->string('record');
            $table->string('template');
            $table->string('template_version');
            $table->string('ansur_version');
            $table->string('plugin');
            $table->string('plugin_version');
            $table->string('device_serial_number');
            $table->string('device_model');
            $table->string('mti_test_instrument');
            $table->string('mti_serial_number');
            $table->string('mti_firmware_version');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('test_records');
    }
};
