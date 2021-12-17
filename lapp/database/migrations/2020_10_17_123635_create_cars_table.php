<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->integer('price');
            $table->year('made_at');
            $table->integer('views')->default(0);
            $table->integer('distance');
            $table->boolean('barter');
            $table->boolean('credit');
            $table->text('body')->nullable();

            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('city_id')->constrained();
            $table->foreignId('car_body_id')->constrained();
            $table->foreignId('color_id')->constrained();
            $table->foreignId('engine_id')->constrained();
            $table->foreignId('fuel_id')->constrained();
            $table->foreignId('car_model_id')->constrained();

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
        Schema::dropIfExists('cars');
    }
}
