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
        Schema::create('resumes', function (Blueprint $table) {
            $table->id();

            $table->string('title');
            $table->string('name');
            $table->string('surname');
            $table->string('last_name');
            $table->string('city');
            $table->timestamp('date_of_birtday');
            $table->string('phone');
            $table->string('nationality');
            $table->string('experience');
            $table->string('education');

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
        Schema::dropIfExists('resumes');
    }
};
