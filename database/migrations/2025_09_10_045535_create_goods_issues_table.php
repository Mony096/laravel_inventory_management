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
       Schema::create('goods_issues', function (Blueprint $table) {
            $table->id();
            $table->string('number')->unique();
            $table->date('document_date');
            $table->foreignId('employee_id')->constrained()->cascadeOnDelete();
            $table->string('truck_no')->nullable();
            $table->foreignId('ship_to')->constrained()->cascadeOnDelete();
            $table->foreignId('warehouse_id')->constrained()->cascadeOnDelete();
            $table->string('attachment')->nullable(); // image path
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
        Schema::dropIfExists('goods_issues');
    }
};