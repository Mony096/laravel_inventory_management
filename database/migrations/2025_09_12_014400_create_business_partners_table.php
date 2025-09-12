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
        Schema::create('business_partners', function (Blueprint $table) {
        $table->id();
        $table->string('CardCode')->unique();   // Unique business partner code
        $table->string('CardName');             // Name
        $table->string('CardType');             // Customer / Vendor / Lead etc.
        $table->string('Address')->nullable();
        $table->string('PhoneNumber')->nullable();
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
        Schema::dropIfExists('business_partners');
    }
};