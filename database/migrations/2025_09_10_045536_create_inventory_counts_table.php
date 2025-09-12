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
       Schema::create('inventory_counts', function (Blueprint $table) {
            $table->id();
            $table->date('count_date');
            $table->time('count_time');
            $table->enum('count_type', ['Single', 'Double'])->default('Single');
            $table->foreignId('inventory_counter_user')->constrained('employees')->cascadeOnDelete();
            $table->enum('status', ['Open','Closed'])->default('Open');
            $table->foreignId('warehouse_id')->constrained()->cascadeOnDelete();
            $table->string('attachment')->nullable();
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
        Schema::dropIfExists('inventory_counts');
    }
};
