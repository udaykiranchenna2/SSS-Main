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
        Schema::create('call_assigns', function (Blueprint $table) {
            $table->id();
            $table->string('callid');
            $table->unsignedBigInteger('userid');
            $table->dateTime('assigneddate');
            $table->boolean('assignedActive');
            $table->integer('level');
            $table->integer('assignedby');
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
        Schema::dropIfExists('call_assigns');
    }
};
