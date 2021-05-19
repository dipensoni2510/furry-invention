<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicles', function (Blueprint $table) {
          $table->id();
          $table->foreignId('company_id');
          $table->string('name');
          $table->string('model');
          $table->string('vehicle_type');//Activa, Bike, Car
          $table->string('wheels')->default(2); //2, 4
          $table->string('gear_type')->default('with'); //With, Without
          $table->text('specifications');
          $table->string('price');
          $table->foreign('company_id')
            ->references('id')
            ->on('companies')
            ->onDelete('cascade');
          $table->timestamps();
          $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vehicles');
    }
}
