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
      Schema::create('goods_receipt_lines', function (Blueprint $table) {
    $table->id();
    $table->foreignId('goods_receipt_id')->constrained()->onDelete('cascade');
    $table->foreignId('item_id')->constrained();
    $table->string('item_desc');
    $table->integer('quantity');
    $table->string('uom_code');
    $table->decimal('unit_price', 10, 2);
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
        Schema::dropIfExists('goods_receipt_lines');
    }
};
