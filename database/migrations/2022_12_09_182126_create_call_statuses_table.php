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
        Schema::create('call_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('callid')->nullable();
            $table->string('type')->nullable();
            $table->text('status')->nullable();;
            $table->boolean('mode')->nullable();;
            $table->integer('level')->nullable();;
            $table->text('addedby')->nullable();

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
        Schema::dropIfExists('call_statuses');
    }
};
