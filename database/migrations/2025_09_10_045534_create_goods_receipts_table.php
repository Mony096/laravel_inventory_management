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
      Schema::create('goods_receipts', function (Blueprint $table) {
    $table->id();
    $table->string('number')->unique();
    $table->date('document_date');
    $table->foreignId('employee_id')->constrained();
    $table->string('truck_no')->nullable();
    $table->foreignId('supply_point')->constrained();
    $table->foreignId('warehouse_id')->constrained();
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('goods_receipts');
    }
};