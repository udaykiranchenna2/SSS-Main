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
        Schema::create('calls', function (Blueprint $table) {
            $table->id();
            $table->dateTime('requestdate');
            $table->string('requestno');
            $table->string('customerid');
            $table->string('calltype');
            $table->string('brand')->nullable();
            $table->text('description')->nullable();
            $table->string('productcategory')->nullable();;
            $table->unsignedBigInteger('addedby')->nullable();;
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
        Schema::dropIfExists('calls');
    }
};
