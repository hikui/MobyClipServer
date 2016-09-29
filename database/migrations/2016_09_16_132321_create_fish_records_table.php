<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFishRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fish_records', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->float('length', 5, 2);
            $table->float('weight', 8, 2);
            $table->unsignedInteger('fish_type_id')->nullable();
            $table->foreign('fish_type_id')->references('id')->on('fish_types');
            $table->boolean('active')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fish_records');
    }
}
