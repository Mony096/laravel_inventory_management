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
    // {
    //     Schema::create('business_places', function (Blueprint $table) {
    //         $table->id();
    //         $table->timestamps();
    //     });
    // }
 {
        Schema::create('business_places', function (Blueprint $table) {
        $table->id();
        $table->string('Name')->unique();   // Unique business partner code
        $table->string('Adress')->nullable();             // Name
        $table->string('AliasName');             // Customer / Vendor / Lead etc.
        $table->string('Contact')->nullable();
         $table->string('Administrator');
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
        Schema::dropIfExists('business_places');
    }
};