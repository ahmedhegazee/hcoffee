<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("phone");
            $table->text("notes")->nullable();
            $table->unsignedBigInteger("total_amount");
            $table->string("payment_transaction_no")->nullable();
            $table->string("payment_status")->nullable();
            $table->foreignId("interval_id")->references("id")->on("intervals")
                ->cascadeOnUpdate()->cascadeOnDelete();
            $table->unsignedInteger("guests_count");
            //0 =>for first one, 1=>for second one
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
        Schema::dropIfExists('reservations');
    }
}