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
        Schema::create('warehouse_part', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('warehouse_id')->index('warehouse_id_idx');
            $table->unsignedBigInteger('part_id')->index('part_id_idx');
            $table->integer('inventory')->default(0);
            $table->timestamps();

            $table->foreign('warehouse_id')->references('id')->on('warehouses');
            $table->foreign('part_id')->references('id')->on('parts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('warehouse_part');
    }
};
