<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactPersonsTable extends Migration
{
    public function up()
    {
        Schema::create('contact_persons', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('owner_id')->unsigned()->index()->nullable();
            $table->foreign('owner_id')->references('id')->on('owners')->onUpdate('restrict')->onDelete('restrict');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->boolean('is_active');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('contact_persons');
    }
}
