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
        Schema::table('call_statuses', function (Blueprint $table) {
            $table->text('remark')->nullable();
            $table->json('status_json')->nullable();
            $table->string('sub_status')->nullable();


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('call_statuses', function (Blueprint $table) {
            //
        });
    }
};
