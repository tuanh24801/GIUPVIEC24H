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
        Schema::create('ew_income', function (Blueprint $table) {
            $table->id();
            $table->integer('amount_in')->default(0);
            $table->integer('amount_out')->default(0);
            $table->string('note');
            $table->unsignedBigInteger('errand_worker_id');
            $table->foreign('errand_worker_id')->references('id')->on('errand_workers')->onDelete('cascade');
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
        Schema::dropIfExists('ew_income');
    }
};
