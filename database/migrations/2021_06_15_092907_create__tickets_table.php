<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Tickets', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_user');
            $table->integer('AffectedId')->nullable()->default(NULL);
            $table->string('Title');
            $table->string('Cat');
            $table->longText('Problem');
            $table->string('status');
            $table->string('Society');
            $table->integer('Share_flag')->default(0);
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
        Schema::dropIfExists('Tickets');
    }
}
