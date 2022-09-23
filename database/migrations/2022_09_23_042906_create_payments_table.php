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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->uuid()->unique();
            $table->timestamp('payment_date')->nullable();
            $table->timestamp('expires_at');
            $table->enum('status', ['pending', 'paid']);
            $table->foreignId('user_id');
            $table->decimal('clp_usd', 9, 4)->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('clients')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
};
